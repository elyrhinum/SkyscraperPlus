@if(Session::has('success'))
    <div class="alert alert-success">
        <p>{{ session('success') }}</p>
    </div>
@endif

@error('error')
    <div class="alert alert-danger">
        <p>{{ $message }}</p>
    </div>
@enderror
