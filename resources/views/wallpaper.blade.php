@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @foreach ($wallpapers as $wallpaper)
        <div class="col-md-8 mt-4">

            

            <div class="card">
                <div class="card-header">{{$wallpaper->title }}</div>

                <div class="card-body">
                    <p>{{$wallpaper->description}}</p>
                    <p>
                      <img src="/uploads/{{$wallpaper->file}}" class="img-thumbnail" alt="">
                    </p>
                </div>
            </div>
            
            
        </div>
        <div class="col-md-3 mt-4">
          <p>
            <form action="{{route('download1',[$wallpaper->id])}}" method="post"> @csrf
              <button class="btn btn-primary">Download 800x600</button>
            </form>
          </p>

          <p>
            <form action="{{route('download2',[$wallpaper->id])}}" method="post">@csrf
              <button class="btn btn-primary">Download 1280x1024</button>
            </form>
          </p>
          <p>
            <form action="{{route('download3',[$wallpaper->id])}}" method="post">@csrf
              <button class="btn btn-primary">Download 316x255</button>
            </form>
          </p>
          <p>
            <form action="{{route('download4',[$wallpaper->id])}}" method="post">@csrf
              <button class="btn btn-primary">Download 118x95</button>
            </form>
          </p>
              
        </div>
            @endforeach
    </div>
</div>
@endsection
