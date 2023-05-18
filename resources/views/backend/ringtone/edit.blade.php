@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
          @if (Session::has('message'))
            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>
          @endif
            <div class="card">
                <div class="card-header">{{ __('Edit Ringtone') }}</div>

                <div class="card-body">
                   <form action="{{route('ringtone.update',[$ringtone->id])}}" enctype="multipart/form-data" method="post">@csrf
                    {{ method_field('PUT') }}
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$ringtone->title}}">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id="">{{$ringtone->description}}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <label for="">File</label>
                      <audio controls>
                        <source src="/audio/{{$ringtone->file}}" type="audio/wav">
                        this browser can not display this audio, try another browser or update your current browser
                      </audio>
                      <input type="file" class="form-control @error('file') is-invalid @enderror" accept="audio/*" name="file">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Choose Category</label>
                      <select class="form-control @error('category') is-invalid @enderror" name="category" id="">
                        <option value="">select category</option>
                        @foreach (App\Models\Category::all() as $category)

                        <option value="{{$category->id}}" @if ($category->id == $ringtone->category_id) selected
                          
                        @endif>{{ $category->name }}
                        </option>

                        @endforeach
                        
                      </select>
                                @error('category')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
