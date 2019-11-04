@extends('layouts.app')

@section('content')
    @include("partials.title", ["text" => wpcl_t("Search")])

    <div class="contacts">
        @if(!empty($items))
            <ul class="contacts-row">
                @foreach($items as $item)
                    <li class="contacts-item">
                        <a href="{!! $item['link'] !!}">{!! $item['title'] !!}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="contacts-row">
                <div class="contacts-item">
                    {!! wpcl_t("Sorry, no results were found for your request.") !!}
                </div>
            </div>
        @endif
    </div>
@endsection
