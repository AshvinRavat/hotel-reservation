<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomReservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'total_amount',
        'status'
    ];

    public function roomReservationItems() {
       return $this->hasMany(RoomReservationItem::class);
    }
}
