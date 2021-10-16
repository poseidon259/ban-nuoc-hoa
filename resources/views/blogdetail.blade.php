@extends('layouts.site')
<style>
    .blog-div {
        text-align: center;
    }
</style>
@section('child-ui')
    @foreach ($blog as $item)
        <div class="blog-div">
            <h2>{{$item->title}}</h2>
            <img src="{{url('public/frontend')}}/img/blog/{{$item->img}}" alt="">
            
        </div>
    @endforeach
@endsection