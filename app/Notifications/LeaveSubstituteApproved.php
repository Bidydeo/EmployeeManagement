<?php

namespace App\Notifications;

use App\Models\Leave;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class LeaveSubstituteApproved extends Notification
{
    use Queueable;

    public $leaveApproval;

    /**
     * Create a new notification instance.
     */
    public function __construct(Leave $leaveApproval)
    {
        $this->leaveApproval = $leaveApproval;
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
        // Obține managerul și angajatul înlocuitor
        $manager = $this->leaveApproval->employee->department->manager;
        $substituteEmployee = $this->leaveApproval->substitute_employee->employee_name;

        return (new MailMessage)
            ->subject('Cerere nouă de concediu aprobata de '.$substituteEmployee)
            ->greeting('Salut ' . $manager->employee_name)
            ->line('Persoana înlocuitoare, ' . $substituteEmployee . ', a aprobat cererea de concediu pentru ' . $this->leaveApproval->employee->employee_name . '!')
            ->line('Tip Concediu: ' . $this->leaveApproval->leave_type->name)
            ->line('Perioada: ' . $this->leaveApproval->start_date . ' până la ' . $this->leaveApproval->end_date)
            ->line('Înlocuitor: ' . $substituteEmployee)
            ->line('Stare: ' . $this->leaveApproval->status)
            ->line('Motiv: ' . $this->leaveApproval->reason)
            ->action('Vezi cererea', url('/leaves/' . $this->leaveApproval->id))
            ->line('Te rugăm să aprobi sau să respingi această cerere!')
            ->line('**[Aprobă cererea](' . route('leaves_substituteApproved', $this->leaveApproval->id) . ')**')
            ->line('**[Respinge cererea](' . route('leaves_substituteRejected', $this->leaveApproval->id) . ')**')
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
