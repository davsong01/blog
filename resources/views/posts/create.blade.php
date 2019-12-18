@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"> {{ isset($post) ? 'Edit Post' : 'Create New Post' }}</div>
                <div class="panel-body">
                    <div class="card card-default">
                        <div class="card-body">
                            @include('partials.errors')
                            
                        <form action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype='multipart/form-data'>
                                {{ csrf_field() }}
                                
                                @if(isset($post))
                                    {{ method_field('PATCH') }}
                                @endif

                                <div class="form-group">
                                    <label for='title'>Title</label>
                                    <input type="text" class="form-control" placeholder="Title" name="title" value="{{ isset($post) ? $post->title : "" }}">
                                </div>

                                <div class="form-group">
                                        <label for='description'>Description</label>
                                        <textarea name='description' id='description' col='5' class='form-control'>{{ isset($post) ? $post->description : "" }}</textarea>
                                </div>

                                <div class="form-group">
                                        <label for='content'>Content</label>
                                        <input id="content" type="hidden" name="content" value ="{{ isset($post) ? $post->content : "" }}">
                                        <trix-editor input="content"></trix-editor>
                                </div>

                                <div class="form-group">
                                        <label for='published_at'>Published At</label>
                                        <input type="text" class="form-control" name="published_at" placeholder="Published At" id = "published_at" value="{{ isset($post) ? $post->published_at : "" }}">
                                </div>

                                <div class="form-group">
                                        <label for='image'>Image</label>
                                        <input type="file" class="form-control" name="image">
                                </div>

                                <div class="form-group">
                                    <label for='category'>Category</label>
                                    <select name="category" id="category" class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}"
                                                @if(isset($post))
                                                    @if($category->id == $post->category->id)
                                                        selected
                                                    @endif
                                                @endif
                                                
                                                >

                                                {{$category->name}}
                                            </option>
                                        
                                        @endforeach
                                    </select>
                                </div>

                                @if($tags->count() > 0) 
                                <div class="form-group">
                                        <label for='tags'>Tag</label>
                                            <select name="tags[]" id="tags" class="form-control tags-selector" multiple >
                                                @foreach($tags as $tag)
                                                    <option value="{{ $tag->id }}"
                                                       @if(isset($post))
                                                            @if($post->hasTag($tag->id))
                                                                selected
                                                            @endif
                                                       @endif
                                                        >
                                                        {{$tag->name}}
                                                    </option>
                                                @endforeach
                                             </select>
                                    </div>
                                @endif

                                @if(isset($post))
                                    <div class="form-group">
                                        <img src="{{ asset($post->image) }}" alt="" style="width:100%">
                                    </div>
                                @endif
                                <div class="form-group text-center">
                                <button class="btn-success" type=submit>{{ isset($post) ? 'Update Post' : 'Create Post' }}</button>
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

<!---Include trix editor and datepicker libraries-->
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix-core.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>

    <script>
        flatpickr('#published_at', {
            enableTime: true,
            enableSeconds: true,
        });

        $(document).ready(function() {
        $('.tags-selector').select2();
    });

    </script>
    
@endsection

@section('css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />

@endsection