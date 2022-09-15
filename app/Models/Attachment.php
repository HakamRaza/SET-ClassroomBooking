<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Store classroom attachement
 * @param string uri
 */
class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'uri'
    ];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}
