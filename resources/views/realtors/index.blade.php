@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/realtors/index.css') }}">
@section('title', 'Риелторы')
@section('content')
    <div class="main-container pd">
        {{--BLOCK--}}
        <div class="flex-block">
            {{--HEADERS--}}
            <div class="headers">
                <div class="headers__inner">
                    <h3>Риелторы</h3>
                    <p>Для связи с риелтором и обсуждения дальнейшей работы необходимо связаться лично, воспользовавшись контактными данными, указанными самим риелтором.</p>
                </div>
            </div>

            {{--REALTORS--}}
            <div class="realtor-block__inner">
                @forelse($realtors as $realtor)
                    {{--REALTOR--}}
                    <div class="inner__realtor common">
                        <img src="{{ $realtor->image }}" alt="{{ $realtor->fullName }}">
                            <div class="realtor__info">
                                <div>
                                    <h5>{{ $realtor->fullName }}</h5>
                                    <p>E-mail: {{ $realtor->email }}</p>
                                    <p>Телефон: {{ $realtor->telephone }}</p>
                                    <p class="info__count-ads">Объявлений всего: {{ count($realtor->ads->where('status_id', 1)) }}</p>
                            </div>
                            <a href="{{ route('users.ads', $realtor->id) }}" class="btn btn-outlined">Посмотреть объявления</a>
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
