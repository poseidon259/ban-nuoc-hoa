@extends('admin.site')
@section('content')
<table class="table" style="position: relative;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Category ID</th>
            <th scope="col">Category Name</th>
            <th colspan="2">Features</th>

        </tr>
    </thead>
    <!-- 
    
     -->
    <tbody>
        @foreach($category as $item)
        <tr>
            <th scope="row">{{$item->category_id}}</th>
            <td>{{$item->category_name}}</td> 
            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editCategory', ['id' => $item->category_id])}}">Edit</a></td>
            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteCategory', ['id' => $item->category_id])}}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{route('insertCategory')}}" class="btn btn-success btn-large text-white " style="height: 100%">Insert</a>
@endsection

@section('next')

<div class="" style="position: absolute; top: 80%; left: 50%; right: 0; ">
    {{$category->links()}}
</div>

@stop()