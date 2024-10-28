<?php

namespace App\Notifications;

use App\Models\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveCreated extends Notification
{
    use Queueable;
    public $leave;
    /**
     * Create a new notification instance.
     */
    public function __construct(Leave $leave)
    {
        $this->leave = $leave;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
{
    $substituteEmployee = $this->leave->substitute_employee 
        ? $this->leave->substitute_employee->employee_name 
        : 'Nu s-a ales un înlocuitor';

    $managerOrSubstitute = $this->leave->substitute_employee 
        ? $this->leave->substitute_employee->employee_name 
        : $this->leave->employee->department->manager->employee_name;

    return (new MailMessage)
                ->subject('Cerere nouă de concediu')
                ->greeting('Salut ' . $managerOrSubstitute)
                ->line('Angajatul ' . $this->leave->employee->employee_name . ' a creat o cerere de concediu.')
                ->line('Tip Concediu: ' . $this->leave->leave_type->name)
                ->line('Perioada: ' . $this->leave->start_date . ' până la ' . $this->leave->end_date)
                ->line('Înlocuitor: ' . $substituteEmployee)
                ->line('Stare: ' . $this->leave->status)
                ->line('Motiv: ' . $this->leave->reason)
                ->line('Te rugăm să aprobi sau să respingi această cerere!')
                // ->line('**[Aprobă cererea](' . route('leaves.substituteApproved', $this->leave->id) . ')**')
                // ->line('**[Respinge cererea](' . route('leaves.substituteRejected', $this->leave->id) . ')**')
                ->line('Mulțumim!');
}


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
