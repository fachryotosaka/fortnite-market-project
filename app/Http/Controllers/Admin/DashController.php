<?php

namespace App\Http\Controllers\Admin;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ImageUploadingTrait;

class DashController extends Controller
{
    use ImageUploadingTrait;


    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $heros = Hero::all();
        return view('dashboard.dashboard', compact('heros'));
    }
}
