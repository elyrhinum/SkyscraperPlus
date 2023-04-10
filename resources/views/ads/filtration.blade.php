@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', 'Результаты поиска')
@section('content')
    <div class="main-container filtered-ads">
        {{--FILTER--}}
        <div class="search pd">
            @include('inc.filter')
        </div>

        {{--FILTER RESULT--}}
        <div class="filter-result pd">
            <div class="filter-result__header">
                <h3>Результаты поиска</h3>
                <div class="header__inner">
                    <div>
                        <p>Найдено {{ count($ads) }} объявлений</p>
                    </div>
                    <div class="header__filters">
                        @foreach($filters as $filter)
                            <span>{{ $filter }}</span>
                        @endforeach
                    </div>
                </div>

            </div>

            @forelse($ads as $ad)
                {{--AD--}}
                @include('inc.ad')
            @empty
                <div class="message-empty common">
                    <p>Нет результатов</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
