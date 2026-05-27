<?php

namespace App\Http\Controllers;

use App\Models\ConviteAdministradorCidade;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConviteAdministradorCidadeController extends Controller
{
    /**
     * Aceitar convite de administrador da cidade.
     */
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
                ->route('dashboard')
                ->with('error', 'Este convite pertence a outro e-mail.');
        }

        // Vincula o usuário como administrador da cidade
        $cidade = $convite->cidade;

        $cidade->administradores()->syncWithoutDetaching([
            $user->id,
        ]);

        // Atualiza status do convite
        $convite->update([
            'status' => 'aceito',
            'aceito_em' => now(),
        ]);

        return redirect()
            ->route('dashboard')
            ->with(
                'success',
                'Convite aceito com sucesso. Agora você é administrador da cidade ' . $cidade->nome . '.'
            );
    }

    /**
     * Rejeitar convite de administrador da cidade.
     */
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
            'status' => 'rejeitado',
            'rejeitado_em' => now(),
        ]);

        return redirect()
            ->route('login')
            ->with('success', 'Convite rejeitado com sucesso.');
    }
}
