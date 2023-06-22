<div class="complex common">
    {{--IMAGE--}}
    <div class="complex__image">
        <img src="{{ $complex->images[0]->image }}" alt="{{ $complex->id }}">
    </div>

    {{--COMPLEX INFO--}}
    <div class="complex__info">
        {{--INFO--}}
        <div class="complex__header">
            <div>
                <h5 class="header__info">ЖК "{{ $complex->name }}"</h5>
                <p class="header__class">{{ $complex->class->name }}</p>
            </div>
            <p class="header__complex-description">{{ $complex->description }}</p>
        </div>
    </div>

    {{--BUTTONS--}}
    <div class="complex__buttons">
        <a href="{{ route('complexes.show', $complex->id) }}" class="btn btn-filled">Посмотреть</a>
    </div>
</div>

<style>
    .complex__header {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-self: flex-start;
    }

    .header__class {
        opacity: 70%;
    }

    .complex__header > div {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: flex-start;

        width: fit-content;
    }

    .header__info {
        margin-bottom: 0;
    }

    .header__complex-description {
        width: 100%;
        margin-top: 20px;
    }

    .complex__image {
        width: fit-content;
        height: fit-content;
    }

    /*INFO*/
    .complex__info {
        display: grid;
        grid-auto-rows: 3fr 35px;
        gap: 10px;
    }

    /*BUTTONS*/
    .info__buttons > a {
        width: fit-content;
    }

    .btn-filled {
        height: 35px;
    }

    /*PC STYLES*/
    @media (min-width: 1200px) {
        /*COMPLEX*/
        .complex {
            display: grid;
            grid-template-columns: 250px 5fr 200px;
            gap: 10px;

            width: 100%;
        }

        .complex__image > img {
            width: 250px;
            height: 250px;
            object-fit: cover;
            border-radius: 3px;
        }

        /*BUTTONS*/
        .complex__buttons {
            display: flex;
            flex-direction: row;
            justify-content: flex-end;
            align-self: flex-end;
        }
    }
    
    /*TABLET STYLES*/
    @media (max-width: 1200px) {
        /*COMPLEX*/
        .complex {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;

            width: 100%;
        }
        
        .complex__image {
            width: 100%;
        }

        .complex__image > img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 3px;
        }
        
        .header__complex-description {
            display: none;
        }

        /*BUTTONS*/
        .complex__buttons, .complex__buttons > .btn {
            width: 100%;
        }
    }

    /*PHONE STYLES*/
    @media (max-width: 770px) {
        /*COMPLEX*/
        .complex {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: flex-start;
            gap: 10px;

            width: 100%;
        }

        .complex__image {
            width: 100%;
        }

        .complex__image > img {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 3px;
        }
        
        .header__complex-description {
            display: none;
        }


        /*BUTTONS*/
        .complex__buttons, .complex__buttons > .btn {
            width: 100%;
        }
    }
</style>
