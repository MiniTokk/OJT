<?php

namespace App\Imports;

use App\Models\Post;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class PostsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Post([
            'title'=>$row[0],
            'description'=>$row[1],
            'status'=>$row[2],
            'category'=>$row[3],
        ]);
    }
}
