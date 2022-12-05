<?php

namespace App\Exports;

use App\Models\Post;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class PostsExport implements FromCollection,WithHeadings,WithMapping 
{
    use Exportable;
    public function headings(): array {
        return [
           "ID","Title","Description","Status","Category","Created At","Updated At"
        ];
      }
    /**
    * @return \Illuminate\Support\Collection
    */
    //public function collection()
    //{
    //    return Post::all();
    //    return Category::all();
    //}
    public function map($post): array
    {
        //$posts = array();
        //foreach ($row->posts as $post) {
        //    $posts[] = $post->title.' : '.$post->description;
        //}
         return[
             $post->id,
             $post->title,
             $post->description,
             $post->status,
            // $post->categories->name,
             $post->created_at->toDatestring(),
             $post->updated_at->toDatestring(),

         ];
    }
    public function collection()
    { 
        return Post::all();
    }
}
