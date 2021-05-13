<?php

namespace App\Http\Controllers;


use App\Logic\Image\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PictureUploadController extends Controller
{
    //
    protected $image;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->image = $imageRepository;
    }

    public function getUpload()
    {
        return view("backend/upload/picture-upload");
    }

    public function postUpload(Request $request)
    {
        $photo = Input::all();
        $response = $this->image->upload($photo);
        return $response;
    }

    public function deleteUpload()
    {

        $filename = Input::get('id');

        if(!$filename)
        {
            return 0;
        }

        $response = $this->image->delete( $filename );

        return $response;
    }
}
