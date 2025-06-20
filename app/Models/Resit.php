<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resit extends Model
{
    protected $guarded = ['id'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class, 'pembeli_id')->withTrashed();
    }

    public function kawasanLori()
    {
        return $this->belongsTo(KawasanLori::class, 'kawasan_lori_id');
    }
}
