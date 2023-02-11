<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Hero;
use App\Models\Main;
use App\Models\Shop;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\BookRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Traits\ImageUploadingTrait;

class mainController extends Controller
{
    use ImageUploadingTrait;


    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $main = Main::all();
        return view('dashboard.main.index', compact('main'));
    }

    public function getAllData(){
        $main = Main::all();

        return response()->json([
            'massages' => 'success',
            'data' => $main
        ], 200);
    }

    // CREATE
    public function create()
    {
        $main = Main::all();
        return view ('dashboard.main.createx', compact('main'));
    }

    public function store(Request $request)
    {
        $main = Main::create($request->all());

        foreach ($request->input('main', []) as $file) {
            $main->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('main');
        }

        Alert::info('Info Title', 'Success Create Data');

        return redirect('admin/main')->with('message', 'Success Created !');
    }

    // UPDATE

    public function edit(Request $request, $id)
    {
        $main = Main::findOrFail($id);

        return view('dashboard.main.edit', compact('main'));
    }

    public function update(Request $request, $id)
    {
        $main = Main::findOrFail($id);

        $main->update($request->all());

        if (count($main->getMedia('main')) > 0) {
            foreach ($main->getMedia('main') as $media) {
                if (!in_array($media->file_name, $request->input('main', []))) {
                    $media->delete();
                }
            }
        }

        $media = $main->getMedia('main')->pluck('file_name')->toArray();

        foreach ($request->input('main', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $main->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('main');
            }
        }


        Alert::info('Info Title', 'Success Update Data');
        return redirect('admin/main')->with('message', 'Success Created !');
    }



    // DELETE

    public function destroy(main $main, $id)
    {


        $main = Main::findOrFail($id);
        $files = $main->getMedia('main')->first();
        $files->move($main, 'trash');


        $main->delete();


        Alert::info('Info Title', 'Success Move Data To Trash');
        return redirect('admin/main')->with('message', 'Success Delete !');
    }

    public function trash()
    {
        $main = Main::onlyTrashed()->get();

        return view('dashboard.main.trash', compact('main'));
    }

    public function restore($id)
    {
        $main = Main::onlyTrashed()->findOrFail($id);

        $file = $main->getMedia('trash')->first();
        $file->move($main, 'main');

        $main->restore();

        return redirect('admin/main')->with('message', 'Success Restored !');

    }

    public function force($id)
    {
        $main = Main::onlyTrashed()->findOrFail($id);
        $main->getMedia('trash');
        $main->clearMediaCollection('trash');
        Schema::disableForeignKeyConstraints();
        $main->forceDelete();
        Schema::enableForeignKeyConstraints();

        return redirect('admin/main')->with('message', 'Permanently Deleted Success !');

    }

}
