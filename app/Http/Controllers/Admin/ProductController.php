<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Hero;
use App\Models\Shop;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\BookRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Traits\ImageUploadingTrait;

class ProductController extends Controller
{
    use ImageUploadingTrait;


    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $shops = Shop::all();
        return view('dashboard.shop.index', compact('shops'));
    }

    // CREATE
    public function create()
    {
        $shops = Shop::all();
        $categories = Category::all();
        return view ('dashboard.shop.createx', compact('shops', 'categories'));
    }

    public function store(Request $request)
    {
        Schema::disableForeignKeyConstraints();


        $shops = Shop::create($request->all());
        // $tests = Test::create($request->all());
        // $tests->tags()->attach($shops);
        // $shops->tags()->attach($request->input('tags', [] ));



        foreach ($request->input('shops', []) as $file) {
            $shops->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('shops');
        }
        Schema::enableForeignKeyConstraints();

        Alert::info('Info Title', 'Success Create Data');

        return redirect('admin/shop')->with('message', 'Success Created !');
    }

    public function show($id)
    {
        $shops = Hero::findOrFail($id);
        return view('dashboard.shop.show', compact('shops'));
    }

    // UPDATE

    public function edit(Request $request, $id)
    {
        $shops = Shop::findOrFail($id);
        $categories = Category::pluck('name', 'id');

        return view('dashboard.shop.edit', compact('shops', 'categories'));
    }

    public function update(Request $request, $id)
    {
        Schema::disableForeignKeyConstraints();


        $shops = Shop::findOrFail($id);

        $shops->update($request->all());

        if (count($shops->getMedia('shops')) > 0) {
            foreach ($shops->getMedia('shops') as $media) {
                if (!in_array($media->file_name, $request->input('shops', []))) {
                    $media->delete();
                }
            }
        }

        $media = $shops->getMedia('shops')->pluck('file_name')->toArray();

        foreach ($request->input('shops', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $shops->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('shops');
            }
        }


        Schema::enableForeignKeyConstraints();
        Alert::info('Info Title', 'Success Update Data');
        return redirect('admin/shop')->with('message', 'Success Created !');
    }



    // DELETE

    public function destroy(Shop $shops, $id)
    {


        $shops = Shop::findOrFail($id);
        $files = $shops->getMedia('shops')->first();
        $files->move($shops, 'trash');


        $shops->delete();


        Alert::info('Info Title', 'Success Move Data To Trash');
        return redirect('admin/dashboard')->with('message', 'Success Delete !');
    }

    public function trash()
    {
        $shops = Shop::onlyTrashed()->get();

        return view('dashboard.shop.trash', compact('shops'));
    }

    public function restore($id)
    {
        $shops = Shop::onlyTrashed()->findOrFail($id);

        $file = $shops->getMedia('trash')->first();
        $file->move($shops, 'shops');

        $shops->restore();

        return redirect('admin/dashboard')->with('message', 'Success Restored !');

    }

    public function force($id)
    {
        $shops = Shop::onlyTrashed()->findOrFail($id);
        $shops->getMedia('trash');
        $shops->clearMediaCollection('trash');
        Schema::disableForeignKeyConstraints();
        $shops->forceDelete();
        Schema::enableForeignKeyConstraints();

        return redirect('admin/dashboard')->with('message', 'Permanently Deleted Success !');

    }

    public function checkout(Request $request, $id)
    {


        $payment = new PaymentController();
        $channels = $payment->getPayment();

        $item = Shop::findOrFail($id);
        return view('check', compact('item', 'channels', ));
    }



}
