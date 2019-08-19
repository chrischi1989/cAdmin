@if(session()->has('success'))
<div class="alert alert-success alert-lg-aside text-center text-lg-left">
    {{ session('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger alert-aside text-center text-lg-left">
    {{ session('error') }}
</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-warning alert-aside text-center text-lg-left">
    {{ session('warning') }}
</div>
@endif
@if(session()->has('info'))
<div class="alert alert-info alert-aside text-center text-lg-left">
    {{ session('info') }}
</div>
@endif
@if(!$errors->isEmpty())
<div class="alert alert-danger">
    <p><strong>Es{{ ($errors->count() > 1 ? ' sind ' : ' ist ') . $errors->count() }} Fehler aufgetreten:</strong></p>
    <ol class="pl-3 mb-0">
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
    </ol>
</div>
@endif