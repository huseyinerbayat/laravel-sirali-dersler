<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use ShoppingCart;

class ShoppingController extends Controller
{
    public function index(){ // sepet
        $books = ShoppingCart::all();
        //dd($books);
        $template = env('TEMPLATE');
        return view($template . '.cart', compact('books'));
    }

    public function addtocart($id){
        $book = Book::notDeleteds()->findOrFail($id);
        ShoppingCart::add($book->id, $book->name, 1, $book->price, []);

        return redirect()->back();
    }

    public function removefromcart($raw_id){
        ShoppingCart::remove($raw_id);

        return redirect()->back();
    }

    public function updatecart($raw_id, $type){
        $item = ShoppingCart::get($raw_id);
        
        if($type == 'increase')
            ShoppingCart::update($raw_id, $item->qty+1);
        else
            ShoppingCart::update($raw_id, $item->qty-1);

        return redirect()->back();
    }
}
