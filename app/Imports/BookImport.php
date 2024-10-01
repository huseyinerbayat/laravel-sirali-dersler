<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //dd(auth()->user()->id);
        return new Book([
            'name' => $row[0],
            'price' => $row[1],
            'user_id' => auth()->id(),
        ]);
    }
}
