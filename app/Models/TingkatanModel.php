<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TingkatanModel extends Model
{
  use HasFactory;
  protected $table            = 'tingkatan';
  protected $primaryKey       = 'id';
  protected $fillable         = ['nama_tingkatan'];
  public $timestamps          = true;
}
