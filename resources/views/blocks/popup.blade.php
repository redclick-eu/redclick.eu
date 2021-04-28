<div class="popup" {!! isset($id) ? "id='$id'" : '' !!}>
    <div class="popup-body">
        <div class="popup-header">
            <h3 class="popup-title">{!! $title !!}</h3>
            <button class="popup-closeBtn" data-toggle="" data-toggle-settings='{"types": ["clear"]}'></button>
        </div>
        <div class="popup-content">
            {!! $content !!}
        </div>
    </div>

    <div class="popup-backdrop" data-toggle="" data-toggle-settings='{"types": ["clear"]}'></div>
</div>
