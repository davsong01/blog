@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{route('posts.create')}}" class="btn btn-info my-2">Add Post</a>
                </div>

                <div class="card-body">
                   @include('partials.errors')
                    <div>
                       @if($posts->count() > 0)
                            <table class="table">
                                    <thead>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </thead>
        
                                    <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>
                                                    <img src="{{ asset($post->image) }}" width="120px" height="60px" alt="">
                                                </td>
                                                <td>
                                                    {{ $post->title }}
                                                </td>
                                                <td>
                                                        <a href = "{{ route('categories.edit', $post->category->id)}}">
                                                            {{ $post->category->name }}
                                                        </a>
                                                    </td>
                                                @if($post->trashed())
                                                <td>
                                                        <form action ="{{ route('restore-posts', $post->id)}}" method="POST">
                                                                {{ csrf_field() }}
                                                                {{ method_field('PATCH') }}
                
                                                                <button type= "submit" class="btn btn-info btn-sm ">
                                                                    Restore
                                                                </button>
                                                                    
                                                            </form>
                                                </td>
                                                @else
                                                <td>
                                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-info btn-sm">Edit</a>
                                                </td>
                                                @endif
                                                
                                                <td>
                                                    <form action ="{{ route('posts.destroy', $post->id)}}" method="POST">
                                                        {{ csrf_field() }}
                                                        {{method_field('DELETE')}}
        
                                                        <button type= "submit" class="btn btn-danger btn-sm ">
                                                            {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                                        </button>
                                                            
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                       @else
                           <h3 class="text-centre">No Posts available</h3> 
                       
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection