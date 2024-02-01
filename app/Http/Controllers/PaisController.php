<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use Illuminate\Support\Facades\DB;

class PaisController extends Controller
{
    function index() {
        //consultas en eloquent
        $paises = Pais::all();
        $paises2 = Pais::orderBy('name')->get();
        //$paises3NO = Pais::all()->sortBy('name'); // no recomendada. Ordena el resultado a posteriori
        $paises = Pais::where('name','>=','t')->orderBy('name','desc')->take(10)->get();
        $pais= Pais::where('name','>=','t')->orderBy('name','t')->first();
        dd($pais);
        dd($paises3);
        dd([$paises,$paises2]);
        
        // CONSULTAS DB 
        
        $paises0 = Pais::where('name','>=','t')->get();
        $paises1 = DB::select('select * from pais where name >= :name', ['name'=>'t']);
        foreach($paises0 as $pais){
            echo $pais->name . '<br>';
        }
        echo '<hr>';
        foreach($paises1 as $pais){
            echo $pais->name . '<br>';
        }
        
        $paises2 = DB::table('pais')->get();
        $pais = DB::table('pais')->find('AGO');
        DB::table('pais')->where('name', '>','t')->first();
        
        //Asi se preparan las sentencias cuando no usamos Eloquent
        
        $pdo = DB::connection()->getPdo(); // Objeto standard de PDO
        //sentencia preparada
        $sql = "select * from pais where id = :id";
        //preparo
        $sentencia = $pdo->prepare($sql);
        //asocio valores
        $sentencia = bindValue("id",$valor);
        //ejecuto sentencia
        $sentencia -> execute();
        //cursor, $sentencia
        foreach($sentencia as $fila){
            echo '<pre>' . var_export($fila,true) . '</pre>';
        }
        $sql = "select * from pais";
        $sentencia = $pdo->prepare($sql);
        $sentencia->execute();
        foreach($sentencia as $fila){
            $pais = new Pais($fila);
        }
    }
}
