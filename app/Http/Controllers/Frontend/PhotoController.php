<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
class PhotoController extends Controller
{
    //
    public function index(){
        $wallpapers = Photo::latest()->paginate(20);
        return view('wallpaper',compact('wallpapers'));
    }

    public function download800x600($id){
        $image = Photo::find($id);
        $imageName = $image->file;
        $filePath = public_path('uploads/').$imageName;
        return \Response::download($filePath);
    }
    public function download1280x1024($id){
        $image = Photo::find($id);
        $imageName = $image->file;
        $filePath = public_path('uploads/1280x1024/').$imageName;
        return \Response::download($filePath);
    }
    public function download316x255($id){
        $image = Photo::find($id);
        $imageName = $image->file;
        $filePath = public_path('uploads/316x255/').$imageName;
        return \Response::download($filePath);
    }
    public function download118x95($id){
        $image = Photo::find($id);
        $imageName = $image->file;
        $filePath = public_path('uploads/118x95/').$imageName;
        return \Response::download($filePath);
    }
}
