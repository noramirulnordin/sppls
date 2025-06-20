<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Balak extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $casts = [
        'panjang' => 'string',
        'diameter' => 'string',
    ];

    public function getGambarUrlAttribute()
    {
        return $this->gambar ? asset('storage/' . $this->gambar) : null;
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'Tersedia' => 'Tersedia',
            'Dijual' => 'Dijual',
            default => 'Unknown',
        };
    }
}
