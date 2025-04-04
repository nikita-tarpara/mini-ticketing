<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Eloquent
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'status'];
}
