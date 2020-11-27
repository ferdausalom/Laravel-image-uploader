<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\SlideStoreRequest;
use App\Services\ImageUploader;

class SliderController extends Controller
{
    public function storeSlide(SlideStoreRequest $request, Slider $slider, ImageUploader $imageUploader) {
        // Validate rules r in Request/SlideStoreRequest class
        // $request->validated();
        $imgParams = ['images/', 'images/brand/', 200, 200, 3145728]; //parent folder, sub folder, width, height, size in MB
        $getImgUrlOrError = $imageUploader->handleImageUpload($request->file('image'), $request->name, $imgParams);
        $slider->saveSlide($request, $getImgUrlOrError);
        return redirect()->back()->with('message', config('message.slide.slide_saved'));
    }
}
