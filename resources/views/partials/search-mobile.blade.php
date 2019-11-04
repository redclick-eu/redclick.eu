<form id="form_mobileSearch" class="form_mobileSearch js-search-form <?= get_search_query() ? 'is-active' : '' ?>" role="search" method="get" action="<?= home_url('/'); ?>">
    <input class="form-input js-search" type="text" autocomplete="off" name="s" placeholder="" value="<?= get_search_query() ?>">
    <input class="form-loupe" type="submit" value="" data-toggle="#form_mobileSearch, #menu-mobile-logo">
    <input class="form-reset" type="reset" value="">
    <ul class="form-a-list js-search-list"></ul>
</form>