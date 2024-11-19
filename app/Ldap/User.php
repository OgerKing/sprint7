<?php

namespace App\Ldap;

use LdapRecord\Models\Model;

class User extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;

    /**
     * The object classes of the LDAP model.
     */
    public static array $objectClasses = [];
}
