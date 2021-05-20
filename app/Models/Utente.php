<?php

namespace App\Models;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Utente extends Model
{
   use HasFactory;

   protected $table = 'Utente';
   public $timestamps = true;
}