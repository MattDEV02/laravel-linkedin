<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Commento extends Model
{
    use HasFactory;
	
	protected $table = 'Commento';
    public $timestamps = true;
}
