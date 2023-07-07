<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'user_id',
        'image',
        'description',
        'address_line_1',
        'address_line_2',
        'city',
        'post_code'
    ];

    public function rooms() {
        return $this->hasMany(Room::class, 'hotel_id', 'id');
    }

}
