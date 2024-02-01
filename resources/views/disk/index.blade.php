@extends('app.base')

@section('title', 'Argo Disk List')

@section('content')

<!--<img src="https://jgarcor257.ieszaidinvergeles.es/laraveles/argoApp/public/storage/images/kayak-2.jpg">-->
<!--<img src="{{url('disk/view/file/fotosubida.jpg')}}"> FORMA DE SUBIR ARCHIVOS SIN QUE SE VEA SU RUTA-->
<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">idArtist</th>
          <th scope="col">Year</th>
          <th scope="col">cover</th>
        </tr>
      </thead>
      <tbody>
        @foreach($disks as $disk)
      <tr>
          <td>{{ $disk->id }}</td>
          <td>{{ $disk->title }}</td>
          <td>{{ $disk->idartist }} {{ $disk->artist->name }}</td>
          <td>{{ $disk->year }}</td>
          <td>
            @if($disk->cover !=null)
              <img src="data:image/jpeg;base64,{{ $disk->cover }}">
            @endif
          </td>
      </tr>
      @endforeach

      </tbody>
    </table>
    <a class="btn-info btn" href="{{ url('disk/create') }}">Add(no sense anymore)</a>
</div>
@endsection
