<?php
namespace App\Enums;

enum UsersRolesEnum: string
{
    case USER="User";
    case MODERATOR="Moderator";
    case ADMIN="Admin";
}
