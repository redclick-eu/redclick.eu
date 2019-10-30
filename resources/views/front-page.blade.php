@extends('layouts.app')

@section('content')
    <main class="main">
        @include("partials.title", ["text" => "Services"])
        @include("partials.services")
        @include("partials.title", ["text" => "Portfolio"])
        @include("partials.portfolio")
        @include("partials.reviews")
        @include("partials.title", ["text" => "Contacts"])
        @include("partials.contacts")
    </main>
@endsection
