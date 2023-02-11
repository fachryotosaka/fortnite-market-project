<?php

namespace App\Http\Controllers\Admin;

use App\Models\Book;
use App\Models\Hero;
use App\Models\News;
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

class NewsController extends Controller
{
    use ImageUploadingTrait;


    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $news = News::all();
        return view('dashboard.News.index', compact('news'));
    }

    // CREATE
    public function create()
    {
        $news = News::all();
        return view ('dashboard.News.createx', compact('news'));
    }

    public function store(Request $request)
    {
        $news = News::create($request->all());
    



        foreach ($request->input('news', []) as $file) {
            $news->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('news');
        }

        Alert::info('Info Title', 'Success Create Data');

        return redirect('admin/news')->with('message', 'Success Created !');
    }

    public function show($id)
    {
        $news = News::findOrFail($id);
        return view('dashboard.News.show', compact('news'));
    }

    // UPDATE

    public function edit(Request $request, $id)
    {
        $news = News::findOrFail($id);

        return view('dashboard.News.edit', compact('news'));
    }

    public function update(Request $request, $id)
    {
        $news = News::findOrFail($id);

        $news->update($request->all());

        if (count($news->getMedia('news')) > 0) {
            foreach ($news->getMedia('news') as $media) {
                if (!in_array($media->file_name, $request->input('news', []))) {
                    $media->delete();
                }
            }
        }

        $media = $news->getMedia('news')->pluck('file_name')->toArray();

        foreach ($request->input('news', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $news->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('news');
            }
        }


        Alert::info('Info Title', 'Success Update Data');
        return redirect('admin/news')->with('message', 'Success Created !');
    }



    // DELETE

    public function destroy(News $news, $id)
    {


        $news = News::findOrFail($id);
        $files = $news->getMedia('news')->first();
        $files->move($news, 'trash');


        $news->delete();


        Alert::info('Info Title', 'Success Move Data To Trash');
        return redirect('admin/news')->with('message', 'Success Delete !');
    }

    public function trash()
    {
        $news = News::onlyTrashed()->get();

        return view('dashboard.News.trash', compact('news'));
    }

    public function restore($id)
    {
        $news = News::onlyTrashed()->findOrFail($id);

        $file = $news->getMedia('trash')->first();
        $file->move($news, 'news');

        $news->restore();

        return redirect('admin/news')->with('message', 'Success Restored !');

    }

    public function force($id)
    {
        $news = News::onlyTrashed()->findOrFail($id);
        $news->getMedia('trash');
        $news->clearMediaCollection('trash');
        Schema::disableForeignKeyConstraints();
        $news->forceDelete();
        Schema::enableForeignKeyConstraints();

        return redirect('admin/news')->with('message', 'Permanently Deleted Success !');

    }

}
