<?php

namespace BitPixel\SpringCms\Utility;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use BitPixel\SpringCms\Models\Role;

class RolesCache
{


    public static function hasPermission($permission, $type)
    {
        $role = self::getAuthRole();
        $user = Auth::guard('admins')->user();
        if ($user->is_developer) return true;

        if ($role == null) return false;

        $check = $role->permissions->first(function ($value, $key) use($permission, $type){
            return (($value->permission == $permission)
                && ($value->type == $type));
        });

        if ($check) return true;

        return false;
    }

    public static function isDeveloper()
    {
        $user = Auth::guard('admins')->user();
        return (bool)$user->is_developer;
    }

    public static function getAuthRole()
    {
        $user = Auth::guard('admins')->user();
        $role_id = $user->role_id;
        return Cache::rememberForever('_permissions', function () use ($role_id) {
            return Role::with('permissions')
                ->where('id', $role_id)
                ->first();
        });
    }

    public static function forgetCache()
    {
        Cache::forget('_permissions');
    }
}
