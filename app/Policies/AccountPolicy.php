<?php

namespace App\Policies;

use App\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any accounts.
     *
     * @param  \App\Account  $user
     * @return mixed
     */
    public function viewAny(Account $user)
    {
        //
    }

    /**
     * Determine whether the user can view the account.
     *
     * @param  \App\Account  $user
     * @param  \App\Account  $account
     * @return mixed
     */


    public function Doctor_related(Account $user){
        return $user->owner_type === "App\Doctor";
    }

     public function normalUser_related(Account $user){
        return $user->owner_type === "App\NormalUser";
    }



    public function view(Account $user, Account $account)
    {
        //
    }

    /**
     * Determine whether the user can create accounts.
     *
     * @param  \App\Account  $user
     * @return mixed
     */
    public function create(Account $user)
    {
        //
    }

    /**
     * Determine whether the user can update the account.
     *
     * @param  \App\Account  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function update(Account $user, Account $account)
    {
        //
    }

    /**
     * Determine whether the user can delete the account.
     *
     * @param  \App\Account  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function delete(Account $user, Account $account)
    {
        //
    }

    /**
     * Determine whether the user can restore the account.
     *
     * @param  \App\Account  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function restore(Account $user, Account $account)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the account.
     *
     * @param  \App\Account  $user
     * @param  \App\Account  $account
     * @return mixed
     */
    public function forceDelete(Account $user, Account $account)
    {
        //
    }
}
