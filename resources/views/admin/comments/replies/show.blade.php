@extends('layouts.admin')

@section('content')

    <h1>Replies for comment "{{$comment->body}}"</h1>
    
    @if (count($replies) > 0)
        <table class="table">
            <thead>
              <tr>
                <th>Id</th>
                <th>Post</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Created At</th>
                <th></th>
                <th></th>
              </tr>
            </thead>
            <tbody>


                    @foreach($replies as $reply)


                        <tr>
                          <td>{{$reply->id}}</td>
                          <td><a href="{{route('home.post', $reply->comment->post->id)}}">{{$reply->comment->post->title}}</a></td>
                          <td>{{$reply->author}}</td>
                          <td>{{$reply->email}}</td>
                          <td>{{$reply->body}}</td>
                          <td>{{$reply->created_at ? $reply->created_at->diffForHumans(): 'no date'}}</td>
                          <td>
                                @if ($reply->is_active == 1)
                                    
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                                    
                                    <input type="hidden" name="is_active" value="0" />
                                    
                                    <div class="form-group col-sm-6">

                                        {!! Form::submit('Un-approve', ['class'=>'btn btn-info']) !!}

                                    </div>

                                    {!! Form::close() !!}
                                    
                                @else
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                                    
                                    <input type="hidden" name="is_active" value="1" />
                                    
                                    <div class="form-group col-sm-6">

                                        {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}

                                    </div>

                                    {!! Form::close() !!}
                                @endif
                          </td>
                            <td>
                                    
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
                                    
                                    <div class="form-group col-sm-6">

                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}

                                    </div>

                                    {!! Form::close() !!}
                          </td>
                        </tr>
                    @endforeach



            </tbody>
        </table>
    @else

        <p>No replies</p>

    @endif
    
@stop