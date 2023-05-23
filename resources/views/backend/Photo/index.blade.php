@extends('layouts.app')

@section('content')
<div class="container">
      <div class="row justify-content-center">
          @if (Session::has('message'))
            <div class="alert alert-success">
              {{ Session::get('message') }}
            </div>
          @endif
            <div class="card">
                <div class="card-header">{{ __('Images') }}
                  <span class="float-right">
                    <a href="{{route('photo.create')}}"><button class="btn btn-info">Upload Images</button></a>
                  </span>
                </div>

              <div class="card-body">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">NO</th>
                      <th>File</th>
                      <th>Title</th>
                      <th>Description</th>
                      <th>Format</th>
                      <th>Size</th>
                      <th>action</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($photos)>0)
                      
                    
                    @foreach ($photos as $key=>$photo)

                    <tr>
                    
                      <td scope="row">{{$key+1}}</td>
                      <td>
                        <img src="/uploads/{{$photo->file}}" width="100" alt="">
                      </td>
                      <td>{{$photo->title}}</td>

                      
                      
                      <td>{{$photo->description}}</td>
                      <td>{{$photo->format}}</td>
                      <!-- convert to kb from bytes  -->
                      <td>{{round($photo->size)*0.001,2}}kb</td>
                      <td><a href="{{route('photo.edit',[$photo->id])}}"><button class="btn btn-info">Update</button></a></td>
                      <td>
                        <form action="{{route('photo.destroy',[$photo->id])}}" method="post" onSubmit="return confirm('do you want to delete?')">@csrf
                          {{ method_field('DELETE') }}
                          <button type="submit" class="btn btn-warning">Delete</button>
                        </form>
                      </td>
                    </tr>
                    
                    @endforeach
                    @else
                    <td><p>No photo available yet</p></td>
                    
                    @endif
                    <!-- Add more rows as needed -->
                  </tbody>
                  
                </table>

              </div>
            </div>
            <!-- for pagination  -->
            {{ $photos->links() }}
      </div>
</div>





@endsection

