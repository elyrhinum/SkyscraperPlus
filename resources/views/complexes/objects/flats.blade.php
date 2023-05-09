@extends('templates.app')
@section('title', $title)
@section('content')
    <div class="main-container">
        {{--SEARCH FORM--}}
        <div class="search pd">
            @include('inc.filter')
        </div>

        {{--ADS--}}
        <div class="complexes pd">
            <h3>Квартиры в ЖК "{{ $complex->name }}"</h3>

            @forelse($ads as $ad)
                {{--AD--}}
                @include('inc.ad')
            @empty
                <div class="message-empty common">
                    <p>В этом жилом комплексе нет объявлений</p>
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
