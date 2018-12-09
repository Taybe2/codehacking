@extends('layouts.admin')

@section('content')
    @if(Session::has('deleted_post'))
    
        <p class="bg-danger">{{session('deleted_post')}}</p>
        
    @endif
    
    @if(Session::has('updated_post'))
    
        <p class="bg-info">{{session('updated_post')}}</p>
        
    @endif
    
    @if(Session::has('created_post'))
    
        <p class="bg-success">{{session('created_post')}}</p>
        
    @endif
    
    <h1>Posts</h1>
    @if($posts && count($posts)>0)
    <table class="table">
        <thead>
          <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Owner</th>
            <th>Category</th>
            <th>Title</th>
            <th>Body</th>
            <th>Created At</th>
            <th>Updated At</th>
          </tr>
        </thead>
        <tbody>
            
        
                @foreach($posts as $post)
        
        
                    <tr>
                      <td>{{$post->id}}</td>
                      <td><img height="60" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/400x400' }}" alt="" /></td>
                      <td>{{$post->user->name}}</td>
                      <td>{{$post->category ? $post->category->name : 'Uncategorized'}}</td>
                      <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                      <td>{{str_limit($post->body, 30)}}</td>
                      <td>{{$post->created_at->diffForHumans()}}</td>
                      <td>{{$post->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
            
            
            
        </tbody>
    </table>
    @else
    
    <p>No posts yet.</p>
    
    @endif
@stop