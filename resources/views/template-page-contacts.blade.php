{{--
  Template Name: Contacts
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    @include("components.breadcrumbs", ["is_blue" => true])
    @include("components.title", ["text" => wpcl_t("Contacts"), "is_blue" => true])
    @include('blocks.contacts', ["is_blue" => true])
    @include('blocks.callback')
@endsection
