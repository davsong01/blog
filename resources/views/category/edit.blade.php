@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="card card-default">
                        <div class="card-header">Edit {{$category->id}}</div>
                        <div class="card-body">
                                @include('partials.errors')
                            <form action="/categories/{{$category->id}}/update" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                </div>
                                <div class="form-group text-center">
                                    <button class="btn-success" type=submit>Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection