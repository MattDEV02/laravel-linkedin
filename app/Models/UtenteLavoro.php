<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UtenteLavoro extends Model
{
   use HasFactory;

   protected $table = 'UtenteLavoro';
   protected $primaryKey = ['utente', 'Lavoro'];
   public $incrementing = false;
   public $timestamps = false;
}
