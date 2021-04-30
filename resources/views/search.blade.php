@extends('layouts.app')

@section('content')
    @include("components.breadcrumbs")
    @include("components.title", ["text" => wpcl_t("Search")])
    @include("blocks.page.search")
@endsection
