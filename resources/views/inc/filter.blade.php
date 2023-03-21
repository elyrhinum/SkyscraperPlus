<form method="post" action="#">
    <div class="filters">
        {{-- SELECTING REAL ESTATE --}}
        <select name="realestate" id="realestate">

        </select>

        {{-- SELECTING ROOMS --}}
        <select name="rooms" id="rooms">

        </select>

        {{-- PRICE FILTERS --}}
        <div class="prices">
            <label for="price-from">₽</label>
            <input type="number" name="price-from" id="price-from" placeholder="От">

            <label for="price-to">₽</label>
            <input type="number" name="price-to" id="price-to" placeholder="До">
        </div>

        {{-- SELECTING DISTRICT --}}
        <select name="district" id="district">

        </select>
    </div>

    <button>Найти</button>
</form>
