@extends('layouts.admin')

@section('content')
    
    @if(Session::has('deleted_user'))
    
        <p class="bg-danger">{{Session::get('deleted_user')}}</p>
        
    @endif
    
    @if(Session::has('updated_user'))
    
        <p class="bg-info">{{Session::get('updated_user')}}</p>
        
    @endif
    
    @if(Session::has('created_user'))
    
        <p class="bg-success">{{Session::get('created_user')}}</p>
        
    @endif
    
    {{ session()->forget('flash_notification') }}
    
    <h1>Users</h1>
    
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created</th>
            <th>Updated</th>
          </tr>
        </thead>
        <tbody>
            @if($users)
        
                @foreach($users as $user)
        
        
                    <tr>
                      <td>{{$user->id}}</td>
                      <td><img src="{{$user->photo ? '..' . $user->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-rounded" /></td>
                      <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
                      <td>{{$user->email}}</td>
                      <td>{{$user->role->name}}</td>
                      <td>{{$user->is_active == 1 ? 'Active' : 'Not'}}</td>
                      <td>{{$user->created_at->diffForHumans()}}</td>
                      <td>{{$user->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            
            @endif
            
        </tbody>
    </table>

@stop

