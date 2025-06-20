<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $guarded = ['id'];

    public function pembeli()
    {
        return $this->belongsTo(Pembeli::class)->withTrashed();
    }

    public function balak()
    {
        return $this->belongsTo(Balak::class);
    }
}
