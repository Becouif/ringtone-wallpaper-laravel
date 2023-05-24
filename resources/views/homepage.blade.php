@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
      
        <div class="col-md-8">
          @if (count($ringtones)>0)
            
         
            @foreach ($ringtones as $ringtone)
            
          
            <div class="card" style="margin-top:50px;">
                <div class="card-header">{{ $ringtone->title }}</div>

                <div class="card-body">
                   <audio controls onplay="pauseOthers(this)" controlsList="nodownload">
                    <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                    this browser does not support this element
                   </audio>
                </div>
                <div class="card-footer">
                  <a class="btn btn-info" href="{{route('show.ringtone',[$ringtone->id,$ringtone->slug])}}">Info and Download</a>
                </div>
            </div>
            @endforeach
            @else 
            <p>No ringtone uploaded yet</p>
          @endif
        </div>
        
        <!-- start of the category section code  -->
        <div class="col-md-4" style="margin-top:50px;">
        <div class="list-container">
          <h1>Category</h1>
        @foreach (App\Models\Category::all() as $category)
            <div class="list-group">
              <a href="{{route('ringtones.category',[$category->id])}}" class="list-group-item">{{$category->name}}</a>
              
            </div>
        @endforeach
     
    </div>
    {{ $ringtones->links() }}
        </div>
    </div>
</div>


<style>
    /* Custom styles for the list */
    .list-container {
      max-width: 500px;
      margin: 0 auto;
    }

    .list-group-item {
      border: none;
      background-color: #f8f9fa;
      color: #333;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 4px;
    }

    .list-group-item:hover {
      background-color: #e9ecef;
      cursor: pointer;
    }
  </style>
@endsection
