@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/realtors/index.css') }}">
@section('title', 'Риелторы')
@section('content')
    <div class="main-container pd">
        {{--BLOCK--}}
        <div class="flex-block">
            {{--HEADERS--}}
            <div class="headers">
                <h3>Риелторы</h3>
            </div>

            {{--REALTORS--}}
            <div class="flex-block__inner">
                @forelse($realtors as $realtor)
                    {{--REALTOR--}}
                    <div class="inner__realtor common">
                        <img src="{{ $realtor->image }}" alt="Фотография">
                        <div>
                            <h5>{{ $realtor->fullName }}</h5>
                            <div class="realtor__info">
                                <div>
                                    <p>E-mail: {{ $realtor->email }}</p>
                                    <p>Телефон: {{ $realtor->telephone }}</p>
                                </div>
                                <p>Объявлений всего: {{ count($realtor->ads) }}</p>
                                <a href="{{ route('users.realtors.ads', $realtor->id) }}" class="btn btn-outlined">Посмотреть объявления</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="message-empty common">
                        <p>Нет риелторов</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
