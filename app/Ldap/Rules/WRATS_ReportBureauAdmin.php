<?php

namespace App\Ldap\Rules;

use Illuminate\Database\Eloquent\Model as Eloquent;
use LdapRecord\Laravel\Auth\Rule;
use LdapRecord\Models\Model as LdapRecord;

class WRATS_ReportBureauAdmin implements Rule
{
    /**
     * Check if the rule passes validation.
     */
    public function passes(LdapRecord $user, ?Eloquent $model = null): bool
    {
        $WRATS_ReportBureauAdmin = Group::find('cn=WRATS_ReportBureauAdmin,dc=local,dc=com');

        return $user->groups()->recursive()->exists($WRATS_ReportBureauAdmin);
    }
}
