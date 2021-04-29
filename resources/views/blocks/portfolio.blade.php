<div class="portfolio js-portfolio">
        <ul class="portfolio-menu js-portfolio-menu">
            <li class="portfolio-menuItem is-active js-portfolio-selector" data-selector="all">
                <a href="#">{!! wpcl_t("All") !!}</a>
            </li>
            <li class="portfolio-menuItem js-portfolio-selector" data-selector="design">
                <a href="#">
                    {!! wpcl_t("Design") !!}
                </a>
            </li>
            <li class="portfolio-menuItem js-portfolio-selector" data-selector="development">
                <a href="#">
                    {!! wpcl_t("Development") !!}
                </a>
            </li>
            <li class="portfolio-menuItem js-portfolio-selector" data-selector="promotion">
                <a href="#">
                    {!! wpcl_t("Promotion") !!}
                </a>
            </li>
            <li class="portfolio-menuItem js-portfolio-selector" data-selector="support">
                <a href="#">
                    {!! wpcl_t("Support") !!}
                </a>
            </li>
        </ul>
        <ul class="portfolio-grid">
            @foreach($portfolio_block as $item)
                <li class="portfolio-item js-portfolio-item is-active js-grid-all {!! implode(" js-grid-", $item['types']) !!}"
                    style="background-image: url('{!! $item['logo'] !!}')">
                    <a href="{!! $item['link'] !!}" class="portfolio-link">
                        <div class="portfolio-info">
                            <h4>{!! $item['title'] !!}</h4>
                            <span>{!! $item['desc'] !!}</span>
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
</div>
