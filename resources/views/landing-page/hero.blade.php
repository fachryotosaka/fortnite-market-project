@extends('layouts.landing-tamplate')
@section('content')

<div class="bg-img">
    <img src="{{ $heros[0]->getMedia('body')->first()->getUrl() }}" alt="">
</div>

<div class="bg-brightness">
    <div></div>
</div>

<div class="container-2">
    <div class="rectangle-white">
        <div></div>
    </div>

    <div class="eclipse-white">
        <div></div>
    </div>
</div>

@foreach ($heros as $hero )
<div class="bg-img-char-2">

    <div class="bg-img-char">
        <img src="{{ $hero->getMedia('backgroundtwo')->first()->getUrl() }}" alt="">
    </div>

    <div class="img-char">
        <img src="{{ $hero->getMedia('chartwo')->first()->getUrl() }}" alt="">
    </div>
</div>

<div class="bg-img-chars-1">
    <div class="bg-img-chars-2">
        <img src="{{ $hero->getMedia('backgroundone')->first()->getUrl() }}" alt="">
    </div>

    <div class="img-char-2">
        <img src="{{ $hero->getMedia('charone')->first()->getUrl() }}" alt="">
    </div>
</div>
@endforeach

<h3 class="sub-header">
    {{ $heros[0]->sub }}
</h3>

<div class="text-header">

    <div class="header">
        <h1 class="header-1">{{ $heros[0]->header1 }}</h1>
        <h1 class="header-2">{{ $heros[0]->header2 }}</h1>
        <h1 class="header-3">{{ $heros[0]->header3 }}</h1>
    </div>

    <div class="header-paragraph">
        <p>{{ $heros[0]->desc }}
        </p>
    </div>

    <div class="button-header">
        <a href="homes/shop">Play Market</a>
    </div>
</div>


    @endsection
