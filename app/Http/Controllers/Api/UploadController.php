<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function uploadImage(Request $request)
    {
        if ($request->has('image')) {
            $image = $request->image;
            $nameFile = time() . '.' . $image->getClientOriginalExtension();
            $path = public_path('upload/images');
            $image->move($path, $nameFile);

            return response()->json([
                'image_path' => '/upload/images/' . $nameFile,
                'base_url' => url('/'),
            ]);
        }
    }

    public function uploadMultipleImage(Request $request)
    {
        if ($request->has('image')) {
            $images = $request->image;
            $result = [];

            foreach ($images as $key => $image) {
                $nameFile = time() . $key . '.' . $image->getClientOriginalExtension();
                $path = public_path('upload/images');
                $image->move($path, $nameFile);
                $result[] = '/upload/images/' . $nameFile;
            }

            return response()->json([
                'image_path' => $result,
                'base_url' => url('/'),
            ]);
        }
    }
}
