@extends('layouts.app')

@section('content')
    <main class="main">
        @include("components.title", ["text" => wpcl_t("Services"), "size" => 2])
        @include("blocks.services")
        @include("components.title", ["text" => wpcl_t("Portfolio"), "size" => 2])
        @include("blocks.portfolio", ["more_btn" => true])
        @include("components.title", ["text" => wpcl_t("Reviews"), "size" => 2])
        @include("blocks.reviews")
        @include("components.title", ["text" => wpcl_t("Contacts"), "size" => 2])
        @include("blocks.contacts")
        @include("blocks.callback")
    </main>
@endsection
