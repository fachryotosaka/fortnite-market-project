<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Main;
use App\Models\News;
use App\Models\Shop;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{

    public function index()
    {
        $heros = Hero::all();
        return view('landing-page.hero', compact('heros'));
    }
    public function shop()
    {
        $shops = Shop::all();
        return view('landing-page.content', compact('shops'));
    }
    public function news()
    {
        $news = News::all();
        $main = Main::all();
        return view('landing-page.news', compact('news', 'main'));
    }

    // public function __construct() {
    //     $this->middleware('auth');
    // }

    public function detail($id)
    {
        $details = Shop::findOrFail($id);
        return view('landing-page.detail', compact('details'));
    }

}
