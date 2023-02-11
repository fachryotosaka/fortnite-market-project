<section>
    {{-- navbar --}}
    <nav>

    <div class="header">
        <img src="{{ asset('img/icon.png') }}" alt="">
    </div>

    <div class="container">
            <ul>
                <li>
                    <a href="/" class="li">Home</a>
                </li>
                <li>
                    <a href="/homes/shop" class="li" >Shop</a>
                </li>
                <li>
                    <a href="/homes/news" class="li" >News</a>
                </li>
            </ul>
        </div>


        @guest
        <div class="sign-button">
            <a href="/login">Sign In</a>
        </div>
        @else

        <div class="sign-button-after">
            <div class="sign">
                <a style="heigh
                100px" href="/" onclick="event.preventDefault();document.querySelector('#logout-form').submit()">{{ auth()->user()->name }}</a>
                <form action="{{ route('logout') }}" id="logout-form" method="POST">
                    @csrf
                </form>
        </div>

            <div class="sign2">
                <a href="/homes" onclick="event.preventDefault();document.querySelector('#logout-form').submit()"></a>
                <form action="{{ route('logout') }}" id="logout-form" method="POST">
                    @csrf
                </form>
            </div>
            @endguest

        </div>

    </nav>

    {{-- end Navbar --}}


</section>
