<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\SlideStoreRequest;
use App\Services\ImageUploader;

class SliderController extends Controller
{
    public function index() {
        return view('slider.slider');
    }

    public function storeSlide(SlideStoreRequest $request, Slider $slider, ImageUploader $imageUploader) {
        // Validate rules r in Request/SlideStoreRequest class
        // $request->validated();
        $imgParams = ['images/', 'images/slide/', 1100, 500, 3145728]; //parent folder, sub folder, width, height, size in MB
        $getImgUrlOrError = $imageUploader->handleImageUpload($request->file('image'), $request->name, $imgParams);
        if ($getImgUrlOrError == 'unSupportedFile') {
            return redirect()->back()->with('fileError', config('message.un_supported_file'));
        } elseif ($getImgUrlOrError == 'largeFile') {
            return redirect()->back()->with('fileError', config('message.large_file'));
        } else {
            $slider->saveSlide($request, $getImgUrlOrError);
            return redirect()->back()->with('message', config('message.slide_saved'));
        }

    }
}
