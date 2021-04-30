<div class="post post_services">
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
            <div class="post-content">
                {!! $post_vars['content'] !!}
            </div>
            <div class="post-card post-card">
                <div class="post-cardIcon post-cardIcon_cost"></div>
                <div class="post-cardInfo">
                    <h6>{!! wpcl_t("Cost") !!}</h6>
                    <span>{!! $post_vars['cost'] !!} {!! wpcl_t("€") !!}</span>
                </div>
            </div>
            <div class="post-card post-card">
                <div class="post-cardIcon post-cardIcon_deadline"></div>
                <div class="post-cardInfo post-cardInfo_deadline">
                    <h6>{!! wpcl_t("Duration of work") !!}</h6>
                    <span>{!! str_replace("%%time%%", $post_vars['deadline'], wpcl_t("for %%time%% days")) !!}</span>
                </div>
            </div>
        </div>
    </div>
</div>
