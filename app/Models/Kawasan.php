<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kawasan extends Model
{
    /** @use HasFactory<\Database\Factories\KawasanFactory> */
    use HasFactory;

    protected $guarded = ['id'];

    public function lori()
    {
        return $this->belongsToMany(Lori::class, 'kawasan_lori', 'kawasan_id', 'lori_id');
    }

}
