@extends ('app.base')
@section('title', 'Argo Create Disk')

@section ('content')
<div class="table-responsive small">
    <div class="table table-striped table-sm mt-4">
        <form action="{{ url('disk') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container">
                <div class="row">
                    <div class="col-sm mb-1">
                        <label for="title">Disk Title</label>
                        <input type="text" class="form-control" name="title" id="title" required value="{{old('title')}}">
                    </div>
                    <div class="col-sm mb-1">
                        <label for="idartist">Disk Artist</label>

                    <input type="hidden" name="idartist" value="{{ $idartist }}">
                    <h1>{{$artist->name}}</h1>
                    </div>
                    <div class="col-sm mb-1">
                        <label for="year">Disk Year</label>
                        <input type="text" class="form-control" name="year" value="" id="year" value="{{old('year')}}">
                    </div>
                    <div class="mb-3">
                        <label for="file" class="form-label">Cover</label>
                        <input type="file" class="form-control" id="file" name="file" value="{{old('cover')}}">
                    </div>
                    <div class="d-flex">
                        <div class ="mt-5 mx-auto mb-1">
                            <a href="{{ url('artist')}}" class="btn-danger btn mx-3">Cancel</a>
                            <button class="btn-primary btn" type="submit">Create</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div> 
</div>     


@endsection