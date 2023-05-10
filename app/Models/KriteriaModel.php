<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KriteriaModel extends Model
{
    use HasFactory;
    protected $table            = 'kriteria';
    protected $primaryKey       = 'id';
    protected $fillable         = ['nama_kriteria', 'hasil_kriteria', 'kode_kriteria'];
    public $timestamps          = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function gejala()
    {
        return $this->hasMany(GejalaModel::class, 'id_kriteria', 'id');
    }

    public function tingkatan()
    {
        return $this->hasMany(TingkatanModel::class, 'id_tingkatan', 'id');
    }
}
