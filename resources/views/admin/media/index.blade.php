@extends('layouts.admin')

@section('content')

    <h1>Media</h1>
    
        @if($photos && count($photos)>0)
            <form action="admin/delete/media" method="post" class="form-inline">
                {!! csrf_field() !!}
                {!! method_field('delete') !!}
                <select name="checkboxArray" id="" class="form-control">
                    <option value="delete">Delete</option>
                </select>
                <input class="btn btn-success" type="submit" />
                <table class="table">
                    <thead>
                      <tr>
                        <th><input type="checkbox" id="options" /></th>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>Created At</th>
                      </tr>
                    </thead>
                    <tbody>


                            @foreach($photos as $photo)


                                <tr>
                                  <td><input class="checkboxes" type="checkbox" name="checkBoxArray[]" value="{{$photo->id}}" /></td>
                                  <td>{{$photo->id}}</td>
                                  <td><img src="{{'..' . $photo->file}}" alt="" class="img-rounded" /></td>
                                  <td>{{$photo->created_at ? $photo->created_at->diffForHumans(): 'no date'}}</td>
                                </tr>
                            @endforeach



                    </tbody>
                </table>
            </form>
            @else

            <p>No photos yet.</p>

        @endif
    
@stop

@section('scripts')
        <script>
            $(document).ready(function(){
                $('#options').click(function(){
                    
                    if(this.checked){
                        
                        $('.checkboxes').each(function(){
                            this.checked = true;
                        });
                        
                    }else{
                        
                        $('.checkboxes').each(function(){
                            this.checked = false;
                        });
                        
                    }
                })
            });
        </script>        
@stop