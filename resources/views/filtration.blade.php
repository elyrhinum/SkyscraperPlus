@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', 'ВысоткаПлюс')
@section('content')
    <!-- BANNER -->
    <div class="main-banner">
        <img src="{{ asset('/media/images/banner.jpg') }}" alt="Баннер">
    </div>

    <!-- SEARCH FORM -->
    <div class="search pd">
        @include('inc.filter')
    </div>


@endsection
