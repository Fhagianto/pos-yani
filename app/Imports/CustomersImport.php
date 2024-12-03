<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Customer([
            'name'     => $row['full_name'], // Sesuaikan dengan nama kolom di Excel
            'no_telp'  => $row['no_telp'],
            'address'  => $row['address'],
        ]);
    }
}
