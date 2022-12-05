@extends('posts.layout')
@section('title')
EDIT POST
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Post</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
            </div>
        </div>
    </div>

    <form action="{{ route('posts.update', $posts['post']->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Post Title:</strong>
                    <input type="text" name="title" value="{{ old('title') ? old('title') : $posts['post']->title }}"
                        class="form-control" placeholder="Post Title">
                    @error('title')
                        <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Description:</strong>
                    <input type="text" name="description"
                        value="{{ old('description') ? old('description') :  $posts['post']->description }}" class="form-control"
                        placeholder="Post Description">
                    @error('description')
                        <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                    @enderror
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Post Status:</strong>
                    <input type="text" name="status" value="{{ old('status') ? old('status') : $posts['post']->status }}"
                        class="form-control" placeholder="Post Status">
                    @error('status')
                        <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                    @enderror
                </div>
            </div>
            <h3 class="text-primary mt-3">Choose Category</h3>
            <div>
            <select class="form-select mt-3" name="category[]" multiple>
                <option></option>
                @foreach ($posts['categories'] as $category)
                 @if($loop->index===0)
                   <option value="{{$category->id}}" selected >{{$category->name}}</option>
                 @else
                 <option value="{{$category->id}}" >{{$category->name}}</option>
             @endif
             @endforeach
               </select>
               <div>

               @error('status')
               <div class="text-danger mt-1 mb-1">*{{ $message }}*</div>
                @enderror
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div>

    </form>
@endsection
