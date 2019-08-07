<?php

namespace App\Http\Controllers\Admin\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Gate;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        $infaqs = User::all();

        return DataTables::of($infaqs)
            ->addColumn('action', function ($infaq){
                return view('admin.infaq._button._action', [
                    'model_button'      => $infaq,
                    'edit_button'       => route('master-infaq.edit', $infaq->id),
                    'delete_button'     => route('master-infaq.destroy', $infaq->id),
                    'show_button'     => route('infaq-packages.show', $infaq->id),
                    'url_access_role'   => url('administrator/access/role', $infaq->id),
                    'url_access_permissions'   => url('administrator/access/permission', $infaq->id),
                ]);
            })
            ->addColumn('created_at', function ($infaq){
                return $infaq->created_at->format('d F Y \a\t h:i A');
            })
            ->addColumn('description', function ($infaq) {
                return (strlen($infaq->description) > 13) ? substr($infaq->description,0,10).'...' : $infaq->description;
            })
            ->escapeColumns([])
            ->make(true);
    }
}
