@php
  $thead  = isset($thead) ? $thead : [];
  $class  = isset($class) ? $class : '';
  $options = isset($options) ? $options : [];
  $id = isset($id) ? $id : '';
  $name = isset($name) ? str_slug($name) : 'data-tables';
  $responsive = isset($responsive) ? $responsive : '';
@endphp


<div class="{{ $responsive }}">
  <table class="table {{ $name }} {{ $class }}" id="{{ $id }}" style="width:100%">
    <thead>
      <tr>
        @foreach($thead as $th)
          <th>{{ $th }}</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      {{ $slot }} 
    </tbody>
  </table>
</div>

@push('scripts')
  <script>
    var tables;
    $(function() {
       tables = $('.{{ $name }}').dataTable({!! collect($options)->toJson() !!});
    });
  </script>
@endpush