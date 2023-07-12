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

    public function rooms() {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }

    public function roomReservations() {
        return $this->belongsTo(RoomReservation::class, 'room_reservation_id', 'id');
    }

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
