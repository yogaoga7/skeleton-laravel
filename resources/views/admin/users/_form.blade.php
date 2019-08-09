<div class="form-group">
    <label> Name </label>
    {!! Form::text('name', old('name'), [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Email </label>
    {!! Form::text('email', old('email'), [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Password </label>
    {!! Form::password('password', [ 'class' => 'form-control' ]) !!}
</div>
<div class="form-group">
    <label> Assign Role </label>
    {!! Form::select('role_id', $roles, old('role_id'), [ 'class' => 'form-control' ]) !!}
</div>

<div class="form-group">
    <button class="btn btn-primary"> Save </button>
</div>