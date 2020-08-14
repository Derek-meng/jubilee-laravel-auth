<?php

namespace Jubilee\Auth\Entries;

use Illuminate\Foundation\Auth\User;

abstract class CitizenORM extends User
{
    use ORMDocHelp;
}
