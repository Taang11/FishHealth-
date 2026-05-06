<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'booking';
protected $primaryKey = 'booking_id';

protected $fillable = [
    'user_id',
    'teknisi_id',
    'layanan_id',
    'ikan_nama',
    'ikan_jenis',
    'ikan_foto',
    'tanggal',
    'jam',
    'status'
];

public function teknisi()
{
    return $this->belongsTo(Teknisi::class, 'teknisi_id', 'teknisi_id');
}

public function layanan()
{
    return $this->belongsTo(Layanan::class, 'layanan_id', 'layanan_id');
}

public function user()
{
    return $this->belongsTo(User::class);
}

public function pembayaran()
{
    return $this->hasOne(Pembayaran::class, 'booking_id', 'booking_id');
}
}
