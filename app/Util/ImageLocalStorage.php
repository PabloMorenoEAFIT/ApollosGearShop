<?php

namespace App\Util;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageLocalStorage implements ImageStorage
{
    public function store(Request $request): string
    {
        if ($request->hasFile('image')) {
            $filename = 'image_'.Str::uuid().'.'.$request->file('image')->getClientOriginalExtension();
            $path = 'images/'.$filename;

            Storage::disk('public')->put(
                $path,
                file_get_contents($request->file('image')->getRealPath())
            );

            return $path;
        }
    }
}
