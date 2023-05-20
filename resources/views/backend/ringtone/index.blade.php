@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('All Ringtones') }}
                  <span class="float-right">
                    <a href="{{route('ringtone.create')}}"><button class="btn btn-info">Create Ringtone</button></a>
                  </span>
                </div>

              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
                      <th>Title</th>
                      <th>Category</th>
                      
                      <th>File</th>
                      <th>Description</th>
                      <th>Download</th>
                      <th>Size</th>
                      <th>Action</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($ringtones)>0)
                      
                    
                    @foreach ($ringtones as $key=>$ringtone)

                    <tr>
                      <td scope="row">{{$key+1}}</td>
                      <td>{{$ringtone->title}}</td>
                      <td>{{$ringtone->category->name}}</td>
                      
                      <td>
                        <audio controls onplay="pauseOthers(this);">
                          <source src="/audio/{{$ringtone->file}}" type="audio/ogg">
                          Your browser does not support this element
                        </audio>
                      </td>
                      <td>{{$ringtone->description}}</td>
                      <td>{{$ringtone->download}}</td>
                      <td>{{$ringtone->size}}bytes</td>
                      <td><a href="{{route('ringtone.edit',[$ringtone->id])}}"><button type="submit" class="btn btn-info">Edit</button></a></td>
                      <td>
                        <form action="{{route('ringtone.destroy',[$ringtone->id])}}" method="post" onSubmit="return confirm('do you want to delete?')">@csrf
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-warning">Delete</button>
                        </form>
                      </td>
                    </tr>
                    
                    @endforeach
                    @else
                    <td><p>No ringtone available yet</p></td>
                    
                    @endif
                    <!-- Add more rows as needed -->
                  </tbody>
                  
                </table>

              </div>
            </div>
            <!-- for pagination  -->
            {{ $ringtones->links() }}
      </div>
</div>





@endsection

