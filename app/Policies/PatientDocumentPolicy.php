<?php

namespace App\Policies;

use App\Models\PatientDocument;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientDocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @return void|bool
     */
    public function before(User $user)
    {
        if ($user->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->hasAnyRole(['organizationAdmin', 'organizationManager', 'specialist']);
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientDocument  $patientDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, PatientDocument $patientDocument)
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->hasAnyRole(['organizationAdmin', 'organizationManager', 'specialist']);
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientDocument  $patientDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, PatientDocument $patientDocument)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientDocument  $patientDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, PatientDocument $patientDocument)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientDocument  $patientDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, PatientDocument $patientDocument)
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\PatientDocument  $patientDocument
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, PatientDocument $patientDocument)
    {
        return false;
    }
}
