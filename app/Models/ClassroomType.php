<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Seed table for classroom type available
 */
class ClassroomType extends Model
{
    use HasFactory;

    /**
     * Remove created_at, updated_at from mass assign
     */
    public $timestamps = false;
    
    /**
     * Mass assignable whitelist
     */
    protected $fillable = [
        'type'
    ];

    /**
     * Mass assignable blacklist
     */
    protected $guarded = [

    ];

    /**
     * To append attributes
     */
    protected $appends = [
        'uppercase_type'
    ];

    /**
     * Hide attribute
     */
    protected $hidden = [
        // 'id'
    ];

    /**
     * set a default value
     */
    protected $attributes = [
        'type' => 'rando'
    ];

    /**
     * Convert type to uppercase
     * @param string type
     * @
     */
    public function getUppercaseTypeAttribute()
    {
        return strtoupper($this->type);
    }

    // $fillable
    // $guarded
    // $guard_name
    // $table
    // $cast
    // $hidden
    // $appends
    // $attributes
    // $connection
}
