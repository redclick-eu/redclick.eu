{{--
  Template Name: Portfolio
  Template Post Type: post
--}}

@extends('layouts.app')

@section('content')
    @include('components.breadcrumbs')
    @include('blocks.post.portfolio')
    @include("components.title", ["text" => $post_vars['title'], "is_blue" => true])
    @include("components.review", ["is_blue" => true])
    @include('blocks.callback')
@endsection

