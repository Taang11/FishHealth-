<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';
protected $primaryKey = 'pembayaran_id';

protected $fillable = [
    'booking_id',
    'jumlah',
    'status'
];

public function booking()
{
    return $this->belongsTo(Booking::class, 'booking_id', 'booking_id');
}
}
