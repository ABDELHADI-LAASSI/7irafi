<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdditionalInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address',
        'phone_number',
        'image',
        'rating',
        'hirfa',
        'date_of_birth',
        'gender',
        'city',
        'availability',
        'CIN',
        'biography',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
