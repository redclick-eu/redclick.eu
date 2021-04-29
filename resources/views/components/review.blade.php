@include("components.title", ["text" => $post_vars['title']])

<div class="review">
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
