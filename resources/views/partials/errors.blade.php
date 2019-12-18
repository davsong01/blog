@if($errors->any('message'))
<div class="alert alert-info">
    @foreach ($errors->all() as $error)
    <li class="list-group-item">
        {{$error}}
    </li>
    @endforeach
</div>
@endif 

