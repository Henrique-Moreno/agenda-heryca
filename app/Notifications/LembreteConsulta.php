<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class LembreteConsulta extends Notification
{
  use Queueable;

  protected $consulta;

  public function __construct($consulta)
  {
    $this->consulta = $consulta;
  }

  public function via($notifiable)
  {
    return ['mail'];
  }

  public function toMail($notifiable)
  {
    return (new MailMessage())
      ->subject('Lembrete de Consulta')
      ->line(
        'Você tem uma consulta agendada para ' .
          $this->consulta->data->format('d/m/Y') .
          ' às ' .
          $this->consulta->horario
      )
      ->action('Ver Consulta', url('/agenda/' . $this->consulta->id))
      ->line('Obrigado por usar nossa aplicação!');
  }
}
