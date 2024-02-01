<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::all(); //eloquent
        //dd($movies); //var_dump()
        return view('movie.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('movie.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    
    public function store(Request $request){
        
        //1º generar el objeto para guardar
        $movie = new Movie($request->all());
        //2º intentar guardar
        try {
            $result = $movie->save();  
        //3º si lo he guardado volver a algún sitio
            $afterInsert = session('afterInsert','show movies');
            $target = 'movie.';
            if($afterInsert != 'show movies'){
                $target = 'movie/create';
            }
            return redirect()->route($target)->with('success', $movie->title .' has been created');
        } catch(\Exception $e) {
        //4º si no lo he guardado, volver a la pag anterior con los datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'The Movie has not been saved.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        return view('movie.show',['movie'=> $movie]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        return view('movie.edit',['movie'=> $movie]);
    }
        
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $request->validate([
        'title' => 'required|string|max:60|unique:movie,title,' . $movie->id,
        'director' => 'required|string|max:100',
        'year' => 'required|integer',
        'genre' => 'nullable|string|max:50',
    ]);
    
        try {
            $movie->fill($request->all());
            $result = $movie->save();
            $afterEdit = session('afterEdit','movie');
            $target = 'movie'; 
            if ($afterEdit == 'movie'){
                $target = 'movie';
            } else if ($afterEdit == 'edit'){
                $target = 'movie/' . $movie->id . '/edit';
            } else {
                $target = 'movie/' . $movie->id; 
            }
            return redirect($target)->with('success', $movie->title .' has been updated');
        } catch(\Exception $e) {
            \Log::error($e);
            return back()->withInput()->withErrors(['message' => 'The Movie has not been updated.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {

        try {
            $movie->delete();
            return redirect('movie')->with(['message' => 'The movie has been deleted.']);
        } catch(\Exception $e) {
             return back()->withErrors(['message' => 'The movie has not been deleted.']);
        }
    }
    
    function view(Request $request, $id){
        
        $movie=Movie::find($id);
        dd([$id,$movie]);
        if ($movie == null){
            return abort(404);
        }
        
    }
}
