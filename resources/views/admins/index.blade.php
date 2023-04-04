@extends('templates.admin')
<link rel="stylesheet" href="{{ asset('css/admins/index.css') }}">
@section('title', 'Панель администратора')
@section('content')
    <div class="main-container">
        {{--NAVBAR--}}
        @include('inc.admins.navbar')

        {{--CONTENT--}}
        <div>
            {{--HEADER--}}
            <h5>Панель адмиинистратора</h5>

            {{--LAST UPDATES--}}
            <div class="updates">
                <div class="updates__ads">
                    @if (count($ads->where('status_id', 2)) > 0)
                        <div>
                            <p class="ads__title">Количество объявлений требующих рассмотрения</p>
                            <p class="ads__count">{{ count($ads->where('status_id', 2)) }}</p>
                        </div>
                        <a href="{{ route('admins.ads.onlySuggested') }}" class="btn btn-filled">Посмотреть</a>
                    @else
                        <p>Нет объявлений требущих рассмотрения</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
