<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class DashboardController extends Controller
{
    // Recupera todos los archivos del usuario
    protected function myFiles($users_id)
    {
        // INNER JOIN
        return DB::table('inodes')
            ->where('inodes.users_id', $users_id)
            ->join('files', 'inodes.id', '=', 'files.inodes_id')
            ->get();
    }

    // Recupera un archivo
    protected function myFile($id)
    {
        // INNER JOIN
        return DB::table('inodes')
            ->join('files', 'inodes.id', '=', 'files.inodes_id')
            ->where('inodes.id', $id)
            ->first();
    }

    // Recupera todos los directorios del usuario
    protected function dirs($users_id)
    {
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
    protected function isFile($id)
    {
        return  DB::table('files')->where('inodes_id', $id)->exists();
    }

    // Devuelve TRUE si no tiene hijos
    protected function isEmpty($id){
        return DB::table('inodes')->where('parent_id', $id)->doesntExist();
    }

    //
    // Devuelve un array con el breadcrumb
    //
    protected function breadcrumb($id)
    {
        if ($id>0) {
            return array_reverse($this->bread($id));
        } else {
            return array();
        }
    }
    //
    // Genera un array con el breadcrumb invertido.
    //
    private function bread($id)
    {
        $inode = DB::table('inodes')->find($id);
        $res[] = array("id" => $id, "name" => $inode->name);
        if ($inode->parent_id > 0) {
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
     * Show the form for creating a new folder.
     */
    public function create(String $id="0")
    {
        //
        // ATENCIÓN
        //
        // Comprobar que el $id se corresponde con una carpeta válida
        // del usuario...
        //
        return view('mydrive.create_dir')
            ->with('breadcrumb', $this->breadcrumb($id))
            ->with('parent_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'parent_id' => 'required|numeric',
            'name' => 'required|string|min:3|max:60'
        ]);
        // regex::pattern

        $id = Auth::id();
        $name = $request->input('name');
        $parent_id = $request->input('parent_id');

        // Validar si el usuario es el propietario del directorio superior
        if (($parent_id == 0) || (DB::table('inodes')->where([['id', $parent_id],['users_id', $id]])->exists())) {
            // Es el propietario
            if (DB::table('inodes')->insert([
                'users_id' => $id,
                'name' => $name,
                'parent_id' => $parent_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ])) {
            // Mensaje de estado
                session()->flash('info', __('Folder')." $name ".__('created!'));
            } else {
                session()->flash('danger', __('Folder')." $name ".__('not created!'));
            }
        } else {
            // No es el propietario
            session()->flash('danger', "No autorizado.");
        }

        // Carpetas y archivos del usuario
        $dirs = $this->dirs(Auth::id());
        $files = $this->myFiles(Auth::id());

        // Vista de estructura del directorio
        return view('mydrive.index')
            ->with('dirs', $dirs)
            ->with('files', $files);
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
    public function edit($id)
    {
        // Sólo se puede editar el nombre del inodo !!!
        $inode = DB::table('inodes')->find($id);
        return view('mydrive.edit')
           // ->with('id', $id)
           ->with('inode', $inode);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required|string|min:1|max:60'
        ]);

        if ( DB::table('inodes')
                ->where([['id', $id],['users_id', Auth::id()]])
                ->update([
                    'name' => $request->name,
                    'updated_at' => Carbon::now()
                ]))
            {
                session()->flash('info', __('Updated!'));
            } else {
                session()->flash('danger', __('Not updated!'));
            }
            return to_route('dashboard.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // Comprobar que no tiene "hijos"
        if (!$this->isEmpty($id)) {
            session()->flash('danger', "No se puede eliminar porque contiene archivos o carpetas.");
            return to_route('dashboard.show', $id);
        } else {
            //
            if (DB::table('inodes')->where('id',$id)->where('users_id', Auth::id())->delete() == 1) {
                // ÉXITO
                session()->flash('info', " Eliminado!");
                return to_route('dashboard');
            } else {
                // FRACASO
                session()->flash('danger', "Error inesperado.");
                return to_route('dashboard.show', $id);
            }

        }
    }
}
