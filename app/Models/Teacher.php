<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Hollywood;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * Store list of teachers
 * @var string name
 * @var string secret
 */
class Teacher extends Hollywood
{
    use HasFactory,
        HasApiTokens,
        HasRoles;

    /**
     * The attributes that are mass assignable.
     * 
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'secret',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        // 'secret',
        // 'remember_token',
    ];

    protected $appends = [
        'name_upper'
    ];

    /**
     * Mutator function
     * To DB
     */
    public function setSecretAttribute($value)
    {
        $this->attributes['secret'] = Hash::make($value);
    }

    /**
     * Accessor function
     * From DB
     */
    public function getNameUpperAttribute()
    {
        return strtoupper($this->name);
    }

    /**
     * Get the classrooms belong to this teacher
     */
    public function classrooms()
    {
        return $this->hasMany(Classroom::class);
    }

}
