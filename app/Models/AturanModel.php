<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AturanModel extends Model
{
    use HasFactory;
    protected $table            = 'aturan';
    protected $primaryKey       = 'id';
    protected $fillable         = ['id_gejala', 'hasil_aturan', 'id_user'];
    public $timestamps          = true;
}
