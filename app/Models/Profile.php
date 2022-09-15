<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'dob',
        'fullname',
    ];

    public function dkasl()
    {
        return $this->morphTo();
    }
}
