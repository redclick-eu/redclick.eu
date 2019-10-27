@include("partials.title", ["text" => "Reviews"])
<div class="reviews siema-carousel">
    <div class="reviews-row">
        <div class="reviews-arrow reviews-arrow_left siema-arrow_left"></div>
        <div class="reviews-carousel siema-inner">
            @foreach($reviews_block as $review)
                <div class="reviews-item">
                    <div class="reviews-photo">
                        <img src="{!! $review['photo']['url'] !!}" alt="{!! $review['photo']['alt'] !!}">
                    </div>
                    <div class="reviews-texts">
                        <p class="reviews-text">{!! $review['text'] !!}<a href="{!! $review['link'] !!}#review" class="reviews-linkToFull">...</a>
                        </p>
                        <div class="reviews-name">{!! $review['client_name'] !!}, <a href="{!! $review['link'] !!}">{!! $review['company_name'] !!}</a></div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="reviews-arrow reviews-arrow_right siema-arrow_right"></div>
    </div>
</div>