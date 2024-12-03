<?php

// app/Imports/CategoriesImport.php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithImages;

class CategoriesImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Category([
            'name' => $row['name'],
            'description' => $row['description'],
            'image' => $this->storeImage($row['image']),
        ]);
    }

    private function storeImage($image)
{
    if ($image) {
        $path = $image->store('categories', 'public'); // Simpan di public/storage/categories
        return $path;
    }
    return null;
}
}
