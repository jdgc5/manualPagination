@extends('app.base')

@section('title', 'Argo Movie List')

@section('content')

@include('modal.deletemovie')

<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Director</th>
          <th scope="col">Year</th>
          <th scope="col">Genre</th>
          <th></th>
        </tr>
      </thead>
@foreach($movies as $movie)
  <div class="card mx-auto mb-3" style="max-width: 18rem;">
    <img src="{{ asset('ruta_a_la_imagen.jpg') }}" class="card-img-top" alt="Nombre del artículo">
    <div class="card-body text-center">
      <h5 class="card-title mb-3">{{ $movie->title }}</h5>
      <div class="d-flex justify-content-around">
        <a class="btn btn-primary" href="{{ url('movie/' . $movie->id) }}">Show</a>
        <a class="btn btn-danger" href="{{ url('movie/' . $movie->id . '/edit') }}">Edit</a>
        <form data-movie="{{ $movie->title }}" class="formDelete" action="{{ url('movie/' . $movie->id) }}" method="post">
          @csrf
          @method('delete')
          <button type="submit" class="btn btn-warning">Delete</button>
        </form>
      </div>
    </div>
  </div>
@endforeach
    </table>
    <a class="btn-info btn" href="{{ url('movie/create') }}">link to create</a>
    <form id="formDeleteV2" action="{{ url('movie/16') }}" method="post">
      @csrf
      @method('delete')
    </form>
</div>

<script>
  //solucion 1
  const forms = document.querySelectorAll(".formDelete");
  forms.forEach(function(form) {
      form.onsubmit = (event) => {
        return confirm('Seguro que quieres borrar ' + event.target.dataset.movie + '?');
      };
  });
  //solucion 2
  const ahrefs = document.querySelectorAll(".hrefDelete");
  const formDelete = document.getElementById('formDeleteV2');
  ahrefs.forEach(function(ahref) {
      ahref.onclick = (event) => {
        event.preventDefault();
        if(confirm('¿Seguro?')) {
          let url = event.target.dataset.url;
          formDelete.action = url;
          formDelete.submit();
        }
        //return confirm('Seguro que quieres borrar ' + event.target.dataset.movie + '?');
      };
  });
  //solucion 3
  const deleteMovieModal = document.getElementById('deleteMovieModal');
  const movieTitle = document.getElementById('movieTitle');
  const formDeleteV3 = document.getElementById('formDeleteV3');
  deleteMovieModal.addEventListener('show.bs.modal', event => {
      movieTitle.innerHTML = event.relatedTarget.dataset.title;
      formDeleteV3.action = event.relatedTarget.dataset.url;
  });
</script>
@endsection


