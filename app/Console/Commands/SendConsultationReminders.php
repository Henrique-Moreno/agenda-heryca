<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Consulta;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ConsultationReminder;

class SendConsultationReminders extends Command
{
  protected $signature = 'reminders:consultations';
  protected $description = 'Send reminders for consultations scheduled for tomorrow';

  public function __construct()
  {
    parent::__construct();
  }

  public function handle()
  {
    $tomorrow = now()
      ->addDay()
      ->toDateString();
    $consultas = Consulta::whereDate('data', $tomorrow)->get();

    foreach ($consultas as $consulta) {
      $aluno = $consulta->aluno;
      $servidor = $consulta->servidor;

      Notification::send($aluno, new ConsultationReminder($consulta));
      Notification::send($servidor, new ConsultationReminder($consulta));
    }

    $this->info('Lembretes de consulta enviados com sucesso.');
  }
}
