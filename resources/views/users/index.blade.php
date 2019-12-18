@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">
                    <a href="{{route('users.create')}}" class="btn btn-info my-2">Add User</a>
                </div>

                <div class="card-body">
                   @include('partials.errors')
                       @if($users->count() > 0)
                            <table class="table">
                                    <thead>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </thead>
        
                                    <tbody>
                                        @foreach($users as $user)
                                            <tr>
                                                <td>
                                               <img src=" {{ Gravatar::src($user->email)}}" width="40px" height="40px" style="border-radius:50%" alt="">
                                                </td>
                                                <td>
                                                    {{ $user->name }}
                                                </td>
                                                <td>
                                                    {{ $user->email }}
                                                </td>
                                                
                                                    @if(!$user->isAdmin())
                                                    <td>
                                                        <form action ="{{ route('users.make-admin', $user->id) }}" method="post">
                                                                {{ csrf_field() }}
                                                          
                
                                                                <button type="submit" class="btn btn-info btn-sm ">
                                                                    Make Admin
                                                                </button>      
                                                        </form>
                                                    </td>
                                                    @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                       @else
                           <h3 class="text-centre">No users Yet</h3> 
                       
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection