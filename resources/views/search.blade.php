@extends('layouts.app')

@section('content')
    @include("components.title", ["text" => wpcl_t("Search")])
    @include("blocks.page.search")
@endsection
