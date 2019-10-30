{{--
  Template Name: Contacts
  Template Post Type: page
--}}

@extends('layouts.app')

@section('content')
    @include("partials.title", ["text" => wpcl_t("Contacts")])
    @include('partials.contacts')
@endsection
