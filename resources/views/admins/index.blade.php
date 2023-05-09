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
            <div id="title">
                <h5>Панель адмиинистратора</h5>
            </div>

            {{--LAST UPDATES--}}
            <div class="updates">
                {{--AMOUNT OF SUGGESTED ADS--}}
                <div class="updates__block">
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

                {{--AMOUNT OF SUGGESTED RESIDENTIAL COMPLEXES--}}
                <div class="updates__block">
                    @if (count($complexes->where('status_id', 2)) > 0)
                        <div>
                            <p class="ads__title">Количество жилых комплексов требующих рассмотрения</p>
                            <p class="ads__count">{{ count($complexes->where('status_id', 2)) }}</p>
                        </div>
                        <a href="{{ route('admins.complexes.onlySuggested') }}" class="btn btn-filled">Посмотреть</a>
                    @else
                        <p>Нет жилых комплексов требущих рассмотрения</p>
                    @endif
                </div>
            </div>

            {{--LATEST ADS--}}
            <div class="updates-tables">
                <div id="title">
                    <h5>Последние объявления на рассмотрении</h5>
                    <a href="{{ route('admins.ads.onlySuggested') }}" class="btn btn-filled">Перейти</a>
                </div>

                <table>
                    <tr>
                        <th class="br">ID</th>
                        <th>Тип объекта</th>
                        <th>Договор</th>
                        <th>Район</th>
                        <th>Цена</th>
                        <th class="centered">Дата подачи</th>
                        <th class="centered">Дата обновления</th>
                    </tr>
                    @forelse($ads->where('status_id', 2)->take(3) as $ad)
                        <tr class="table__block">
                            <td class="br object-id">{{ $ad->id }}</td>
                            <td> {{ $ad->getCorrectObjectType() }}</td>
                            <td>{{ $ad->contract->name }}</td>
                            <td>{{ $ad->district->name }}</td>
                            <td>{{ $ad->getCorrectPrice() }}</td>
                            <td class="centered">{{ $ad->dateOfCreating }}</td>
                            <td class="centered">{{ $ad->dateOfUpdating }}</td>
                        </tr>
                    @empty
                        <tr class="centered">
                            <td colspan="7">Нет объявлений на рассмотрении</td>
                        </tr>
                    @endforelse
                </table>
            </div>

            {{--LATEST COMPLEXES--}}
            <div class="updates-tables">
                <div id="title">
                    <h5>Последние жилые комплексы на рассмотрении</h5>
                    <div>
                        <a href="{{ route('admins.complexes.create') }}" class="btn btn-outlined">Добавить жилой комплекс</a>
                        <a href="{{ route('admins.complexes.onlySuggested') }}" class="btn btn-filled">Перейти</a>
                    </div>
                </div>

                <table>
                    <tr>
                        <th class="br">ID</th>
                        <th>Наименование</th>
                        <th>Район</th>
                        <th class="date-column">Дата подачи</th>
                        <th class="date-column">Дата обновления</th>
                    </tr>
                    @forelse($complexes->where('status_id', 2)->take(3) as $complex)
                        <tr class="table__block">
                            <td class="br object-id">{{ $complex->id }}</td>
                            <td>{{ $complex->name }}</td>
                            <td>{{ $complex->district->name }}</td>
                            <td class="date-column">{{ $complex->dateOfCreating }}</td>
                            <td class="date-column">{{ $complex->dateOfUpdating }}</td>
                        </tr>
                    @empty
                        <tr class="centered">
                            <td colspan="6">Нет жилых комплексов на рассмотрении</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
@endsection
