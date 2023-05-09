@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', 'Документация')
@section('content')
    <div class="main-container pd">
        <div class="flex-block">
            {{--HEADERS--}}
            <div class="headers">
                <div class="headers__inner">
                    <h3>Документация</h3>
                    <p></p>
                </div>
            </div>

            {{--DOCUMENTS--}}
            <div class="flex-block__inner">
                @forelse($documents as $document)
                    <div class="inner__single-document">
                        <div>
                            <img src="{{ asset('/media/icons/admin/documents.png') }}" alt="Документ">
                            <p>{{ $document->name }}</p>
                            <p>{{ $documen->dateOfUpdating }}</p>
                        </div>
                        <a href="{{ $document->document }}" class="btn btn-filled">Скачать</a>
                    </div>

                @empty
                    <div class="message-empty common">
                        <p>Нет документации</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection

<style>
    .inner__single-document {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;

        padding: 10px 0;
        border-bottom: var(--main-border);
    }

    .inner__single-document > div {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: flex-start;
    }

    .inner__single-document > div > img {
        width: 20px;
        height: 20px;
        margin-right: 10px;
        object-fit: contain;
    }
</style>
