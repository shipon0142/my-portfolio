<?php

namespace App\Http\Controllers\Admin\Study;

use App\Http\Controllers\Admin\Controller;
use App\Http\Requests\Admin\Study\UploadImageRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UploadController extends Controller
{
    public function store(UploadImageRequest $request): JsonResponse
    {
        $file = $request->file('upload');
        $ext  = $file->getClientOriginalExtension() ?: $file->extension();
        $name = Str::uuid()->toString().'.'.$ext;

        $disk = config('study.upload_disk', 'public');
        $dir  = config('study.upload_dir',  'study');

        $path = $file->storeAs($dir, $name, $disk);

        return response()->json([
            'url' => Storage::disk($disk)->url($path),
        ]);
    }
}
