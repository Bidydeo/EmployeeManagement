<?php

namespace App\Events;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AttendanceUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $existingAttendance;
    /**
     * Create a new event instance.
     */
    public function __construct(Attendance $existingAttendance)
    {
        $this->existingAttendance = $existingAttendance;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn()
    {
            return new Channel('attendance-channel');
    }
    public function broadcastWith()
    {
        return [
            'attendance_id' => $this->existingAttendance->id, // Adaugă attendance_id
            'clock_out_time' => $this->existingAttendance->clock_out_time ? Carbon::parse($this->existingAttendance->clock_out_time)->format('H:i:s') : 'N/A',
        ];
    }
}
