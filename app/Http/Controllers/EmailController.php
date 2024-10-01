<?php

namespace App\Http\Controllers;

use App\Jobs\ProductMailJob;
use App\Models\Book;
use App\Mail\Product;
use App\Models\User;
use Illuminate\Support\Facades\Mail;


use Illuminate\Http\Request;

class EmailController extends Controller
{
    public function products($id){
        $product = Book::findOrFail($id);

        $emails = User::pluck('email')->toArray();

        foreach($emails as $email){
            // queue
            ProductMailJob::dispatch($email, $product);
            // queue
        }
        

        return redirect()->back();
    }
    
    // bir sayının asal olup olmadığını hesaplayan bir fonksiyon yaz php dilinde
}
