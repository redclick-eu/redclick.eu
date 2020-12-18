<div class="carousel siema-carousel">
    <div class="carousel-arrow carousel-arrow_left siema-arrow_left"></div>
    <div class="carousel-carouselInner siema-inner">
        @foreach($images as $image)
            <img src="{!! $image['url'] !!}" alt="{!! $image['alt'] !!}">
        @endforeach
    </div>
    <div class="carousel-arrow carousel-arrow_right siema-arrow_right"></div>
</div>