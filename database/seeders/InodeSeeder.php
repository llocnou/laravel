<?php

namespace Database\Seeders;

use App\Models\Inode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
        {
        //1
        $inode = new Inode();
        $inode->parent_id = 0; // root
        $inode->users_id = 1;
        $inode->name = "Mis Documentos";
        $inode->save();

        // Crea 10 directorios
        return Inode::factory()->count(10)->create();
    }
}
