<?php

namespace App\Policies;

use App\Models\Teacher;
use Illuminate\Auth\Access\HandlesAuthorization;

class TeacherPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\Teacher  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(Teacher $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\Teacher  $user
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(Teacher $user, Teacher $teacher)
    {
        /* user is the current user login by Auth
         * teacher is the passed parameter from controller
         * only individual can view his detail
        */ 
        return $user->id == $teacher->id;
        // return $user->isAdmin
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\Teacher  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(Teacher $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\Teacher  $user
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(Teacher $user, Teacher $teacher)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\Teacher  $user
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(Teacher $user, Teacher $teacher)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\Teacher  $user
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(Teacher $user, Teacher $teacher)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\Teacher  $user
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(Teacher $user, Teacher $teacher)
    {
        //
    }
}
