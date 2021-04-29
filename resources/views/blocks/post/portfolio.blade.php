<div class="post post_portfolio">
    <div class="post-container">
        <div class="post-row">
            <h1 class="post-title">{!! $post_vars['title'] !!}</h1>
        </div>
    </div>
    <div class="post-carousel">
        @if(!empty($post_vars['carousel']))
            @include('blocks.carousel.fullwidth', [
                'images' => $post_vars['carousel'],
                'separate_arrows' => true
            ])
        @endif
    </div>
    <div class="post-container">
        <div class="post-row">
            <div class="post-text">
                <h6>{!! wpcl_t("Task") !!}</h6>
                {!! $post_vars['text']['task'] !!}
            </div>
            <div class="post-text">
                <h6>{!! wpcl_t("Solution") !!}</h6>
                {!! $post_vars['text']['solution'] !!}
            </div>
            <div class="post-text">
                <h6>{!! wpcl_t("Result") !!}</h6>
                {!! $post_vars['text']['result'] !!}
            </div>
        </div>
    </div>
</div>

@include("components.review")
