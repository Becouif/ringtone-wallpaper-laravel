<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Ringtone;

class RingtoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ringtones = Ringtone::paginate(3);
        return view('backend.ringtone.index',compact('ringtones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('backend.ringtone.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:3|max:100',
            'description'=> 'required|min:3|max:500',
            'file'=> 'required|mimes:mp3',
            'category'=>'required'
        ]);

        // get file uploaded name 
        $fileName = $request->file->hashName();
        // get the file format 
        $format = $request->file->getClientOriginalExtension();
        // get size too 
        $size = $request->file->getSize();
        // set path 
        $request->file->move(public_path('audio'),$fileName);
        // dont forget to make audio folder in public 


        $ringtone = new Ringtone;
        $ringtone->title = $request->get('title');
        $ringtone->description = $request->get('description');
        $ringtone->slug = Str::slug($request->get('title'));
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $format;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        $ringtone->save();
        return redirect()->route('ringtone.index')->with('message','ringtone successfully created');

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
        $ringtone = Ringtone::find($id);
        return view('backend.ringtone.edit',compact('ringtone'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request,[
            'title'=>'required|min:3|max:100',
            'description'=> 'required|min:3|max:500',
            // 'file'=> 'required|mimes:mp3',
            'category'=>'required'
        ]);

        $ringtone = Ringtone::find($id);
        $fileName = $ringtone->file;
        $format = $ringtone->format;
        $size = $ringtone->size;
        $download = $request->download;
        if($request->hasFile('file')){
            $fileName = $request->file->hasName();
            $format= $request->file->getClientOriginalExtension();
            $size = $request->file->getSize();
            $request->file->move(public_path('audio'),$fileName);
            unlink(public_path('/audio/'.$ringtone->file));
            $download = 0;
        }
        $ringtone->title = $request->get('title');
        $ringtone->description = $request->get('description');
        $ringtone->category_id = $request->get('category');
        $ringtone->format = $format;
        $ringtone->size = $size;
        $ringtone->file = $fileName;
        if($download == null){
            $ringtone->download = 0;
        } else {
            $ringtone->download = $download;
        }
        
        $ringtone->save();
        return redirect()->route('ringtone.index')->with('message','Ringtone updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ringtone = Ringtone::find($id);
        $fileName = $ringtone->file;
        $ringtone->delete();

        // then delete from public folder 
        unlink(public_path('/audio/'.$ringtone->file));
        return redirect()->route('ringtone.index')->with('message','Ringtone successfully deleted');
    }
}
