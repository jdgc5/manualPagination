<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\DB;

class PaginateArtistController extends Controller
{
    
private $bladeFolder = 'paginateartist';
    const RPP = 10;
    const ORDERBY = 'id';
    const ORDERTYPE ='asc';
    
    private function getBladeFolder(string $folder) {
        return $this->bladeFolder . '.' . $folder;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $rpp = self::getFromRequest($request,'rowsPerPage',self::RPP);
        $orderBy = self::getFromRequest($request,'orderBy',self::ORDERBY);
        $orderType = self::getFromRequest($request,'orderType',self::ORDERTYPE);
        $q = self::getFromRequest($request,'q',null);
        if ($q == null){
            $artists = Artist::where('id', '>', 2 )->orderBy($orderBy,$orderType)->orderBy('name','asc')->paginate($rpp);
        } else{
            $artists = Artist::where('name', 'like', '%' . $q . '%')
            ->orWhere('id', $q)
            ->orWhere('idoltro','like', '%'. $q . '%')
            ->orWhere('idargo','like','%'. $q. '%')
            ->orderBy($orderBy,$orderType)
            ->orderBy('name','asc')
            ->paginate($rpp);
        }
        
        return view($this->getBladeFolder('index'),
            [
                'artists' => $artists,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage(),
                'orderBy' => $orderBy,
                'orderType' => $orderType,
                'q' => $q
            ]);
    }
    
    private static function getFromRequest($request, $name, $defaultValue){
        
        $value = $defaultValue;
        if($request->$name!= null) {
            $value = $request->$name;
        }
        return $value;
    }
    
    private static function getRowsPerPage() {
        return [
            3 => 3,
            10 => 10,
            25 => 25,
            50 => 50
        ];
    }
    
    public function index2(Request $request) {
        
        //1º
        
        $rpp = self::RPP;
        if($request->rowsPerPage != null) {
            $rpp = $request->rowsPerPage;
        }
        
        //2º
        
        $page = 1;
        if($request->page !=null){
            $page = $request->page;
        }
        
        //3º
        $calculo = $rpp * ($page -1);
        $sql = "select * from artist limit $calculo, $rpp";
        $artists = DB::select($sql);
        $total = DB::table('artist')->count();
        $pages = ceil($total/$rpp);
        return view($this->getBladeFolder('index2'),
            [
                'artists' => $artists,
                'pages' => $pages,
                'rpp' => $rpp,
                'rpps' => self::getRowsPerPage(),
                'page' =>$page

            ]);
    }
    
    public function create() {

    }


    public function store(Request $request){
  
    }

    public function show(string $id){
   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
