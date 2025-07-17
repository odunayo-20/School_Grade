<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TinyMCEController extends Controller
{
    public function uploadTinyMCEImage(Request $request)
{
    if ($request->hasFile('file')) {
        $file = $request->file('file');

        if ($file->isValid()) {
            $path = $file->storeAs(
                'public/uploads/tinymce',
                Str::uuid() . '.' . $file->getClientOriginalExtension()
            );

            $url = Storage::url($path); // e.g. /storage/uploads/tinymce/uuid.jpg

            return response()->json(['location' => $url]);
        }
    }

    return response()->json(['error' => 'Upload failed'], 422);
}
}
