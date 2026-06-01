<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use App\Models\ConviteAdministradorCidade;
use App\Models\User;
use App\Notifications\ConviteAdminCidadeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ConviteAdministradorCidadeController extends Controller
{
    public function store(Request $request, Cidade $cidade)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $convite = ConviteAdministradorCidade::create([
            'cidade_id'      => $cidade->id,
            'email'          => $request->email,
            'token'          => Str::random(64),
            'status'         => 'pendente',
            'convidado_por'  => auth()->id(),
        ]);

        $usuario = User::where('email', $request->email)->first();

        if ($usuario) {
            $usuario->notify(new ConviteAdminCidadeNotification($convite));
        }

        return back()->with('success', 'Convite enviado com sucesso.');
    }

    public function aceitar(string $token)
    {
        $convite = ConviteAdministradorCidade::with('cidade')
            ->where('token', $token)
            ->first();

        if (! $convite) {
            return redirect()
                ->route('login')
                ->with('error', 'Convite inválido.');
        }

        if ($convite->status === 'aceito') {
            return redirect()
                ->route('login')
                ->with('info', 'Este convite já foi aceito.');
        }

        if ($convite->status === 'rejeitado') {
            return redirect()
                ->route('login')
                ->with('info', 'Este convite já foi rejeitado.');
        }

        if (! Auth::check()) {
            session([
                'convite_admin_cidade_token' => $token,
            ]);

            return redirect()
                ->route('login')
                ->with('info', 'Faça login para aceitar o convite.');
        }

        /** @var User $user */
        $user = Auth::user();

        if ($user->email !== $convite->email) {
            return redirect()
                ->route('home')
                ->with('error', 'Este convite pertence a outro e-mail.');
        }

        $cidade = $convite->cidade;

        $cidade->administradores()->syncWithoutDetaching([
            $user->id,
        ]);

        $convite->update([
            'status'    => 'aceito',
            'aceito_em' => now(),
        ]);

        return redirect()
            ->route('home')
            ->with(
                'success',
                'Convite aceito com sucesso. Agora você é administrador da cidade ' . $cidade->nome . '.'
            );
    }

    public function rejeitar(string $token)
    {
        $convite = ConviteAdministradorCidade::where('token', $token)
            ->first();

        if (! $convite) {
            return redirect()
                ->route('login')
                ->with('error', 'Convite inválido.');
        }

        if ($convite->status === 'aceito') {
            return redirect()
                ->route('login')
                ->with('info', 'Este convite já foi aceito.');
        }

        if ($convite->status === 'rejeitado') {
            return redirect()
                ->route('login')
                ->with('info', 'Este convite já foi rejeitado.');
        }

        $convite->update([
            'status'       => 'rejeitado',
            'rejeitado_em' => now(),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Convite rejeitado com sucesso.');
    }
}
