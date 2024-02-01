@extends('app.base')

@section('title', 'Argo Artist Paginate List')

@section('content')

<div>
  <form>
    <select name="rowsPerPage" id="">
      @foreach($rpps as $index => $value)
        <option value="{{$index}}" @if($rpp == $index) selected @endif>{{$index}}</option>
      @endforeach
    </select>
    <button type="submit">view</button>
  </form>
</div>
<div class="table-responsive small">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">name</th>
        </tr>
      </thead>
      <tbody>
        @foreach($artists as $artist)
            <tr>
                <td>{{ $artist->id }}</td>
                <td>
                  {{ $artist->name }}
                </td>
                <td>
                  <a class="btn btn-primary" href="{{ url('artist/' . $artist->id) }}">show</a>
                </td>
            </tr>
        @endforeach
      </tbody>
    </table>
</div>
<div>
  <nav>
    
<ul class="pagination">
    @if($pages > 2)
        <li class="page-item"><a class="page-link" href="{{ url('/paginateartist2?rowsPerPage=' . $rpp . '&page=1') }}">1</a></li>
    @endif
    <li class="page-item"><a class="page-link" href="{{ url('/paginateartist2?rowsPerPage=' . $rpp . '&page=2') }}">2</a></li>

    @php
        $startPage = $page - 2; //página actual
        $startPage = max(3, $startPage); // página de inicio sea al menos 3
    
        $endPage = $startPage + 4; // mostrar un total de 5 páginas
        $endPage = min($endPage, $pages); //no exceda el número total de páginas
    @endphp
        @if($startPage >2)
    <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
    @endif
    
    @for ($i = $startPage; $i <= $endPage; $i++)
      <li class="page-item <?php if($i == $page) { echo 'active'; } ?>">
          <?php if($i != $page) { ?>
              <a class="page-link" href="<?php echo url('/paginateartist2?rowsPerPage=' . $rpp . '&page=' . $i); ?>"><?php echo $i; ?></a>
          <?php } else { ?>
              <a class="page-link"><?php echo $i; ?></a> 
          <?php } ?>
      </li>
    @endfor
    
    @if($pages > 4 && $endPage < $pages)
        <li class="page-item disabled" aria-disabled="true"><span class="page-link">...</span></li>
        <li class="page-item"><a class="page-link" href="{{ url('/paginateartist2?rowsPerPage=' . $rpp . '&page=' . ($pages - 1)) }}">{{ $pages - 1 }}</a></li>
        <li class="page-item"><a class="page-link" href="{{ url('/paginateartist2?rowsPerPage=' . $rpp . '&page=' . $pages) }}">{{ $pages }}</a></li>
    @endif
</ul>


    
      
  </nav>
</div>
@endsection
