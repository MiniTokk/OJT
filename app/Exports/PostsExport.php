<?php

namespace App\Exports;

use App\Models\Post;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PostsExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;
    public function headings(): array
    {
        return [
            "Title", "Description", "Status", "category"
        ];
    }

    public function map($post): array
    {
        $categoryNames = $post->categories->pluck('name')->toArray();

        return [
            $post->title,
            $post->description,
            $post->status,
            implode('|', $categoryNames),

        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Post::all();
    }
}
