@extends('posts.layout')
@section('title')
    CATEGORY DETAIL
@endsection
@section('content')
    <h2>Category Detail</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table-latitude">
                <thead>
                    <th>Category Name</th>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->created_at->format('d/m/Y') }}</td>

                    </tr>
            </table>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('categories.index') }}"> Back</a>
            </div>
@endsection