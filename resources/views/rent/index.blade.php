@extends('templates.app')
@section('title', 'Долгосрочная и посуточная аренда')
@section('content')
    <div class="main-container pd">
        {{--SEARCH FORM--}}
        <div class="search">
            @include('inc.filter')
        </div>

        {{--BLOCK--}}
        <div class="flex-column">
            {{--HEADERS--}}
            <div class="headers">
                <h3>Долгосрочная и посуточная аренда объектов недвижимости</h3>
            </div>

            {{--ADS--}}
            <div class="flex-block__inner">
                @forelse($ads as $ad)
                    {{--AD--}}
                    @include('inc.ad')
                @empty
                    <div class="message-empty common">
                        <p>Нет объявлений с объектами недвижимости на аренду</p>
                    </div>
                @endforelse
            </div>
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
                        console.log(result)
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
