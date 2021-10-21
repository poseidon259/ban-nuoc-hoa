@extends('admin.site')
@section('content')
<table class="table" style="position: relative;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Blog ID</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">Description</th>
            <th scope="col">Tag</th>
            <th scope="col">Created At</th>
            <th colspan="2">Features</th>

        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{$item->blog_id}}</th>
            <td>{{$item->title}}</td>
            <td>{{$item->img}}</td>
            <td>{{Str::limit($item->description, 25)}}</td>
            <td>{{$item->tag}}</td>
            <td>{{$item->created_at}}</td>
            <td><a class="btn btn-primary btn-sm text-white" href="{{route('editBlog', ['id' => $item->blog_id])}}">Edit</a></td>
            <td><a class="btn btn-danger btn-sm text-white" href="{{route('deleteBlog', ['id' => $item->blog_id])}}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{route('insertBlog')}}" class="btn btn-success btn-large text-white " style="height: 100%">Insert</a>
@endsection

@section('next')

<div class="" style="position: absolute; top: 80%; left: 50%; right: 0; ">
    {{$data->links()}}
</div>

@stop()