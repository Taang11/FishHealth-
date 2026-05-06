<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ikan extends Model
{
    protected $table = 'ikan';
protected $primaryKey = 'ikan_id';

protected $fillable = [
    'user_id',
    'nama',
    'jenis'
];

public function user()
{
    return $this->belongsTo(User::class);
}
}
