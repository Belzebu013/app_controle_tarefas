<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Lang;

class RedefinirSenhaNotification extends Notification
{
    use Queueable;
    public $token;
    public $email;
    public $name;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $email, $name)
    {
        $this->token = $token;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = 'http://localhost:8000/password/reset/password'.$this->token.'?email='.$this->email;
        $minutos  = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');
        $saudacao = 'Olá. '.$this->name;

        return (new MailMessage)
        ->subject(Lang::get('Atualização de Senha'))
        ->greeting($saudacao)
        ->line(Lang::get('Esqueceu a senha? Sem problemas, vamos resolver isso!!!'))
        ->action(Lang::get('Clique aqui para modificar a senha'), $url)
        ->line(Lang::get('O link acima expira em '.$minutos.' minutos'))
        ->line(Lang::get('Caso não solicitado, ignorar este email'))
        ->salutation('Até breve!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
