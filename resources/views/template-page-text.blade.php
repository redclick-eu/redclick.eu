{{--
  Template Name: Text
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    @include("partials.title", ["text" => get_the_title()])
    @include('partials.text')
@endsection
