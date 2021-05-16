<div class="carousel carousel_fullwidth @if(isset($separate_arrows) && $separate_arrows) carousel_separateArrows @endif siema-carousel"
     data-settings='{"intervalMilliseconds": 5000}'>
    <div class="carousel-inner siema-inner">
        @foreach($images as $image)
            <div class="carousel-item">
                <img src="{!! $image['url'] !!}" alt="{!! $image['alt'] !!}">
                @if(isset($image['text']))
                    <div class="carousel-text">
                        <p>{!! $image['text'] !!}</p>
                    </div>
                @endif
            </div>
        @endforeach
    </div>

    @if(!isset($separate_arrows) || !$separate_arrows)
        <div class="carousel-dots siema-dots"></div>
    @endif

    <button class="carousel-arrow carousel-arrow_left siema-arrow_left" aria-label="left"></button>
    <button class="carousel-arrow carousel-arrow_right siema-arrow_right" aria-label="right"></button>
</div>
