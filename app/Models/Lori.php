<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lori extends Model
{
    /** @use HasFactory<\Database\Factories\LoriFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function pemilik()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id');
    }
    public function kawasan()
    {
        return $this->belongsToMany(Kawasan::class, 'kawasan_lori', 'lori_id', 'kawasan_id');
    }

}
