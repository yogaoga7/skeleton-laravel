<?php

namespace App\Http\Controllers\Admin\Roles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gate;
use Permission;
use App\Models\Role;
use App\Models\AccessMenuAdmin;

class AccessModuleController extends Controller {

    protected $role;
    protected $access;
    protected $permissions;

    public function __construct(Role $role, AccessMenuAdmin $access) {
        $this->role = $role;
        $this->access = $access;
        $this->permissions = Permission::original();
    }

    public function role() {
        $data['roles'] = $this->role->all();
        $data['user'] = auth()->user();
        return view('admin.access.role.role', $data);
    }

    public function role_assign ($id) {
        if(!Gate::allows('attach-role-access')) {
            return abort(403);
        }
        $data['role'] = $this->role->findOrFail($id);
        return view('admin.access.role.assign', $data);
    }

    public function role_assign_update(Request $request, $id) {
        if(!Gate::allows('attach-role-access')) {
            return abort(403);
        }
        if(isset($request->menus) && is_array($request->menus)) {
            if(count($request->menus) > 0) {
                $this->access->where('role_id', $id)->delete();
                foreach($request->menus as $item) {
                    $menu = json_decode($item);
                    $this->access->create([
                        'role_id' => $id,
                        'uniqkey' => $menu->uniqkey,
                        'url' => $menu->url
                    ]);
                }
            }
        }

        session()->flash('alert', [
            'type' => 'success',
            'messages' => ['Update has been successfully']
        ]);
        flash('Update has been successfully', 'success');

        return redirect()->back();
    }

    public function permission(){
        $data['roles'] = $this->role->all();
        $data['user'] = auth()->user();
        return view('admin.access.permission.role', $data);
    }
    public function permission_assign($id){
        if(!Gate::allows('attach-permission-access')) {
            return abort(403);
        }
        $data['role'] = $this->role->findOrFail($id);
        $data['permissions'] = $this->permissions;
        
        return view('admin.access.permission.assign', $data);
    }
    public function permission_assign_update(Request $request, $id){
        if(!Gate::allows('attach-permission-access')) {
            return abort(403);
        }
        if(isset($request->permissions) && is_array($request->permissions)) {
            if(count($request->permissions) > 0) {
                $this->role->findOrFail($id)->update([
                    'permissions' => $request->permissions
                ]);
            }
        }

        session()->flash('alert', [
            'type' => 'success',
            'messages' => ['Update has been successfully']
        ]);

        return redirect()->back();

    }
}
