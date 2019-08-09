<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Models\Role;

use DataTables;
use Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(!Gate::allows('index-user-admin')) {
            return abort(403);
        }

        if (request()->ajax()) {
            return $this->datatables();
        }

        return view('admin.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Gate::allows('create-user-admin')) {
            return abort(403);
        }

        $roles = Role::whereState('active')->pluck('name', 'id');

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $request->merge([ 'password' => bcrypt($request->password) ]);

            $user = User::create($request->all());

            $user->roles()->attach($request->role_id);

            flash('Account '. $user->email.' successfully created', 'success');
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            flash('Failed '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!Gate::allows('show-user-admin')) {
            return abort(403);
        }

        $user = User::findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!Gate::allows('edit-user-admin')) {
            return abort(403);
        }
        
        $user = User::findOrFail($id);
        $roles = Role::whereState('active')->pluck('name', 'id');

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = bcrypt($request->password);
            }
            $user->save();
            $user->roles()->attach($request->role_id);

            flash('Account '. $user->email.' successfully updated', 'success');

            return redirect()->back();
        } catch (\Exception $e) {
            flash('Failed '. $e->getMessage(), 'error');
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function datatables()
    {
        $user = User::all();

        return DataTables::of($user)
            ->addColumn('action', function ($infaq){
                return view('admin.components.action-buttons', [
                    'edit_url'       => route('admin.users.edit', $infaq->id),
                    'delete_url'     => route('admin.users.destroy', $infaq->id),
                    'show_url'     => route('admin.users.show', $infaq->id)
                ]);
            })
            ->addColumn('created_at', function ($infaq){
                return $infaq->created_at->format('d F Y \a\t h:i A');
            })
            ->escapeColumns([])
            ->make(true);
    }
}
