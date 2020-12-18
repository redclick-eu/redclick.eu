@include("partials.title", ["text" => $post_vars['title']])

<div class="post post_portfolio">
    <div class="post-container">
        <div class="post-row">
            <div class="post-site"><a href="{!! $post_vars['site_url'] !!}">{!! $post_vars['site'] !!}</a></div>
            <div class="post-services"><span>{!! $post_vars['services'] !!}</span></div>
            @if(!empty($post_vars['carousel']))
                @include('partials.carousel', ['images' => $post_vars['carousel']])
            @endif
            <div class="post-text post-text_task">
                <h6>{!! wpcl_t("Task") !!}</h6>
                {!! $post_vars['text']['task'] !!}
            </div>
            <div class="post-text post-text_solution">
                <h6>{!! wpcl_t("Solution") !!}</h6>
                {!! $post_vars['text']['solution'] !!}
            </div>
            <div class="post-text post-text_result">
                <h6>{!! wpcl_t("Result") !!}</h6>
                {!! $post_vars['text']['result'] !!}
            </div>
        </div>
    </div>
</div>

@include("partials.review")