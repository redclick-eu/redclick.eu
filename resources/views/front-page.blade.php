@extends('layouts.app')

@section('content')
    <main class="main">
        @include("blocks.carousel.fullwidth", ["images" => $carousel_images, "hide_on_small_screen" => true])
        @include("components.title", ["text" => wpcl_t("Services"), "size" => 2, "is_blue" => true])
        @include("blocks.services", ["is_blue" => true])
        @include("components.title", ["text" => wpcl_t("Portfolio"), "size" => 2])
        @include("blocks.portfolio", ["more_btn" => true])
        @include("components.title", ["text" => wpcl_t("Reviews"), "size" => 2, "is_blue" => true])
        @include("blocks.carousel.reviews", ["is_blue" => true])
        @include("components.title", ["text" => wpcl_t("Contacts"), "size" => 2])
        @include("blocks.contacts")
        @include("blocks.callback")
    </main>
@endsection
