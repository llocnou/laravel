<?php

namespace App\Http\Controllers;

// use App\Models\Inode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private function recupera($users_id, $anidamiento=0, $parent=0) {
        $resultado = '';
        $inodes = DB::table('inodes')->where([['users_id', $users_id], ['inodes_id', $parent]])->get();
        if (sizeof($inodes)>0) {
            $anidamiento++;
            $resultado.= "\n".str_repeat("\t",$anidamiento)."<ul>";
            foreach($inodes as $inode) {
                $type = 'dir';
                if ( DB::table('files')->where('inodes_id', $inode->id)->exists() ) {$type = 'file';}
                // 🗁 🗋
                if ( DB::table('files')->where('inodes_id', $inode->id)->exists() ) $icon = '🗋'; else $icon='🗁';
                // echo str_repeat("--",$anidamiento)."[$type] $inode->name<br/>";
                $resultado.= "\n".str_repeat("\t",$anidamiento+1)."<li class='$type'>";
                $resultado.= "<a href='".route('dashboard.show',$inode->id)."'>$icon $inode->name</a></li>";
                $resultado.= $this->recupera($users_id,$anidamiento, $inode->id);
            }
            $resultado.="\n".str_repeat("\t",$anidamiento)."</ul>";
        }
        return $resultado;
    }


    public function index()
    {
        // Recupera los inodos de la raíz del usuario.
        $inodes = $this->recupera(Auth::id());

        return view('dashboard',compact('inodes'));
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
                // Recupera los inodos de la raíz del usuario.
                $inodes = $this->recupera(Auth::id());
        return view('dashboard',compact('inodes'));
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
