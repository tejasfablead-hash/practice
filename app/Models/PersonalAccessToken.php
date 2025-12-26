<?php

namespace App\Models;

use Laravel\Sanctum\Sanctum;

use Illuminate\Database\Eloquent\Model;

class PersonalAccessToken extends Model
{
    public function boot(): void
    {
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
