@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" id="category-create">
              <div>
                @if (Session::has('message'))
                  {{ Session::get('message') }}
                @endif
              </div>
                <div class="card-header">{{ __('Create Category') }}</div>

                <div class="card-body">
                   <form action="{{ route('category.store') }}" method="post">@csrf
                    <div class="form-group">
                      <label for="">Name</label>
                      <input type="text" name="name" class="form-control">
                    </div>
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                   </form>
                </div>
            </div>
            <br><br>
            <!-- start of list of category  -->
            <div class="card">
              <div class="card-header">List Category</div>
              <div class="card-body">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if (count($categories)>0)
                    @foreach ($categories as $key=>$category)

                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$category->name}}</td>
                      <td>
                        <form action="{{route('category.destroy',[$category->id])}}" method="post">@csrf
                          {{ method_field('DELETE') }}
                          <button class="btn btn-warning">Delete</button>
                        </form>
                    </td>
                    </tr>
                    @endforeach
                    @else
                    <p>No category available</p>
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
        </div>
    </div>
</div>



@endsection
