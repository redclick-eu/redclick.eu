@extends('layouts.app')

@section('content')
    <main class="main">
        @include("partials.title", ["text" => wpcl_t("Services"), "size" => 2])
        @include("partials.services")
        @include("partials.title", ["text" => wpcl_t("Portfolio"), "size" => 2])
        @include("partials.portfolio")
        @include("partials.title", ["text" => wpcl_t("Reviews"), "size" => 2])
        @include("partials.reviews")
        @include("partials.title", ["text" => wpcl_t("Contacts"), "size" => 2])
        @include("partials.contacts-info")
    </main>
@endsection
