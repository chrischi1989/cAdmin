@if(session()->has('success'))
<div class="alert alert-success{{ !isset($block) ? ' alert-lg-aside-left slideHide text-center' : null }}">
    {{ session('success') }}
</div>
@endif
@if(session()->has('error'))
<div class="alert alert-danger{{ !isset($block) ? ' alert-lg-aside-left slideHide text-center' : null }}">
    {{ session('error') }}
</div>
@endif
@if(session()->has('warning'))
<div class="alert alert-warning{{ !isset($block) ? ' alert-lg-aside-left slideHide text-center' : null }}">
    {{ session('warning') }}
</div>
@endif
@if(session()->has('info'))
<div class="alert alert-info{{ !isset($block) ? ' alert-lg-aside-left slideHide text-center' : null }}">
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
