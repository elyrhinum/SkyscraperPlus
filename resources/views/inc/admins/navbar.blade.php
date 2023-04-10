{{--VARS--}}
@php
    use App\Models\Ad;
    use App\Models\User;
    use App\Models\ResidentialComplex;

    $ads = Ad::all();
    $complexes = ResidentialComplex::all();
    $moderators = User::all();
@endphp

{{--NAVIGATION--}}
<div id="navigation">
    <ul>
        <p class="navigation__ul-title">Объявления</p>
        <li>
            <a href="{{ route('admins.ads.onlySuggested') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/new.png') }}" alt="Предложенные">
                <div>
                    <span>Предложенные</span>
                    <span class="span-count">{{ count($ads->where('status_id', 2)) }}</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admins.ads.onlyPublished') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/published.png') }}" alt="Опубликованные">
                <div>
                    <span>Опубликованные</span>
                    <span class="span-count">{{ count($ads->where('status_id', 1)) }}</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admins.ads.onlyCancelled') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/cancelled.png') }}" alt="Отклоненные">
                <div>
                    <span>Отклоненные</span>
                    <span class="span-count">{{ count($ads->where('status_id', 3)) }}</span>
                </div>
            </a>
        </li>
    </ul>
    <ul>
        <p class="navigation__ul-title">Жилые комплексы</p>
        <li>
            <a href="{{ route('admins.complexes.onlySuggested') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/new.png') }}" alt="Предложенные">
                <div>
                    <span>Предложенные</span>
                    <span class="span-count">{{ count($complexes->where('status_id', 2)) }}</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admins.complexes.onlyPublished') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/published.png') }}" alt="Опубликованные">
                <div>
                    <span>Опубликованные</span>
                    <span class="span-count">{{ count($complexes->where('status_id', 1)) }}</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admins.complexes.onlyHidden') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/inactive.png') }}" alt="Неактивные">
                <div>
                    <span>Неактивные</span>
                    <span class="span-count">{{ count($complexes->where('status_id', 4)) }}</span>
                </div>
            </a>
        </li>
        <li>
            <a href="{{ route('admins.complexes.onlyCancelled') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/cancelled.png') }}" alt="Отклоненные">
                <div>
                    <span>Отклоненные</span>
                    <span class="span-count">{{ count($complexes->where('status_id', 3)) }}</span>
                </div>
            </a>
        </li>
    </ul>
    <ul>
        <p class="navigation__ul-title">Местоположение</p>
        <li>
            <a href="{{ route('admins.streets.index') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/streets.png') }}" alt="Улицы">
                <span>Улицы</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admins.districts.index') }}" class="navigation__ul-link">
                <img src="{{ asset('/media/icons/admin/districts.png') }}" alt="Районы">
                <span>Районы</span>
            </a>
        </li>
    </ul>
    @if(auth()->user()->role_id == 3)
        <ul>
            <p class="navigation__ul-title">Модераторы</p>
            <li>
                <a href="{{ route('admins.moderators.index') }}" class="navigation__ul-link">
                    <img src="{{ asset('/media/icons/admin/moderators.png') }}" alt="Новые жилые комплексы">
                    <div>
                        <span>Список модераторов</span>
                        <span class="span-count">{{ count($moderators->where('role_id', 4)) }}</span>
                    </div>
                </a>
            </li>
        </ul>
    @endif
</div>

{{--CSS--}}
<style>
    #navigation {
        width: 100%;
        height: 100%;
        padding: 10px;
        background-color: white;
        border-right: 1px solid rgba(211, 211, 211, 0.5);
    }

    .navigation > ul > li {
        cursor: pointer;
    }

    ul {
        padding: 0 !important;
    }

    .span-count {
        font-size: 12px;
        opacity: .5;
        margin-left: 10px;
    }

    .navigation__ul-link {
        display: flex;
        flex-direction: row;
        justify-content: flex-start;
        align-items: center;

        width: 100%;
        padding: 5px;

        font-size: 14px;
    }

    .navigation__ul-link:hover {
        background-color: #EEA444;
        border-radius: 3px;
        transition: .5s;
    }

    .navigation__ul-link > img {
        width: 15px;
        height: 15px;
        object-fit: cover;
        margin-right: 10px;
    }

    .navigation__ul-title {
        font-family: HelveticaNeueCyr;
        font-weight: 500;
        font-size: 16px;
    }
</style>
