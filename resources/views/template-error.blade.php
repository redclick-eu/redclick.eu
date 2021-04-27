@if(WP_DEBUG)
    @php(var_dump(get_fields()))
@else
    Error 500
@endif
