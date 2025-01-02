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
    public function run(): void
    {
        //1
        $inode = new Inode();
        $inode->parent_id = 0; // root
        $inode->users_id = 1;
        $inode->name = "root";
        $inode->save();
        //2
        $inode = new Inode();
        $inode->parent_id = 1;
        $inode->users_id = 1;
        $inode->name = "carpeta";
        $inode->save();
        //3
        $inode = new Inode();
        $inode->parent_id = 1;
        $inode->users_id = 1;
        $inode->name = "file1";
        $inode->save();
        //4
        $inode = new Inode();
        $inode->parent_id = 2;
        $inode->users_id = 1;
        $inode->name = "file2";
        $inode->save();
        //5
        $inode = new Inode();
        $inode->parent_id = 0;
        $inode->users_id = 1;
        $inode->name = "file3.ext";
        $inode->save();
    }
}
