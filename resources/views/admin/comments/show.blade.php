@extends('layouts.admin')

@section('content')

    <h1>Comments</h1>
    
    @if (count($comments) > 0)
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


                    @foreach($comments as $comment)


                        <tr>
                          <td>{{$comment->id}}</td>
                          <td><a href="{{route('home.post', $comment->post->id)}}">{{$comment->post->title}}</a></td>
                          <td>{{$comment->author}}</td>
                          <td>{{$comment->email}}</td>
                          <td>{{$comment->body}}</td>
                          <td>{{$comment->created_at ? $comment->created_at->diffForHumans(): 'no date'}}</td>
                          <td>
                                @if ($comment->is_active == 1)
                                    
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                    
                                    <input type="hidden" name="is_active" value="0" />
                                    
                                    <div class="form-group col-sm-6">

                                        {!! Form::submit('Un-approve', ['class'=>'btn btn-info']) !!}

                                    </div>

                                    {!! Form::close() !!}
                                    
                                @else
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                                    
                                    <input type="hidden" name="is_active" value="1" />
                                    
                                    <div class="form-group col-sm-6">

                                        {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}

                                    </div>

                                    {!! Form::close() !!}
                                @endif
                          </td>
                            <td>
                                    
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                                    
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

        <p>No Comments</p>

    @endif
    
@stop