<div class="carousel carousel_fullwidth @if($separate_arrows) carousel_separateArrows @endif siema-carousel"
     data-settings='{"intervalMilliseconds": 5000}'>
    <div class="carousel-inner siema-inner">
        @foreach($images as $image)
            <img src="{!! $image['url'] !!}" alt="{!! $image['alt'] !!}">
        @endforeach
    </div>
    <div class="carousel-dots siema-dots"></div>
    <button class="carousel-arrow carousel-arrow_left siema-arrow_left" aria-label="left"></button>
    <button class="carousel-arrow carousel-arrow_right siema-arrow_right" aria-label="right"></button>
</div>
