{{--
  Template Name: Contacts
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    @include("components.breadcrumbs")
    @include("components.title", ["text" => wpcl_t("Contacts")])
    @include('blocks.contacts')
    @include('blocks.callback')
@endsection
