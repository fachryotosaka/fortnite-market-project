<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class SaController extends Controller
{
    public function sa()
    {
        Alert::info('Info Title', 'Success Buy Item');
        return redirect('homes/shop')->with('message', 'Success Buy !');

    }
}
