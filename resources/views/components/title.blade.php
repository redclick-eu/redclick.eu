@php($size = isset($size) && !empty($size) ? $size : 1)
<div class="title @if(isset($is_blue) && $is_blue) title_blue @endif">
    <div class="title-container">
        <h{!! $size !!} class="title-text">{!! $text !!}</h{!! $size !!}>
    </div>
</div>
