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
        $inode = new Inode();
        $inode->inodes_id = 0; // root
        $inode->users_id = 1;
        $inode->name = "root";
        $inode->save();
        //
        $inode = new Inode();
        $inode->inodes_id = 1;
        $inode->users_id = 1;
        $inode->name = "carpeta";
        $inode->save();
        //
        $inode = new Inode();
        $inode->inodes_id = 1;
        $inode->users_id = 1;
        $inode->name = "file1";
        $inode->save();
        //
        $inode = new Inode();
        $inode->inodes_id = 2;
        $inode->users_id = 1;
        $inode->name = "file2";
        $inode->save();
    }
}
