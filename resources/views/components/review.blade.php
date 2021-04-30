<div class="review @if(isset($is_blue) && $is_blue) review_blue @endif">
    <div class="review-container">
        <div class="review-photo">
            <img src="{!! $post_vars['review']['photo']['url'] !!}" alt="{!! $post_vars['review']['photo']['alt'] !!}">
        </div>
        <div class="review-texts">
            <div class="review-text">
                {!! $post_vars['review']['text'] !!}
            </div>
            <div class="review-name">
                <span>{!! $post_vars['review']['name'] !!}</span>
            </div>
        </div>
    </div>
</div>
