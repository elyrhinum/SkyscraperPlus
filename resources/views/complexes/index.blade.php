@extends('templates.app')
@section('title', 'Жилые комплексы')
@section('content')
    <div class="main-container pd">
        <div class="flex-block">
            {{--HEADER--}}
            <div class="headers">
                <h3>Каталог жилых комплексов</h3>
            </div>

            {{--COMPLEXES--}}
            <div class="flex-block__inner">
                @forelse($complexes as $complex)
                    @include('inc.complex')
                @empty
                    <div class="message-empty common">
                        <p>Нет жилых комплексов</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
