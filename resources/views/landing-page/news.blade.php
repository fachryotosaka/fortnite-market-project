@extends('layouts.landing-tamplate-2')
@section('content')


<div class="bg-3">
    <img src="{{ asset('img/bg-3.png') }}" alt="">
</div>

<div class="nwtitle-container">
    <p class="nwtitle"></p>
    <p class="nwsubtitle"></p>
</div>

<div class="nwpage-container ">
    <div class="card-container-main  spn">
        <div class="card-news-main " style="background-image: url( {{ $main[0]->getMedia('main')->first()->getUrl() }} )">
            <p class="title-news-main">{{ $main[0]->name }}</p>
        </div>
    </div>

    @foreach ( $news as $new )

    <div class="card-container transition ease duration-300 group/ss cursor-pointer">
        <div class="card-news transition ease duration-300 group-hover/ss:scale-105 " style="background-image: url( {{ $new->getMedia('news')->first()->getUrl() }} )">
            <p class="title-news">{{ $new->name }}</p>
        </div>
    </div>
    @endforeach




</div>



@endsection
