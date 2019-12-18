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
                            {{ isset($tag) ? 'Edit tag' : 'Create New tag' }}
                            </div>
                        <div class="card-body">
                                @include('partials.errors')
                            <form action="{{ isset($tag) ? route('tags.update', $tag->id) : route('tags.store') }}" method="POST">
                                {{ csrf_field() }}

                                @if(isset($tag))
                                    {{ method_field('PATCH') }}
                                @endif

                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ isset($tag) ? $tag->name : "" }}">
                                </div>
                                <div class="form-group text-center">
                                        <button class="btn-success" type=submit>{{ isset($tag) ? 'Update tag' : 'Create tag' }}</button>
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