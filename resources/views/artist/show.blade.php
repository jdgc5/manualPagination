@extends ('app.base')
@section('title', 'Argo Artist')

@section ('content')
<div class="table-responsive small">
            <table class="table table-striped table-sm">
              
              <tbody>
                  <tr>
                      <td>#</td>
                      <td>{{ $artist-> id }}</td>
                  </tr>
                  <tr>
                      <td>Name</td>
                      <td>{{ $artist-> name }}</td>
                  </tr>
                  
                     @foreach ($artist->disks as $disk)
                    <tr>
                      <td>Disk</td>
                      <td>{{ $disk -> title }}</td>
                    </tr>
                     @endforeach
                    <tr>
                      <td>Add Disk</td>
                      <td>
                        <a class="btn btn-primary" href="{{url('disk/create?idartist=' . $artist->id) }}">Create Disk Sin Ruta Creada</a>
                      </td>
                    </tr>
                    <tr>
                      <td>Add Disk</td>
                      <td>
                        <a class="btn btn-primary" href="{{url('disk/create/' . $artist->id) }}">Create Disk Con Ruta Creada</a>
                      </td>  
                    </tr>
              </tbody>
            </table>
          </div> 
          <div><a href="./" class="btn-danger btn mx-3">Go Back</a></div>
@endsection