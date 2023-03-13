@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card-header">{{ __('Auther Details') }}</div>
                    </div>
                    <div class="col-sm-6">
                        
                        <a class="btn btn-info float-right"
                        href="{{ route('home') }}">
                            Back
                        </a>
                    </div>
                </div>
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    
                @endif
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   
                    <div class="row">
                        <div class="col-sm-12">
                            <label for="if">ID :</label>
                            <p>{{ $author['id'] }}</p>
                        </div>

                        <!-- Name Field -->
                        <div class="col-sm-12">
                            <label for="first_name">First Name :</label>
                            <p>{{ $author['first_name'] }}</p>
                        </div>

                        <!-- Created At Field -->
                        <div class="col-sm-12">
                            <label for="last_name">Last Name :</label>
                            <p>{{ $author['last_name'] }}</p>
                        </div>

                        <!-- Updated At Field -->
                        <div class="col-sm-12">
                            <label for="last_name">Gender :</label>
                            <p>{{ $author['gender'] }}</p>
                        </div>
                        <div class="col-sm-12">
                            <label for="last_name">Books :</label>
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Number of Pages</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($author['books'] as $book)
                                    <tr>
                                        <th scope="row">{{ $book['id'] }}</th>
                                        <td>{{ $book['title'] }}</td>
                                        <td>{{ $book['description'] }}</td>
                                        <td>{{ $book['number_of_pages'] }}</td>
                                        <td>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('deleteBook',$book['id']) }}" type="button" class="btn btn-danger"> Delete </a>
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
    </div>
</div>


    


@endsection