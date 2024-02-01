@extends ('app.base')
@section('title', 'Edit Movie')

@section ('content')

<div class="table-responsive small">
    <div class="table table-striped table-sm mt-4">
        <form action="{{ url('movie/' . $movie->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="container">
                <div class="row">
                    <div class="col-sm">
                        <label for="title">Título:</label>
                        <input type="text" name="title" value="{{old('title', $movie->title)}}">
                    </div>
                    <div class="col-sm">
                        <label for="director">Director:</label>
                        <input type="text" name="director" value="{{old('title', $movie->director)}}">
                    </div>
                    <div class="col-sm">
                        <label for="year">Año:</label>
                        <input type="text" name="year" value="{{old('title', $movie->year)}}">
                    </div>
                    <div class="col-sm">
                        <label for="genre">Género:</label>
                        <input type="text" name="genre" value="{{old('title', $movie->genre)}}">        
                    </div>
                    <div class="d-flex">
                        <div class ="mt-5 mx-auto">
                            <a href="../" class="btn-danger btn mx-3">Go Back</a>
                            <button class="btn-primary btn" type="submit">Save Changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> 
</div>     
@endsection