@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
               
                <div class="row">
                    <div class="col-sm-6">
                    <div class="card-header">{{ __('Add Book') }}</div>
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
                    <form method="POST" action="{{ route('storeBook') }}">
                        @csrf
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Select Author</label>
                                    <select class="form-control" id="" name="select_author" required>
                                    @foreach($authors as $author)
                                        <option value="{{ $author['id']}}">{{ $author['first_name']}} {{ $author['last_name']}}</option>
                                    @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlInput1">Title</label>
                                    <input type="text" class="form-control" name="title" placeholder="Title" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlSelect2">Number of Pages</label>
                                    <input type="number" class="form-control" name="number_of_pages" placeholder="Number of pages" required>
                                </div>
                               
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Description</label>
                                    <textarea class="form-control" name="description" rows="3" required></textarea>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


    


@endsection