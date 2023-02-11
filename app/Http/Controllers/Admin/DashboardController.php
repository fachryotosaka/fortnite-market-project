<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\BookRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Traits\ImageUploadingTrait;

class DashboardController extends Controller
{
    use ImageUploadingTrait;


    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $heros = Hero::all();
        return view('dashboard.Hero.index', compact('heros'));
    }

    // CREATE
    public function create()
    {
        $heros = Hero::all();
        return view ('dashboard.Hero.createx', compact('heros'));
    }

    public function store(Request $request)
    {
        $heros = Hero::create($request->all());

        foreach ($request->input('backgroundone', []) as $file) {
            $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('backgroundone');
        }
        foreach ($request->input('backgroundtwo', []) as $file) {
            $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('backgroundtwo');
        }
        foreach ($request->input('charone', []) as $file) {
            $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('charone');
        }
        foreach ($request->input('chartwo', []) as $file) {
            $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('chartwo');
        }
        foreach ($request->input('body', []) as $file) {
            $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('body');
        }

        Alert::info('Info Title', 'Success Create Data');

        return redirect('admin/dashboard')->with('message', 'Success Created !');
    }

    public function show($id)
    {
        $heros = Hero::findOrFail($id);
        return view('dashboard.Hero.show', compact('heros'));
    }

    // UPDATE

    public function edit(Request $request, $id)
    {
        $heros = Hero::findOrFail($id);

        return view('dashboard.Hero.edit', compact('heros'));
    }

    public function update(Request $request, $id)
    {
        $heros = Hero::findOrFail($id);

        $heros->update($request->all());

        if (count($heros->getMedia('backgroundone')) > 0) {
            foreach ($heros->getMedia('backgroundone') as $media) {
                if (!in_array($media->file_name, $request->input('backgroundone', []))) {
                    $media->delete();
                }
            }
        }

        $media = $heros->getMedia('backgroundone')->pluck('file_name')->toArray();

        foreach ($request->input('backgroundone', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('backgroundone');
            }
        }

        // Image 1

        if (count($heros->getMedia('backgroundtwo')) > 0) {
            foreach ($heros->getMedia('backgroundtwo') as $media1) {
                if (!in_array($media1->file_name, $request->input('backgroundtwo', []))) {
                    $media1->delete();
                }
            }
        }

        $media1 = $heros->getMedia('backgroundtwo')->pluck('file_name')->toArray();

        foreach ($request->input('backgroundtwo', []) as $file) {
            if (count($media1) === 0 || !in_array($file, $media1)) {
                $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('backgroundtwo');
            }
        }

        // Image 2

        if (count($heros->getMedia('charone')) > 0) {
            foreach ($heros->getMedia('charone') as $media2) {
                if (!in_array($media2->file_name, $request->input('charone', []))) {
                    $media2->delete();
                }
            }
        }

        $media2 = $heros->getMedia('charone')->pluck('file_name')->toArray();

        foreach ($request->input('charone', []) as $file) {
            if (count($media2) === 0 || !in_array($file, $media2)) {
                $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('charone');
            }
        }

        // Image 3

        if (count($heros->getMedia('chartwo')) > 0) {
            foreach ($heros->getMedia('chartwo') as $media3) {
                if (!in_array($media3->file_name, $request->input('chartwo', []))) {
                    $media3->delete();
                }
            }
        }

        $media3 = $heros->getMedia('chartwo')->pluck('file_name')->toArray();

        foreach ($request->input('chartwo', []) as $file) {
            if (count($media3) === 0 || !in_array($file, $media3)) {
                $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('chartwo');
            }
        }

        // Image 4

        if (count($heros->getMedia('body')) > 0) {
            foreach ($heros->getMedia('body') as $media4) {
                if (!in_array($media4->file_name, $request->input('body', []))) {
                    $media4->delete();
                }
            }
        }

        $media4 = $heros->getMedia('body')->pluck('file_name')->toArray();

        foreach ($request->input('body', []) as $file) {
            if (count($media4) === 0 || !in_array($file, $media4)) {
                $heros->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('body');
            }
        }

        Alert::info('Info Title', 'Success Update Data');
        return redirect('admin/dashboard')->with('message', 'Success Update !');

    }



    // DELETE

    public function destroy(Hero $hero, $id)
    {


        $hero = Hero::findOrFail($id);
        $files = $hero->getMedia('backgroundone')->first();
        $files1 = $hero->getMedia('backgroundtwo')->first();
        $files2 = $hero->getMedia('charone')->first();
        $files3 = $hero->getMedia('chartwo')->first();
        $files4 = $hero->getMedia('body')->first();
        $files->move($hero, 'trash');
        $files1->move($hero, 'trash1');
        $files2->move($hero, 'trash2');
        $files3->move($hero, 'trash3');
        $files4->move($hero, 'trash4');

        $hero->delete();


        Alert::info('Info Title', 'Success Move Data To Trash');
        return redirect('admin/dashboard')->with('message', 'Success Delete !');
    }

    public function trash()
    {
        $heros = hero::onlyTrashed()->get();

        return view('dashboard.Hero.trash', compact('heros'));
    }

    public function restore($id)
    {
        $hero = hero::onlyTrashed()->findOrFail($id);

        $file = $hero->getMedia('trash')->first();
        $file1 = $hero->getMedia('trash1')->first();
        $file2 = $hero->getMedia('trash2')->first();
        $file3 = $hero->getMedia('trash3')->first();
        $file4 = $hero->getMedia('trash4')->first();
        $file->move($hero, 'backgroundone');
        $file1->move($hero, 'backgroundtwo');
        $file2->move($hero, 'charone');
        $file3->move($hero, 'chartwo');
        $file4->move($hero, 'body');

        $hero->restore();

        return redirect('admin/dashboard')->with('message', 'Success Restored !');

    }

    public function force($id)
    {
        $hero = Hero::onlyTrashed()->findOrFail($id);
        $hero->getMedia('trash');
        $hero->getMedia('trash1');
        $hero->getMedia('trash2');
        $hero->getMedia('trash3');
        $hero->getMedia('trash4');
        $hero->clearMediaCollection('trash');
        $hero->clearMediaCollection('trash1');
        $hero->clearMediaCollection('trash2');
        $hero->clearMediaCollection('trash3');
        $hero->clearMediaCollection('trash4');
        Schema::disableForeignKeyConstraints();
        $hero->forceDelete();
        Schema::enableForeignKeyConstraints();

        return redirect('admin/dashboard')->with('message', 'Permanently Deleted Success !');

    }

}
