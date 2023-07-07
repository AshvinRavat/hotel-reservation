<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotel_id',
        'category_id',
        'room_number',
        'image',
        'price',
        'max_occupancy',
        'description',
    ];

    public function roomReservationItem()
    {
        return $this->hasMany(RoomReservationItem::class, 'room_id', 'id');
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class, 'hotel_id', 'id');
    }
}
