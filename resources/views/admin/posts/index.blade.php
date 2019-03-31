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
                <th>Title</th>
                <th>Body</th>
                <th>Image</th>
                <th>User</th>
                <th>Category</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th></th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>


                    @foreach($posts as $post)


                        <tr>
                          <td>{{$post->id}}</td>
                          <td>{{$post->title}}</td>
                          <td>{{ str_limit($post->body, 30) }}</td>
                          <td><img class="img-rounded" src="{{$post->photo ? '..' . $post->photo->file: 'http://placehold.it/400x400'}}" alt="" /></td>
                          <td>{{$post->user->name}}</td>
                          <td>{{$post->category ? $post->category->name: 'uncategorized'}}</td>
                          <td>{{$post->created_at ? $post->created_at->diffForHumans(): 'no date'}}</td>
                          <td>{{$post->updated_at ? $post->updated_at->diffForHumans(): 'no date'}}</td>
                          <td><a href="{{route('home.post', $post->slug)}}">View Post</a></td>
                          <td><a href="{{route('admin.posts.edit', $post->id)}}">Edit Post</a></td>
                          <td><a href="{{route('admin.comments.show', $post->id)}}">Comments</a></td>
                        </tr>
                    @endforeach



            </tbody>
        </table>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$posts->render()}}
            </div>
        </div>
    @else
    
    <p>No posts yet.</p>
    
    @endif
@stop