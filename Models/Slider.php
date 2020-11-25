<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;

    public function saveSlide($request, $imgUrl) {
        $this->yourColumnData = $request->yourFormData;
        $this->image          = $imgUrl;
        $this->save();
    }

}
