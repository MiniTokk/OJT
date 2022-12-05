@extends('posts.layout')
@section('title')
CATEGORY LIST
@endsection
@section('content')
        <h2 class="text-center">Categories Lists</h2>
        <b-row>
            <b-col class="ml-3">
                <input type="text">
            </b-col>
            <b-col>
                <button type="submit" class="btn btn-primary ml-5">
                    <a class="text-white"> Search</a>
                </button>
            </b-col>
            <b-col>
                <button type="submit" class="btn btn-primary ml-5">
                    <a class="text-white" href="{{ route('categories.create') }}"> Add</a>
                </button>
            </b-col>
            <b-col>
                <button type="submit" class="btn btn-primary ml-5">
                    <a class="text-white"> UpLoad</a>
                </button>
            </b-col>
            <b-col>
                <button type="submit" class="btn btn-primary ml-5">
                    <a class="text-white"> Download</a>
                </button>
            </b-col>
        </b-row>
        <div class="panel panel-default mt-5">
            <div class="panel-body">
                <table class="table-latitude">
                    <thead>
                        <th>Category ID </th>
                        <th>Category Name</th>
                        <th>Created Date</th>
                        <th></th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td> <a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></td>
                                <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                <td><a class="btn btn-primary" href="{{ route('categories.edit', $category->id) }}">Edit</a></td>
                                <td>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
                {!! $categories->links() !!}
            </div>
        </div>
@endsection