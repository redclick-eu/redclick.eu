<div class="languageSwitch">
    <div class="languageSwitch-current">{!! $wpml_current["native_name"] !!}</div>
    <div class="languageSwitch-arrow"></div>
    <ul class="languageSwitch-list">
        @foreach($wpml_languages as $lang)
            <li class="languageSwitch-item">
                <a href="{!! $lang['url'] !!}" class="languageSwitch-link">{!! $lang["translated_name"] !!}</a>
            </li>
        @endforeach
    </ul>
</div>