@extends('layouts.site')
<style>
    .blog-div {
        text-align: center;
        width: 90%;
        
    }

    .blog-div img {
        width: 30%;
    }
</style>
@section('child-ui')
    @foreach ($blog as $item)
        <div class="blog-div">
            <h2>{{$item->title}}</h2>
            <img src="{{url('public/frontend')}}/img/blog/{{$item->img}}" alt="">
            <p>{{$item->description}}</p>
        </div>
    @endforeach
@endsection