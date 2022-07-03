<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public function profiles()
    {
        return $this->belongsToMany('App\Models\UserManagement\Profile')->withTimestamps();
    }
}
