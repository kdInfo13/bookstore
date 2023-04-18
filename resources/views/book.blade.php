@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Book List') }}</div>
                <div class="card-body">
                    <div class="row justify-content-center">
                    @if(count($books) > 0)
                        @foreach($books as $book)
                            <div class="col-md-5 border p-4 m-1">
                               <strong>Book title:</strong>  {{$book->title}}<br>
                               <strong>Book Description:</strong>  {{$book->description}}<br>
                               <strong>Category:</strong>  {{$book->categorie->name}}<br>
                               @if($book->authors)
                                <strong>Author:</strong>
                                    @foreach($book->authors as $author)
                                        <span class="badge text-dark">{{$author->name}}</span>
                                    @endforeach
                               @endif

                               <a href="{{ route('single-book', $book->id) }}">View</a>
                            </div>
                        @endforeach
                    @else
                    <h3>No data found</h3>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
