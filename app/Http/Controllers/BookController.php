<?php

namespace App\Http\Controllers;

use App\Exports\BookExport;
use App\Http\Requests\BookStoreRequest;
use App\Imports\BookImport;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Facades\Excel;

class BookController extends Controller
{
    public function index(){
        $user = auth()->user();
        $books =  $user->books()->withTrashed()->get();
        return view('books.index', compact('books'));
    }

    public function create(){
        return view('books.create');
    }

    public function store(BookStoreRequest $request){
        $book = new Book();
        $book->name = $request->name;
        $book->price = $request->price;
        $book->user_id = auth()->id();
        $book->save();

        Cache::delete('books');

        return redirect()->back();
    }

    public function edit(Book $book){
        $user = auth()->user();
      
        abort_if($book->user_id != $user->id, 403);
        
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book){
        $user = auth()->user();
        abort_unless($user->books()->pluck('id')->contains($book->id), 404);

        $book->name = $request->name;
        $book->price = $request->price;
        $book->save();
        Cache::delete('books');

        return redirect()->back();
    }

    public function delete(Book $book){
        $book->delete();
        Cache::delete('books');
        return redirect()->back();
    }

    public function restore(Book $book) {
        $book->restore();
        Cache::delete('books');
        return redirect()->back();
    }

    public function export() 
    {
        return Excel::download(new BookExport, 'kitaplar.xlsx');
    }

    public function import(Request $request) 
    {
        //dd($request->file('file'));
        Excel::import(new BookImport, $request->file('file'));
        
        return redirect()->back()->with('success', 'Başarıyla içeri aktarıldı.');
    }

}
