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
                <div class="card-header">{{ __('Upload Photo') }}</div>

                <div class="card-body">
                   <form action="{{route('photo.store')}}" enctype="multipart/form-data" method="post">@csrf
                    <div class="form-group">
                      <label for="">Title</label>
                      <input type="text" name="title" class="form-control @error('title') is-invalid @enderror">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <label for="">Description</label>
                      <textarea name="description" class="form-control @error('description') is-invalid @enderror" id=""></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <div class="form-group">
                      <label for="">File</label>
                      <input type="file" class="form-control @error('image') is-invalid @enderror" accept="image/*" name="image">
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                    </div>
                    <br>
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
