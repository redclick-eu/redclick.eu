{{--
  Template Name: Text
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    @include("components.title", ["text" => get_the_title()])
    @include('blocks.page.text')
    @include('blocks.callback')
@endsection
