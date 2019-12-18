@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{ route('categories.create') }}" class="btn btn-info my-2">Add category</a>
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
                                @if($categories->count() > 0)
                                @foreach($categories as $category)
                                <tr>
                                    <td>
                                        {{$category->name}}
                                    </td> 
                                    <td>
                                        {{ $category->posts->count() }}
                                    </td> 
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id)}}" class="btn btn-info my-2">Edit</a>
                                        
                                        
                                    </td> 
                                    <td>  
                                    <form action ="{{ route('categories.destroy', $category->id)}}" method="POST">
                                            {{ csrf_field() }}
                                            {{method_field('DELETE')}}
                                            
                                            <button type= "submit" class="btn btn-danger btn-sm ">Delete</button>     
                                    </form>
                                </td>
                                </tr>
                            
                                @endforeach
                                @else
                                    <h3 class="text-center">No Categories available</h3>
                                @endif
                        </tbody>
                </div>
            </div>
        </div>
    </div>
@endsection