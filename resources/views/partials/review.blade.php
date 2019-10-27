<div class="review" id="review">
    <div class="review-container">
        <div class="review-row">
            <div class="review-image">
                <img src="{!! $post_vars['review']['photo']['url'] !!}" alt="{!! $post_vars['review']['photo']['alt'] !!}">
            </div>
            <div class="review-text">
                {!! $post_vars['review']['text'] !!}
                <span>{!! $post_vars['review']['name'] !!}</span>
            </div>
        </div>
    </div>
</div>