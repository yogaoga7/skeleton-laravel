
@extends('admin.layouts.master')

@section('content')

<div class="row justify-content-md-center">
    <div class="col col-lg-6">
        <div class="card">
			<form action="" method="post">
				@csrf
				@method('PUT')
				<div class="card-body">
					<h4 class="card-title">{{ $role->name }} can receipt</h4>

					<div class="accordion" id="accordionExample">
							@foreach($notifications as $title => $items)
								<div class="card">
									<div class="card-header" id="headingOne{{ str_slug($title) }}">
										<a href="#" data-toggle="collapse" data-target="#collapseOne{{ str_slug($title) }}" aria-expanded="true" aria-controls="collapseOne{{ str_slug($title) }}">
											+ {{ $title }}
										</a>
									</div>

								<div id="collapseOne{{ str_slug($title) }}" class="collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne{{ str_slug($title) }}" data-parent="#accordionExample">
										<div class="card-body">
											<ul>
												@foreach($items as $item)
													<li title="{{ $item['slug'] }}">
														<input type="checkbox" name="notifications[]" value="{{ $item['slug'] }}" {{ in_array($item['slug'], $role->notifications->toArray()) ? 'checked' : '' }}>
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
					<button type="submit" class="btn btn-primary">Save update</button>
				</div>
			</form>
        </div>
    </div>
</div>

@stop