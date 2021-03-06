
@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Dashboard widget</h4>
                    <div class="list-group rounded-0">
                      @foreach($roles as $role)
                        <a href="{{ $user->can('attach-dashboard') ? url('/administrator/access/dashboard/' . $role->id) : 'javascript:alert(\'Forbidden access\');' }}" class="list-group-item list-group-item-action">{{ $role->name }}</a>
                      @endforeach
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@stop