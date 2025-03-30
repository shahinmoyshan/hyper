<?php

namespace App\Models;

use Hyper\Model;

class User extends Model
{
    public static string $table = 'users';

    protected array $guarded = [];
}