<?php

namespace App\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;

class WRATS_PDtBureauAdmin implements Rule
{
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, ?Eloquent $model = null): bool
    {
        $WRATS_PDtBureauAdmin = Group::find('cn=WRATS_PDtBureauAdmin,dc=local,dc=com');

        return $user->groups()->recursive()->exists($WRATS_PDtBureauAdmin);
    }
}
