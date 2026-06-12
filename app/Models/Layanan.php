<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table      = 'layanan';
    protected $primaryKey = 'layanan_id';

    protected $fillable = [
        'nama_layanan',
        'harga',
        'subtype',
    ];

    /**
     * Scope to filter layanan by subtype (teknisi / dokter)
     */
    public function scopeForSubtype($query, string $subtype)
    {
        return $query->where('subtype', $subtype);
    }
}
