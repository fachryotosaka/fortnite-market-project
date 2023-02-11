<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Http\Request;
use Seld\PharUtils\Timestamps;

trait ImageUploadingTrait
{
    public function storeImage(Request $request)
    {
        $path = storage_path('tmp/uploads');


        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function store(Request $request)
    {
        if ($request->hasFiles('image')){
            $file = $request->file('image');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '_' . now()->timestamp;
            $file->storeAs('image/' . $folder, $filename);

            return $folder;
        }

        return '';
    }
}
