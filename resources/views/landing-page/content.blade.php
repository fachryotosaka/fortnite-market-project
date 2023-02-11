@extends('layouts.landing-tamplate-2')
@section('content')
@include('sweetalert::alert')
<div class="bg-img-cntn">
    <img src="{{ asset('img/bg-p-2.png') }}" alt="">
</div>

<div class="news-img">
    <img src="{{ asset('img/HEHE.png') }}" alt="">
</div>

<div class="card-comp">
    @foreach ($shops as $shop )

    <div class="card">
        <div class="item-img">
            <img src="{{ $shop->getMedia('shops')->first()->getUrl() }}" alt="">
        </div>
        <h5 class="header-card">
            {{ $shop->name }}
        </h5>
        <h6 class="sub-header-card">
            {{ $shop->Category->name }}
        </h6>
        <h4 class="price-card">
            Rp.{{ number_format($shop->price) }}
        </h4>
        <div class="button-buy-card">
            <a href="{{ route('detail-shop', $shop->id) }}">Buy</a>
        </div>
    </div>

    @endforeach

</div>


@endsection

