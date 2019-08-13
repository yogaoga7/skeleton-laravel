<div class="form-group">
    <label> Name *</label>
    {!! Form::text('name', old('name'), [ 'class' => 'form-control' ]) !!}
</div>

<div class="form-group">
    <label> Description *</label>
    {!! Form::textarea('description', old('description'), [ 'class' => 'form-control', 'rows' => '2x4' ]) !!}
</div>


<div class="form-group">
    <button class="btn btn-primary"> Save </button>
</div>