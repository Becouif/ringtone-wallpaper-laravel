@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin-top:58px;">
                <div class="card-header">{{ $ringtone->title }}</div>

                <div class="card-body">
                        <audio controls controlsList="nodownload">
                          <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                          Your browser does not support this element
                        </audio>
                </div>
                <div class="card-footer">
                  <form action="{{route('ringtone.download',[$ringtone->id])}}" method="post">@csrf
                    <button type="submit" class="btn btn-secondary btn-sm">Downloads</button>
                  </form>
                  
                </div>
            </div>

            <table class="table mt-4">
              <tr>
                <th>Name</th>
                <td>{{$ringtone->title}}</td>
              </tr>
              <tr>
                <th>Description</th>
                <td>{{$ringtone->description}}</td>
              </tr>
              <tr>
                <th>Format</th>
                <td>{{$ringtone->format}}</td>
              </tr>
              <tr>
                <th>Size</th>
                <td>{{$ringtone->size}}</td>
              </tr>
              <tr>
                <th>Category</th>
                <td>{{$ringtone->category->name ?? null}}</td>
              </tr>
              <tr>
                <th>Downloads</th>
                <td>{{$ringtone->download}}</td>
              </tr>
            </table>
        </div>
        <!-- category start  -->
        <div class="col-md-4" style="margin-top:50px;">
          <div class="list-container">
            <h1>Category</h1>
            @foreach (App\Models\Category::all() as $category)
                <div class="list-group">
                  <a href="{{route('ringtones.category',[$category->id])}}" class="list-group-item">{{$category->name}}</a>
                  
                </div>
            @endforeach
      
          </div>
        </div>

        <!-- end of category  -->
        </div>
      </div>
      <!-- comment section widget part start  -->

      <div id="wpac-comment"></div>
  <script type="text/javascript">
  wpac_init = window.wpac_init || [];
  wpac_init.push({widget: 'Comment', id: 12345});
  (function() {
    if ('WIDGETPACK_LOADED' in window) return;
    WIDGETPACK_LOADED = true;
    var mc = document.createElement('script');
    mc.type = 'text/javascript';
    mc.async = true;
    mc.src = 'https://cdn.widgetpack.com/widget.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(mc, s.nextSibling);
  })();
  </script>

</div>
@endsection
