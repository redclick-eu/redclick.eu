@include("partials.title", ["text" => "Services"])

<div class="services">
    <div class="services-row">
        <div class="services-col">
            <div class="services-card services-card_design">
                <h4 class="services-title">Design</h4>
                <ul class="services-list">
                    @foreach($services_block["design"] as $post)
                        <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="services-col">
            <div class="services-card services-card_development">
                <h4 class="services-title">Development</h4>
                <ul class="services-list">
                    @foreach($services_block["development"] as $post)
                        <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="services-col">
            <div class="services-card services-card_promotion">
                <h4 class="services-title">Promotion</h4>
                <ul class="services-list">
                    @foreach($services_block["promotion"] as $post)
                        <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="services-col">
            <div class="services-card services-card_support">
                <h4 class="services-title">Support</h4>
                <ul class="services-list">
                    @foreach($services_block["support"] as $post)
                        <li class="services-item"><a href="{!! $post["link"] !!}" class="services-link">{!! $post["title"] !!}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>