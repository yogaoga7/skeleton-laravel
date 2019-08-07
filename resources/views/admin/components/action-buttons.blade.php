@if( isset( $edit_url ) )
<a href="{!! empty( $edit_url ) ? 'javascript:void(0)' : $edit_url !!}" class="{!! empty( $edit_url ) ? 'disabled' : '' !!} btn btn-primary btn-icon rounded-circle" title="Edit" data-button="edit">
    <i class="fa fa-pencil text-inverse m-r-10"></i>
</a>
@endif
@if( isset( $show_url ) )
<a href="{!! empty( $show_url ) ? 'javascript:void(0)' : $show_url !!}" class="{!! empty( $show_url ) ? 'disabled' : '' !!} btn btn-info btn-icon rounded-circle" title="Detail" data-button="edit">
    <i class="fa fa-check text-inverse m-r-10"></i>
</a>
@endif
@if( isset( $delete_url ) )
    <a href="javascript:void(0)" id="deleteData" class="deleteData {!! empty( $delete_url ) ? 'disabled' : '' !!} btn btn-danger btn-icon rounded-circle" title="Delete" data-href="{!! empty( $delete_url ) ? 'javascript:void(0)' : $delete_url !!}" data-button="delete">
        <i class="fa fa-close text-danger m-r-10"></i>
    </a>
@endif
