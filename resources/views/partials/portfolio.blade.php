@include("partials.title", ["text" => "Portfolio"])
<div class="portfolio js-portfolio">
    <div class="portfolio-row">
        <ul class="portfolio-menu js-portfolio-menu">
            <li class="portfolio-menuItem is-active" data-grid="all">All</li>
            <li class="portfolio-menuItem" data-grid="design">Design</li>
            <li class="portfolio-menuItem" data-grid="development">Development</li>
            <li class="portfolio-menuItem" data-grid="promotion">Promotion</li>
            <li class="portfolio-menuItem" data-grid="support">Support</li>
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