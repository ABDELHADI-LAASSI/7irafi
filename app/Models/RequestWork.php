<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'hirafi_id',
        'description',
        'status',
    ];
}
