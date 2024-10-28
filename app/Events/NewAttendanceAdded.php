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

class NewAttendanceAdded implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $attendance;

    public function __construct(Attendance $attendance )
    {
        $this->attendance = $attendance;
    }

    public function broadcastOn()
    {
        return new Channel('attendance-channel');
    }

    public function broadcastWith()
    {
        return [
            'attendance_id' => $this->attendance->id,
            'employee_name' => $this->attendance->employee->employee_name,
            'location_name' => $this->attendance->location->name,
            'day_of_week' => $this->attendance->clock_in_time->format('l'),
            'date' => $this->attendance->clock_in_time->format('d-m-Y'),
            'clock_in_time' => $this->attendance->clock_in_time->format('H:i:s'),
            'clock_out_time' => $this->attendance->clock_out_time ? Carbon::parse($this->attendance->clock_out_time)->format('H:i:s') : 'N/A',
            
        ];
    }
}
