<?php
namespace App\Enum;


enum UserRoleEnum:string
{
    case ROLE_ADMIN = 'ROLE_ADMIN';
    case ROLE_OWNER = 'ROLE_OWNER';
    case ROLE_CUSTOMER = 'ROLE_CUSTOMER';
}
