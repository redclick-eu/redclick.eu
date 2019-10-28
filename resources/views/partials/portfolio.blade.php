@include("partials.title", ["text" => "Portfolio"])
<div class="portfolio js-portfolio">
    <div class="portfolio-row">
        <ul class="portfolio-menu js-portfolio-menu">
            <li class="portfolio-menuItem is-active" data-grid="all">{!! wpcl_t("All") !!}</li>
            <li class="portfolio-menuItem" data-grid="design">{!! wpcl_t("Design") !!}</li>
            <li class="portfolio-menuItem" data-grid="development">{!! wpcl_t("Development") !!}</li>
            <li class="portfolio-menuItem" data-grid="promotion">{!! wpcl_t("Promotion") !!}</li>
            <li class="portfolio-menuItem" data-grid="support">{!! wpcl_t("Support") !!}</li>
        </ul>
        <ul class="portfolio-grid js-portfolio-grid">
            @foreach($portfolio_block as $item)
                <li class="portfolio-item {!! $item['types'] !!}">
                    <a href="{!! $item['link'] !!}" class="portfolio-link" style="background-image: url('{!! $item['logo'] !!}')">
                        <span>{!! $item['title'] !!}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>