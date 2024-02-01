@extends ('app.base')
@section('title', 'Argo Create Movie')

@section ('content')
<div class="table-responsive small">
    <div class="table table-striped table-sm mt-4">
        <form action="{{ url('movie') }}" method="POST">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm mb-1">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" name="title" id="title" maxlength="60" required value="{{old('title')}}">
                    </div>
                    <div class="col-sm mb-1">
                        <label for="director">Director</label>
                        <input type="text" class="form-control" name="director" id="director" maxlength="110" required value="{{old('director')}}">
                    </div>
                    <div class="col-sm mb-1">
                        <label for="year">Year</label>
                        <input type="text" class="form-control" name="year" value="" id="year" required min="1901" max="2155" value="{{old('year')}}">
                    </div>
                    <div class="col-sm mb-1">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" name="genre" value="" maxlength="50" id="genre" value="{{old('genre')}}">        
                    </div>
                    <div class="d-flex">
                        <div class ="mt-5 mx-auto mb-1">
                            <a href="{{ url('movie')}}" class="btn-danger btn mx-3">Cancel</a>
                            <button class="btn-primary btn" type="submit">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> 
</div>     


@endsection