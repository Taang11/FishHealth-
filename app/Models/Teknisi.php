<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table      = 'teknisi';
    protected $primaryKey = 'teknisi_id';

    protected $fillable = [
        'user_id',
        'nama',
        'subtype',
        'no_hp',
        'alamat',
        'lat',
        'lng',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'teknisi_id', 'teknisi_id');
    }
}
