<div class="services @if(isset($is_blue) && $is_blue) services_blue @endif">
    <div class="services-container">
        <div class="services-row">
            <div class="services-col">
                <div class="services-card services-card_design">
                    <h3 class="services-title">{!! wpcl_t("Design") !!}</h3>
                    <ul class="services-list">
                        @foreach($services_block["design"] as $post)
                            <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="services-col">
                <div class="services-card services-card_development">
                    <h3 class="services-title">{!! wpcl_t("Development") !!}</h3>
                    <ul class="services-list">
                        @foreach($services_block["development"] as $post)
                            <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="services-col">
                <div class="services-card services-card_promotion">
                    <h3 class="services-title">{!! wpcl_t("Promotion") !!}</h3>
                    <ul class="services-list">
                        @foreach($services_block["promotion"] as $post)
                            <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="services-col">
                <div class="services-card services-card_support">
                    <h3 class="services-title">{!! wpcl_t("Support") !!}</h3>
                    <ul class="services-list">
                        @foreach($services_block["support"] as $post)
                            <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
