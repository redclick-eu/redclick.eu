@extends('layouts.app')

@section('content')
    @include("components.breadcrumbs")
    @include("components.title", ["text" => wpcl_t("Page not found")])
    @include("blocks.services")
    @include('blocks.callback')
@endsection
