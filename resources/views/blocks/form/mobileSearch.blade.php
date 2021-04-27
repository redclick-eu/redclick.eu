<form id="form_mobileSearch" class="form_mobileSearch js-search-form {!! get_search_query() ? 'is-active' : '' !!}"
      data-settings='@json(['list_size' => 4, 'live_search_url' => get_rest_url( 0, '/site/v1/live_search' )])'
      role="search" method="get" action="{!! home_url('/') !!}">
    <input class="form-input js-search-input" type="text" autocomplete="off" name="s" placeholder="" value="{!! get_search_query() !!}">

    <input class="form-loupe js-search-loupe {!! get_search_query() ? 'is-active' : '' !!}" type="button" value=""
           data-toggle="#form_mobileSearch, #menu-mobile-logo">
    <input class="form-reset js-search-reset" type="reset" value="">

    <ul class="form-list js-search-list"></ul>
</form>
