<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Services\Transistor;
use App\Services\PodcastParser;

class GejalaModel extends Model
{
    use HasFactory;

    protected $table            = 'gejala';
    protected $primaryKey       = 'id';
    protected $fillable         = ['keterangan_gejala', 'bobot_gejala', 'id_kriteria'];
    public $timestamps          = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function kriteria()
    {
        return $this->belongsTo(KriteriaModel::class, 'id_kriteria', 'id');
    }

    public function tingkatan()
    {
        return $this->belongsTo(TingkatanModel::class, 'id_tingkatan', 'id');
    }
}
