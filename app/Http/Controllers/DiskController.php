<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Disk;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class DiskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $disks = Disk::all();
        return view('disk.index',['disks'=> $disks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {   
        return $this->createArtist($request, $request->idartist);
    }
    
    function createArtist(Request $request, $idartist){
        
        if($idartist == null ){
            return back();
        }
        $artist = Artist::find($idartist);
        if ($artist == null){
            return back();
        }
        
        $artists = Artist::pluck('name','id');
        return view('disk.create', ['artist' =>$artist,
                                    'artists'=>$artists, 
                                    'idartist' => $idartist]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $disk = new Disk($request->all()); //Disk::create($request->all());
            if($request->hasFile('file') && $request->file('file')->isValid()) {
             $archivo = $request->file('file');
             //crea el directorio
             $path = $archivo->storeAs('public/images', $archivo->getClientOriginalName()); //guardamos archivo en la carpeta public con el nombre original que el usuario lo guardo
             //la linea de storeAs puede ocasionar conflictos con la base de datos, revisar.
             $mime = $archivo->getMimeType(); //hay que comprobar siempre.
             //insertar condición. Comprobar los tipos permitidos de una array.
             $path = $archivo->getRealPath();
             //Image::make($path)->resize();
             $image = Image::make($path)->resize(245,245, function($constraint){
                 $constraint->aspectRatio();
             });
             $canvas = Image::canvas(245,245);
             $canvas->insert($image,'center');
             //$image->save('temporal');// va a public
             $canvas->save($path);
             $imagen = file_get_contents($path);
             $disk->cover = base64_encode($imagen);
            }
            $result = $disk->save();
            return redirect('disk')->with(['message'=>'The disk has been created']); 
            //Este puede ir aqui, tenerlo
            //en cuenta por si falla al crear , la vuelta de ruta.

        } catch(\Exception $e) {

        //4º si no lo he guardado, volver a la pag anterior con los datos para volver a rellenar el formulario
            return back()->withInput()->withErrors(['message' => 'The Disk has not been saved.']);
        }

    }
    
    function view() {
        
        return response()->file(storage_path('app'). '/public/images/kayak-2.jpg');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Disk $disk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Disk $disk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Disk $disk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Disk $disk)
    {
        //
    }
}
