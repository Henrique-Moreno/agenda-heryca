<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ConsultationReminder extends Notification
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
      ->line('Você tem uma consulta marcada para o seguinte horário:')
      ->line('Data: ' . $this->consulta->data)
      ->line('Horário: ' . $this->consulta->horario)
      ->action('Ver Consulta', url('/consultas/' . $this->consulta->id))
      ->line('Obrigado por usar nosso sistema!');
  }

  public function toArray($notifiable)
  {
    return [
      'consulta_id' => $this->consulta->id,
      'data' => $this->consulta->data,
      'horario' => $this->consulta->horario,
      'mensagem' =>
        'Você tem uma consulta marcada para o seguinte horário: ' .
        $this->consulta->data .
        ' às ' .
        $this->consulta->horario,
    ];
  }
}
