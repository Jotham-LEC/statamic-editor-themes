<?php

namespace JothamLec\EditorThemes\Commands;

use Statamic\Contracts\Auth\User as UserContract;
use Statamic\Facades\User;

trait FindsUser
{
    /** The user named by email, or a site's only user. */
    private function user(): ?UserContract
    {
        if ($email = $this->argument('email')) {
            $user = User::findByEmail($email);
            $user ?? $this->components->error("No user has the email {$email}.");

            return $user;
        }

        $users = User::all();

        if ($users->count() !== 1) {
            $this->components->error('Name the user by email: this site has '.$users->count().' users.');

            return null;
        }

        return $users->first();
    }
}
