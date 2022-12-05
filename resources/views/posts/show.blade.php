@extends('posts.layout')
@section('title')
POST DETAIL
@endsection
@section('content')
    <h2>Post Detail</h2>
    <div class="panel panel-default">
        <div class="panel-body">
            <table class="table-latitude">


                <thead>
                    <th>Post Title </th>
                    <th>Post Description</th>
                    <th>Posted Use</th>
                    <th>Poseted Date</th>
                </thead>
                <tbody>

                    <tr>
                        <td> {{ $post->title }}</td>
                        <td>{{ $post->description }}</td>
                        <td>{{ $post->status }}</td>
                        <td>{{ $post->created_at->format('d/m/Y') }}</td>

                    </tr>

            </table>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('posts.index') }}"> Back</a>
            </div>
        @endsection
