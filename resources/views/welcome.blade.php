@extends('layout.master')

@section('title', 'Home')

@section('slideshow')
  @include('includes.sidebar')
@endsection

@section('content')

 @include('includes.suggestions')

@endsection
