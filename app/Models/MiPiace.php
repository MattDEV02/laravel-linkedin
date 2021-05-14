<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kirschbaum\PowerJoins\PowerJoins;


class MiPiace extends Model
{
   use HasFactory;
   use powerJoins;

   protected $table = 'MiPiace';
   public $timestamps = false;
}
