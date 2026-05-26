<?php

namespace App\Notifications;

use App\Models\ConviteAdministradorCidade;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConviteAdminCidadeNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public ConviteAdministradorCidade $convite;

    /**
     * Create a new notification instance.
     */
    public function __construct(ConviteAdministradorCidade $convite)
    {
        $this->convite = $convite;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $cidade = $this->convite->cidade;

        $aceitarUrl = route(
            'convites.admin-cidade.aceitar',
            $this->convite->token
        );

        $rejeitarUrl = route(
            'convites.admin-cidade.rejeitar',
            $this->convite->token
        );

        return (new MailMessage)
            ->subject('Convite para administrar cidade')
            ->greeting('Olá, ' . $notifiable->name . '!')
            ->line('Você recebeu um convite para se tornar administrador da cidade abaixo:')
            ->line('🏙 Cidade: ' . $cidade->nome)
            ->line('📍 UF: ' . $cidade->uf)
            ->line('Ao aceitar o convite, você poderá:')
            ->line('• Criar espaços')
            ->line('• Editar espaços')
            ->line('• Excluir espaços')
            ->line('• Gerenciar categorias')
            ->line('• Aprovar e rejeitar reservas')
            ->action('Aceitar convite', $aceitarUrl)
            ->line('Caso não queira aceitar o convite, utilize o link abaixo:')
            ->action('Rejeitar convite', $rejeitarUrl)
            ->line('Se você não esperava este convite, ignore este e-mail.');
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'cidade_id' => $this->convite->cidade_id,
            'cidade_nome' => $this->convite->cidade->nome,
            'email' => $this->convite->email,
            'status' => $this->convite->status,
        ];
    }
}
