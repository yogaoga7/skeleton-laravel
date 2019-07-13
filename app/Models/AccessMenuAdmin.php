<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccessMenuAdmin extends Model
{
    protected $fillable = [
        'role_id',
        'uniqkey',
        'url'
      ];
}
