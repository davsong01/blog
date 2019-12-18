@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="card card-default">
                        <div class="card-header">
                            {{ isset($category) ? 'Edit Category' : 'Create New Category' }}
                            </div>
                        <div class="card-body">
                            @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                <li class="list-group-item">
                                    {{$error}}
                                </li>
                                @endforeach
                            </div>
                            @endif
                            <form action="{{ isset($category) ? route('categories.update', $category->id) : route('categories.store') }}" method="POST">
                                {{ csrf_field() }}

                                @if(isset($category))
                                    {{ method_field('PATCH') }}
                                @endif

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ isset($category) ? $category->name : "" }}">
                                </div>
                                <div class="form-group text-center">
                                        <button class="btn-success" type=submit>{{ isset($category) ? 'Update Category' : 'Create Category' }}</button>
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