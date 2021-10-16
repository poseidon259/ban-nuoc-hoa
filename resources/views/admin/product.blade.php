@extends('admin.site')
@section('content')
<table class="table" style="position: relative;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Available</th>
            <th scope="col">Description</th>
            <th scope="col">Category ID</th>
            <th scope="col">Gender</th>
            <th scope="col">Status</th>
            <th scope="col">Image</th>
            <th colspan="2">Features</th>

        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{$item->product_id}}</th>
            <td>{{$item->product_name}}</td>
            <td>{{$item->price}}</td>
            <td>{{$item->available}}</td>
            <td>{{Str::limit($item->description, 50)}}</td>
            <td>{{$item->category_id}}</td>
            <td>{{$item->gender}}</td>
            <td>{{$item->status}}</td>
            <td>{{$item->image}}</td>
            <td><a class="btn btn-primary btn-sm text-white" href="{{ route('editProduct', ['id' => $item->product_id]) }}">Edit</a></td>
            <td><a class="btn btn-danger btn-sm text-white" href="{{ route('deleteProduct', ['id' => $item->product_id]) }}">Delete</a></td>
        </tr>
        @endforeach
    </tbody>
</table>
<a href="{{ route('insertProduct') }}" class="btn btn-success btn-large text-white " style="height: 100%">Insert</a>
@endsection

@section('next')

<div class="" style="position: absolute; top: 80%; left: 50%; right: 0; ">
    {{$data->links()}}
</div>

@stop()