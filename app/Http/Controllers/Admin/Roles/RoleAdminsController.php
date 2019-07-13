<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Requests\Admins\RoleStoreRequest;
use App\Http\Requests\Admins\RoleUpdateRequest;
use Gate;
use App\Models\Role;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class RoleAdminsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Gate::denies('index-role-admin')) abort(403);

        if ($request->ajax()) return $this->datatables();

        return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Gate::denies('create-role-admin')) return abort(403);

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        if(Gate::denies('create-role-admin')) return abort(403);

        $role = new Role();
        $role->name = $request->name;
        $role->description = $request->description;
        $role->slug = $request->slug;
        $role->permissions = [];
        $role->save();

        session()->flash('alert', [
            'type' => 'success',
            'messages' => [
                "Successfully Created!"
            ]
        ]);

        return redirect()->route('roles.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Gate::denies('show-role-admin')) return abort(403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::denies('edit-role-admin')) return abort(403);

        $role = Role::find($id);

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        if(Gate::denies('edit-role-admin')) return abort(403);

        $role = Role::find($id);
        $role->name = $request->name;
        $role->description = $request->description;
        $role->update();

        session()->flash('alert', [
            'type' => 'success',
            'messages' => [
                "Successfully Updated!"
            ]
        ]);

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Gate::denies('destroy-role-admin')) return abort(403);

        try{

            $role = Role::find($id);
            $role->delete();

            session()->flash('alert', [
                'type' => 'success',
                'messages' => [
                    "Successfully Deleted!"
                ]
            ]);

            return redirect()->route('roles.index');

        }catch (Exception $e){

            session()->flash('alert', [
                'type' => 'danger',
                'messages' => [
                    $e->getMessage()
                ]
            ]);

            return redirect()->back();

        }
    }

    protected function datatables()
    {
        $roles = Role::all();

        return DataTables::of($roles)
            ->addColumn('action', function ($role){
                return view('admin.roles._button._action', [
                    'model_button'      => $role,
                    'edit_button'       => route('roles.edit', $role->id),
                    'delete_button'     => route('roles.destroy', $role->id),
                    'url_access_role'   => url('administrator/access/role', $role->id),
                    'url_access_permissions'   => url('administrator/access/permission', $role->id),
                ]);
            })->escapeColumns([])->make(true);
    }
}
