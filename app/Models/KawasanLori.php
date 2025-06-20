<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KawasanLori extends Model
{
    protected $table = 'kawasan_lori';

    protected $guarded = ['id'];

    public function lori()
    {
        return $this->belongsTo(Lori::class);
    }

    public function kawasan()
    {
        return $this->belongsTo(Kawasan::class);
    }
}
