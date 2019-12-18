@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('tags.create') }}" class="btn btn-info my-2">Add tag</a>
                </div>
                <div class="card-body">
                        @include('partials.errors')

                    <table class="table">
                        <thead>
                            <th>Name</th>
                            <th>Posts Count</th>
                            <th>Action</th>
                        </thead>

                        <tbody>
                                @if($tags->count() > 0)
                                @foreach($tags as $tag)
                                <tr>
                                    <td>
                                        {{$tag->name}}
                                    </td> 
                                    <td>
                                       {{ $tag->posts->count() }}
                                    </td> 
                                    <td>
                                        <a href="{{ route('tags.edit', $tag->id)}}" class="btn btn-info my-2">Edit</a>
 
                                    </td> 
                                    <td>  
                                    <form action ="{{ route('tags.destroy', $tag->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            
                                            <button type= "submit" class="btn btn-danger btn-sm ">Delete</button>     
                                    </form>
                                </td>
                                </tr>
                            
                                @endforeach
                                @else
                                    <h3 class="text-center">No tags available</h3>
                                @endif
                        </tbody>
                </div>
            </div>
        </div>
    </div>
@endsection