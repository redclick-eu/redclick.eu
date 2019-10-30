@extends('layouts.app')

@section('content')
    <main class="main">
        @include("partials.title", ["text" => wpcl_t("Services")])
        @include("partials.services")
        @include("partials.title", ["text" => wpcl_t("Portfolio")])
        @include("partials.portfolio")
        @include("partials.reviews")
        @include("partials.title", ["text" => wpcl_t("Contacts")])
        @include("partials.contacts")
    </main>
@endsection
