@extends('admin.layouts.master')
@section('title', 'Assign Permission')

@section('content')

<div class="row justify-content-md-center">
    <div class="col col-lg-6">
        <div class="card">
            <form action="" method="post">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <h4 class="card-title">{{ $role->name }} permission</h4>

                    <div class="accordion" id="accordionExample">
                        @foreach($permissions as $title => $items)
                        <div class="card">
                            <div class="card-header" id="headingOne{{ str_slug($title) }}">
                                <h2 class="mb-0">
                                    <button class="btn btn-white" type="button" data-toggle="collapse"
                                        data-target="#collapseOne{{ str_slug($title) }}" aria-expanded="true"
                                        aria-controls="collapseOne{{ str_slug($title) }}">
                                        + {{ $title }}
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne{{ str_slug($title) }}"
                                class="collapse {{ $loop->first ? 'show' : '' }}"
                                aria-labelledby="headingOne{{ str_slug($title) }}" data-parent="#accordionExample">
                                <div class="card-body">
                                    <ul>
                                        @foreach($items as $item)
                                        <li title="{{ $item['slug'] }}">
                                            <input type="checkbox" name="permissions[]" value="{{ $item['slug'] }}"
                                                {{ in_array($item['slug'], $role->permissions->toArray()) ? 'checked' : '' }}>
                                            <strong>{{ $item['name'] }}</strong>
                                            <small class="text-muted float-right">{{ $item['slug'] }}</small>
                                            <p>{{ $item['description'] }}</p>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-link">{{ __('Cancel') }}</a>
                    <button type="submit" class="btn btn-primary">Save access</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
