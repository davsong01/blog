@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            <div class="panel panel-default">
                <div class="panel-heading">My Profile</div>

                <div class="panel-body">
                    @include('partials.errors')
                <form action="{{ route('users.update-profile') }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                    </div>

                    <div class="form-group">
                        <label for="name">About Me</label>
                        <textarea name="about" id="about" cols="5" rows="10" class="form-control">{{$user->about}}</textarea>
                    </div>

                    <button class="btn btn-success" type="submit">Update Profile</button>
                </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
