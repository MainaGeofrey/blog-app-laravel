<?php

namespace App\Models\UserManagement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'profiles';

    public function permissions()
    {
        return $this ->belongsToMany('App\Models\UserManagement\Permission')->withTimestamps();

    }

    public function user()
    {
        return $this ->belongsToMany('App\Models\UserManagement\User')->withTimestamps();
    }

    //add a new permission to the specified profile
    //this method can be in the controller
    public function allowTo($permission)
    {
        return $this->permissions()->save($permission);
    }
}
