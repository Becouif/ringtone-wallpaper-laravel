<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Photo;
use Image;
class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::latest()->paginate(20);
        return view('backend.Photo.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:3|max:120',
            'description'=>'required|min:3|max:200',
            'image'=>'required|mimes:jpg,jpeg,png',
        ]);
        $image = $request->file('image');
        $fileName = $image->hashName();
        $size = $request->image->getSize();

        // get format 
        $format = $request->image->getClientOriginalExtension();
        $path = 'uploads/'.$fileName;
        $path1 = 'uploads/1280x1024/'.$fileName;
        $path2 = 'uploads/316x255/'.$fileName;
        $path3 = 'uploads/118x95/'.$fileName;

        // make size with laravel intervention 
        Image::make($image->getRealPath())->resize(1280,1024)->save($path1);
        Image::make($image->getRealPath())->resize(800,600)->save($path);
        
        Image::make($image->getRealPath())->resize(312,255)->save($path2);
        Image::make($image->getRealPath())->resize(118,95)->save($path3);

        $photo = new Photo;
        $photo->title = $request->title;
        $photo->description = $request->description;
        $photo->file = $fileName;
        $photo->format = $format;
        $photo->size = $size;
        $photo->save();
        return redirect()->route('photo.index')->with('message','Image uploaded!!!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $photo = Photo::find($id);
        return view('backend.photo.update',compact('photo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validation 
        $this->validate($request,[
            'title'=>'required|min:3|max:100',
            'description'=>'required|min:3|max:300',
        ]);

        // details of the photo from DB 
        $photo = Photo::find($id);
        $fileName = $photo->file;
        $format = $photo->format;
        $size = $photo->size;
        // check if user upload new image 
        if($request->hasFile('image')){
            $image = $request->file('image');
            $newFileName = $image->hashName();
            $size = $request->image->getSize();
            $format = $request->image->getClientOriginalExtension();

            $path = 'uploads/'.$newFileName;
            $path1 = 'uploads/1280x1024/'.$newFileName;
            $path2 = 'uploads/316x255/'.$newFileName;
            $path3 = 'uploads/118x95/'.$newFileName;

            // create new image and size also save 
            Image::make($image->getRealPath())->resize(800,600)->save($path);
            Image::make($image->getRealPath())->resize(1280,1024)->save($path);
            Image::make($image->getRealPath())->resize(316,255)->save($path);
            Image::make($image->getRealPath())->resize(118,95)->save($path);

            // delete the previous images 
            unlink(public_path('uploads/'.$photo->file));
            unlink(public_path('uploads/118x95/'.$photo->file));
            unlink(public_path('uploads/316x255/'.$photo->file));
            unlink(public_path('uploads/118x95/'.$photo->file));
            // dd($photo->file);

            $photo->title = $request->get('title');
            $photo->description =$request->get('description');
            $photo->format = $format;
            $photo->file = $newFileName;
            $photo->save();

            return redirect()->route('photo.index')->with('message','photo uploaded successfully');

        } else {
            $photo->title = $request->get('title');
            $photo->description =$request->get('description');
            $photo->format = $format;
            $photo->file = $fileName;
            $photo->save();

            return redirect()->route('photo.index')->with('message','photo uploaded successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $photo = Photo::find($id);
        $fileName = $photo->file;
        $photo->delete();

        // then delete from public folder 
        unlink(public_path('uploads/'.$photo->file));
        unlink(public_path('uploads/118x95/'.$photo->file));
        unlink(public_path('uploads/316x255/'.$photo->file));
        unlink(public_path('uploads/1280x1024/'.$photo->file));
        return redirect()->route('photo.index')->with('message','Photo successfully deleted');
    }
}
