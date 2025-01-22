<?php

namespace Database\Seeders;

use App\Models\File;
use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = new File();
        $file->inodes_id = 1;
        $file->filename = "mi documento.pdf";
        $file->size = 1024;
        $file->type = "pdf";
        $file->save();
    }
}
