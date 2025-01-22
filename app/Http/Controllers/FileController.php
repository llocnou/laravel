<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class FileController extends DashboardController
{
    //
    public function storeInode($users_id, $parent_id, $name){
        if (($parent_id == 0) || (DB::table('inodes')->where([['id', $parent_id],['users_id', $users_id]])->exists())) {
            return (DB::table('inodes')->insertGetId([
                'users_id' => $users_id,
                'name' => $name,
                'parent_id' => $parent_id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()]));
        }

    }

    public function storeFile($inodes_id, $filename, $size, $type){
        return (DB::table('files')->insertGetId([
            'inodes_id' => $inodes_id,
            'filename' => $filename,
            'size' => $size,
            'type' => $type
        ]));
    }


    //
    public function draw(String $parent_id){

        // Carpetas y archivos del usuario
        $dirs = $this->dirs(Auth::id());
        $files = $this->myFiles(Auth::id());

        return view('mydrive.create_file')
            ->with('parent_id', $parent_id)
            ->with('breadcrumb', $this->breadcrumb($parent_id));
    }

    public function upload(Request $request, String $parent_id){
        // $request->validate()...
        $file = $request->file('file');

        $filename = $file->store('files/' . Auth::id(), 'local');

        $inode_id = $this->storeInode(Auth::id(), $parent_id, $file->getClientOriginalName());
        $files_id = $this->storeFile($inode_id, $filename, $file->getSize(), $file->getMimeType());

        return to_route('dashboard.show', $inode_id);

    }

    public function download(String $files_id){
        $file = DB::table('files')->find($files_id);
        $inode = DB::table('inodes')->find($file->inodes_id);
        $headers = [
            'Content-Description' => 'File Transfer',
            'Content-Type' => $file->type,
            'Content-Length' => $file->size
        ];
        return Storage::download($file->filename, $inode->name, $headers);
    }

    public function delete(String $files_id){
        // Buscar el file
        $file = DB::table('files')->find($files_id);

        // Buscar el nodo
        $inode = DB::table('inodes')->find($file->inodes_id);

        // Comprobar permisos
        if ($inode->users_id == Auth::id()) {
            // Eliminar el fichero
            Storage::delete($file->filename);
            // Eliminar la entrada en files
            if ( DB::table('files')->where('id', $file->id)->delete() == 1 ) {
                // Eliminar el inodo
                $this->destroy($inode->id);
            }
        }
        return to_route('dashboard');
    }
}
