<div class="carousel carousel_reviews siema-carousel">
    <div class="carousel-inner siema-inner">
        @foreach($reviews_block as $review)
            <div class="carousel-item">
                <div class="carousel-photo">
                    <img src="{!! $review['photo']['url'] !!}" alt="{!! $review['photo']['alt'] !!}">
                </div>
                <div class="carousel-texts">
                    <p class="carousel-text">{!! $review['text'] !!}<a href="{!! $review['link'] !!}#review" class="carousel-linkToFull">...</a>
                    </p>
                    <div class="carousel-name">{!! $review['client_name'] !!}, 
                        <a href="{!! $review['link'] !!}">{!! $review['company_name'] !!}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="carousel-arrow carousel-arrow_left siema-arrow_left"></div>
    <div class="carousel-arrow carousel-arrow_right siema-arrow_right"></div>
</div>
