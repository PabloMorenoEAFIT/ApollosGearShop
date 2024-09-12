<?php

namespace App\Services;

use App\Interfaces\ImageStorage;
use Illuminate\Http\Request;

class ImageService
{
    protected ImageStorage $imageStorage;

    public function __construct(ImageStorage $imageStorage)
    {
        $this->imageStorage = $imageStorage;
    }

    public function store(Request $request): string
    {
        if ($request->hasFile('image')) {
            return $this->imageStorage->store($request);
        }
    }
}
