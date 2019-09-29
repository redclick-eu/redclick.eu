@extends('layouts.app')

@section('content')
    <main class="main">
        @include("partials.services")
        @include("partials.portfolio")
        @include("partials.reviews")
        @include("partials.contacts")
    </main>
@endsection
