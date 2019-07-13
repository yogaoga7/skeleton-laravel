<?php 

  namespace App\Helpers;
  use App\Models\Role;

  trait PermissionUserTrait {
    
    public function hasReceive($notification) {
        $notificaitons = [];
        foreach($this->roles as $role) {
            foreach($role->notifications as $notif) {
                $notificaitons[] = $notif;
            }
        }

        return in_array($notification, $notificaitons);
    }

    public function dashboards() {
        $access = [];
        foreach($this->roles as $roles) {
            foreach($roles->dashboard_access as $acc) {
                $access[] = $acc;
            }
        }

        return $access;
    }

    public function roles() {
        return $this->belongsToMany(Role::class);        
    }

    public function menu_access() {
        $access = [];
        foreach($this->roles as $roles) {
            foreach($roles->access as $acc) {
                $access[] = $acc->uniqkey;
            }
        }

        return $access;
    }

  }

