@include("partials.title", ["text" => $post_vars['title']])

<div class="post post_services">
    <div class="post-row">
        <div class="post-content">
            {!! $post_vars['content'] !!}
        </div>
        @if(!empty($post_vars['carousel']))
            <h2 class="post-title">Cases: </h2>
            @include('partials.carousel', ['images' => $post_vars['carousel']])
        @endif
        <div class="post-info">
            <div class="post-card post-card_cost">
                <h6>{!! wpcl_t("Cost") !!}</h6>
                <span>{!! $post_vars['cost'] !!}</span> <span>{!! wpcl_t("€") !!}</span>
            </div>
            <div class="post-card post-card_deadline">
                <h6>{!! wpcl_t("Duration of work") !!}</h6>
                <span>{!! str_replace("%%time%%", $post_vars['deadline'], wpcl_t("for %%time%% days")) !!}</span>
            </div>
        </div>
    </div>
</div>