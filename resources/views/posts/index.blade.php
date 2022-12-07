<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.0.js"></script>
@extends('posts.layout')
@section('title')
    POST LIST
@endsection
@section('content')
    <div class="row mt-3">
        <div class="col-sm-6">
            <form method="POST" enctype="multipart/form-data" action="{{ route('import-post') }}">
                @csrf
                <label class="text-primary">Choose File To Upload!</label>
                <input type="file" name="file" class="form-control" />
                <div class="mt-3">
                    <input type="submit" class="btn btn-primary text-white" name="Upload" disabled />
                    <button type="submit" class="btn btn-primary float-right"><a class="text-white"
                            href="{{ route('export-post') }}">Download
                            CSV</a></button>
                </div>
            </form>
        </div>
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-info text-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="position-absolute top-30 start-50">
        <button type="submit" class="btn btn-primary ml-5">
            <a class="text-white" href="{{ route('posts.create') }}"> Add Post</a>
        </button>
    </div>
    <div class="container">
        <div class="panel panel-default mt-5">
            <div class="panel-body">
                <h2>Post Lists</h2>
                <table class="table-latitude">
                    <thead>
                        <th>Post Title </th>
                        <th>Post Description</th>
                        <th>Posted Use</th>
                        <th>Categories</th>
                        <th>Poseted Date</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td> <a href="{{ route('posts.show', $post->id) }}">{{ $post->title }}</a></td>
                                <td>{{ $post->description }}</td>
                                <td>{{ $post->status }}</td>
                                <td>
                                    @foreach ($post->categories as $category)
                                        {{ $category->name }}
                                        @if (!$loop->last)
                                            ,<br>
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>

                                <td><a class="btn btn-primary" href="{{ route('posts.edit', $post->id) }}">Edit</a></td>
                                <td>
                                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center mt-5">
                {!! $posts->links() !!}
            </div>
        </div>
    @endsection
    <script type="text/javascript">
        $(document).ready(
            function() {
                $('input:submit').attr('disabled', true);
                $('input:file').change(
                    function() {
                        if ($(this).val()) {
                            $('input:submit').removeAttr('disabled');
                        } else {
                            $('input:submit').attr('disabled', true);
                        }
                    });
            });
    </script>
    