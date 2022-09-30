<?php

namespace App\Policies;

use App\Models\HrmWeeklyScheduleTemplate;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class HrmWeeklyScheduleTemplatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['organizationAdmin']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        return $user->hasAnyRole(['organizationAdmin']) && $hrmWeeklyScheduleTemplate->clinic->organization_id == $user->organization->id;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['organizationAdmin']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        return $user->hasAnyRole(['organizationAdmin']);
        //return true;//$user->hasAnyRole(['organizationAdmin']) && $hrmWeeklyScheduleTemplate->clinic->organization_id == $user->organization->id;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        return $user->hasAnyRole(['organizationAdmin']) && $hrmWeeklyScheduleTemplate->clinic->organization_id == $user->organization->id;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        return $user->hasAnyRole(['organizationAdmin']) && $hrmWeeklyScheduleTemplate->clinic->organization_id == $user->organization->id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\HrmWeeklyScheduleTemplate  $hrmWeeklyScheduleTemplate
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, HrmWeeklyScheduleTemplate $hrmWeeklyScheduleTemplate)
    {
        return $user->hasAnyRole(['organizationAdmin']) && $hrmWeeklyScheduleTemplate->clinic->organization_id == $user->organization->id;
    }
}
