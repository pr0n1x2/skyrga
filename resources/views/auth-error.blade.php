@if ($errors->any())
    <div class="alert alert-danger">
        <button class="close" data-close="alert"></button>
        <span> {{$errors->first()}} </span>
    </div>
@endif