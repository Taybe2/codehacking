@extends('layouts.admin')

@section('content')

    <h1>Categories</h1>
    
    <div class="col-sm-6">
        
        <h3>Edit Category</h3>

        {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}

        <div class="form-group">

            {!! Form::label('name', 'Name:') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6']) !!}

        </div>

        {!! Form::close() !!}
        
        {!! Form::model($category, ['method'=>'DELETE', 'action'=>['AdminCategoriesController@destroy', $category->id]]) !!}

        <div class="form-group col-sm-6">

            {!! Form::submit('Delete Category', ['class'=>'btn btn-danger']) !!}

        </div>

        {!! Form::close() !!}
        
    </div>

@stop

