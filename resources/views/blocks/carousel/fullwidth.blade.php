<div class="carousel carousel_fullwidth siema-carousel
    @if(isset($separate_arrows) && $separate_arrows) carousel_separateArrows @endif
    @if(isset($hide_on_small_screen) && $hide_on_small_screen) carousel_hideOnSmallScreen @endif
    "
     data-settings='{"intervalMilliseconds": 5000}'>
    <div class="carousel-inner siema-inner">
        @foreach($images as $image)
            <div class="carousel-item">
                <img
                    src="{!! $image['src'] !!}"
                    alt="{!! $image['alt'] !!}"
                    @if(isset($image['srcset'])) srcset="{!! $image['srcset'] !!}" @endif
                    @if(isset($image['sizes'])) sizes="{!! $image['sizes'] !!}" @endif>

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
