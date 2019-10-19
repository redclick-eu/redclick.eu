@extends('layouts.app')

@section('content')
    @include("template-".get_field('template', get_queried_object()))
@endsection
