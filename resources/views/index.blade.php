@extends('templates.app')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@section('title', 'ВысоткаПлюс')
@section('content')
    {{--BANNER--}}
    <div class="main-banner">
        <img src="{{ asset('/media/images/banner.jpg') }}" alt="Баннер">
    </div>

    {{--SEARCH FORM--}}
    <div class="search pd" style="margin-top: -70px;">
        @include('inc.filter')
    </div>

    {{--CATEGORIES OF ADS--}}
    <div class="categories pd">
        <div class="ads__blocks">
            <a href="{{ route('ads.catalog', ['object_type' => 'Flat', 'contract_id_1' => 1]) }}"
               class="blocks__block">
                <p>Купить квартиру</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'Flat', 'contract_id_1' => 2, 'contract_id_2' => 3]) }}"
               class="blocks__block">
                <p>Снять квартиру</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'Room', 'contract_id_1' => 1]) }}"
               class="blocks__block">
                <p>Купить комнату</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'Room', 'contract_id_1' => 2, 'contract_id_2' => 3]) }}"
               class="blocks__block">
                <p>Снять комнату</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'House', 'contract_id_1' => 1]) }}"
               class="blocks__block">
                <p>Купить участок с домом</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'House', 'contract_id_1' => 2, 'contract_id_2' => 3]) }}"
               class="blocks__block">
                <p>Снять участок с домом</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'LandPlot', 'contract_id_1' => 1]) }}"
               class="blocks__block">
                <p>Купить земельный участок</p>
            </a>

            <a href="{{ route('ads.catalog', ['object_type' => 'LandPlot', 'contract_id_1' => 2, 'contract_id_2' => 3]) }}"
               class="blocks__block">
                <p>Снять земельный участок</p>
            </a>
        </div>
    </div>

    {{--LATEST ADS--}}
    <div class="flex-block pd">
        <div class="headers">
            <h5>Последние объявления</h5>
        </div>

        <div class="flex-block__inner">
            @forelse($ads->latest()->take(3)->get() as $ad)
                {{--AD--}}
                @include('inc.ad')
            @empty
                <div class="message-empty common">
                    <p>Нет последних объявлений</p>
                </div>
            @endforelse
        </div>
    </div>

    {{--LATEST COMPLEXES--}}
    <div class="flex-block pd">
        <div class="headers">
            <h5>
                <a href="{{ route('complexes.index') }}">Жилые комплексы</a>
            </h5>

            <a href="{{ route('complexes.index') }}" class="btn btn-filled">Подробнее</a>
        </div>

        <div class="flex-block__inner">
            @forelse($complexes->latest()->take(3)->get() as $complex)
                {{--COMPLEX--}}
                @include('inc.complex')
            @empty
                <div class="message-empty common">
                    <p>Нет жилых комплексов</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('script')
    <script src="{{ asset('/js/form-uploading.js') }}"></script>

    <script>
        const btnSave = document.getElementsByClassName('btn-save');

        // BOOKMARKS
        [...btnSave].forEach(item => {
            item.addEventListener('click', async (e) => {
                if ({{ auth()->user() !== null }}) {
                    if (item.dataset.bookmarked === 'false') {
                        let result = await dataPostJSON("{{ route('ads.bookmark') }}", e.currentTarget.dataset.ad, `{{ csrf_token() }}`);
                        if (result) {
                            item.children[0].src = "{{ asset('/media/icons/saved/filled.svg') }}";
                            item.dataset.bookmarked = 'true';
                        }
                    } else {
                        let result = await dataPostJSON("{{ route('ads.unbookmark') }}", e.currentTarget.dataset.ad, `{{ csrf_token() }}`);
                        if (result) {
                            item.children[0].src = "{{ asset('/media/icons/saved/outlined.svg') }}";
                            item.dataset.bookmarked = 'false';
                        }
                    }
                } else {
                    location = '{{ route('users.login') }}';
                }
            });
        });
    </script>
@endpush
