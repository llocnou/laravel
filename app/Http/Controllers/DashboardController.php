<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Recupera todos los archivos del usuario
    private function myFiles($users_id){
        // INNER JOIN
        return DB::table('inodes')
        ->where('inodes.users_id', $users_id)
        ->join('files', 'inodes.id', '=', 'files.inodes_id' )
        ->get();
    }

    // Recupera un archivo
    private function myFile($id){
        // INNER JOIN
        return DB::table('inodes')
            ->join('files', 'inodes.id', '=', 'files.inodes_id' )
            ->where('inodes.id', $id)
            ->first();
    }

    // Recupera todos los directorios del usuario
    private function dirs($users_id){
        $myfiles = DB::table('files')
        ->select('inodes_id')
        ->where('users_id', $users_id);

        $mydirs = DB::table('inodes')
        ->where('users_id', $users_id)
        ->whereNotIn('id', $myfiles)
        ->get();

        return $mydirs;
    }

    // Devuelve TRUE si es un archivo
    private function isFile($inode_id){
        return  DB::table('files')->where('inodes_id', $inode_id)->exists();
    }

    //
    // Devuelve un array con el breadcrumb
    //
    private function breadcrumb($id) {
        return array_reverse($this->bread($id));
    }
    //
    // Genera un array con el breadcrumb invertido.
    //
    private function bread($id) {
        $inode = DB::table('inodes')->find($id);
        $res[] = array("id" =>$id, "name" =>$inode->name);
            if ($inode->parent_id>0) {
                $res = array_merge($res, $this->bread($inode->parent_id));
            }
        return $res;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Carpetas y archivos del usuario
        $dirs = $this->dirs(Auth::id());
        $files = $this->myFiles(Auth::id());

        // Vista de estructura del directorio
        return view('mydrive.index')
        ->with('dirs', $dirs)
        ->with('files', $files);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

        // Breadcrumb
        $breadcrumb = $this->breadcrumb($id);

        if ($this->isFile($id)) {
            return view('mydrive.show_file')
            ->with('breadcrumb', $breadcrumb)
            ->with('file', $this->myFile($id));
        } else {
            $dir = DB::table('inodes')->find($id);
            return view('mydrive.show_dir')
            ->with('breadcrumb', $breadcrumb)
            ->with('dir', $dir);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Sólo el nombre del inodo !!!
        return ("Dashboard edit $id");

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
