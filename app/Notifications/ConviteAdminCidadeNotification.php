<?php

namespace App\Notifications;

use App\Models\ConviteAdministradorCidade;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ConviteAdminCidadeNotification extends Notification
{
    use Queueable;

    public function __construct(
        public ConviteAdministradorCidade $convite
    ) {
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Convite para administrar cidade')
            ->greeting('Olá, ' . $notifiable->name)
            ->line('Você foi convidado para ser administrador da cidade: ' . $this->convite->cidade->nome)
            ->action('Aceitar convite', route('convites.admin-cidade.aceitar', $this->convite->token))
            ->line('Caso não queira aceitar, clique no link abaixo:')
            ->line(route('convites.admin-cidade.rejeitar', $this->convite->token));
    }
}
