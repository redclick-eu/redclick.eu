<div class="page page_search">
    @if(!empty($items))
        <ul class="page-row">
            @foreach($items as $item)
                <li class="page-item">
                    <a href="{!! $item['link'] !!}">{!! $item['title'] !!}</a>
                </li>
            @endforeach
        </ul>
    @else
        <div class="page-row">
            <div class="page-item">
                {!! wpcl_t("Sorry, no results were found for your request.") !!}
            </div>
        </div>
    @endif
</div>
