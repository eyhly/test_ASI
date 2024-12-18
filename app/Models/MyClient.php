<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MyClient extends Model
{
    use HasFactory;
    protected $table = 'my_client'; 

    protected $fillable = [
        'name',
        'slug',
        'client_logo',
        'is_project',
        'self_capture',
        'client_prefix',
        'address',
        'phone_number',
        'city',
    ];
}
