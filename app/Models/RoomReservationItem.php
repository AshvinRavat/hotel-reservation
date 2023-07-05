<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReservationItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_reservation_id',
        'room_id',
        'user_id',
        'start_date',
        'end_date',
        'total_persons',
        'total_rooms',
        'price',
    ];

    public function RoomReservation() {
        return $this->belongsTo(RoomReservation::class);
    }
}
