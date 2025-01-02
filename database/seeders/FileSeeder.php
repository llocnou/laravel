<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = new File();
        $file->inodes_id = 3;
        $file->filename = "mi documento.pdf";
        $file->size = 1024;
        $file->type = "pdf";
        $file->save();

        $file = new File();
        $file->inodes_id = 4;
        $file->filename = "otro documento1.txt";
        $file->size = 1024;
        $file->type = "text";
        $file->save();

        $file = new File();
        $file->inodes_id = 5;
        $file->filename = "otro documento2.txt";
        $file->size = 1024;
        $file->type = "text";
        $file->save();

    }
}
