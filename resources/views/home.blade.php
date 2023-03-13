@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="row">
                    <div class="col-sm-10">
                        <div class="card-header">{{ __('List of Authors') }}</div>
                    </div>
                    <div class="col-sm-2">
                        
                        <a class="btn btn-info float-right"
                        href="{{ route('addBook') }}">
                            Add Book
                        </a>
                    </div>
                </div>
                
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                        
                    @endif

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Last Name</th>
                                <th scope="col">Gender</th>
                                <th scope="col">Books</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($authors as $author)
                            @php
                            $response = Http::withToken(session()->get('token_key'))->get('https://symfony-skeleton.q-tests.com/api/v2/authors/'.$author['id']);
                            $author = json_decode($response->getBody(), true);
                            $books = count($author['books']);
                           
                            @endphp
                            <tr>
                                <th scope="row">{{ $author['id'] }}</th>
                                <td>{{ $author['first_name'] }}</td>
                                <td>{{ $author['last_name'] }}</td>
                                <td>{{ $author['gender'] }}</td>
                                <td>{{ $books }}</td>
                                <td>
                                   
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('showAuthor',$author['id'] )}}" type="button" class="btn btn-info"> View </a>
                                    @if($books < 1 )
                                        <a href="{{ route('deleteAuthor',$author['id']) }}" type="button" class="btn btn-danger"> Delete </a>
                                    @endif
                                </div>
                                   
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
