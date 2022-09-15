<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    /**
     * Blacklist mass assignment
     */
    protected $guarded = [
        'teacher_id',
        // 'type_id'
    ];

    /**
     * Get the classroom's teacher model
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the classroom's type model
     */
    public function classroomType()
    {
        return $this->belongsTo(ClassroomType::class, 'type_id');
    }

    /**
     * Get the classroom attachment
     */
    public function attachment()
    {
        return $this->hasOne(Attachment::class);
    }

}
