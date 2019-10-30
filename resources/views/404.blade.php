@extends('layouts.app')

@section('content')
    @include("partials.title", ["text" => wpcl_t("Page not found")])
    @include("partials.services")
@endsection
