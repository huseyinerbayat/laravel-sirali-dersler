@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-6 text-white"> {{ __('Kitaplar') }}</div>
                        <div class="col-6 d-flex justify-content-end"><a href="{{route('shopping.index')}}" class="btn btn-secondary">Sepet</a></div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kitabın İsmi</th>
                            <th scope="col">Fiyatı</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{$book->id}}</th>
                                <td>{{$book->name}}</td>
                                <td>{{$book->price}}₺</td>
                                <td>
                                    <a href="{{route('shopping.addtocart', $book->id)}}" class="btn btn-info">Sepete Ekle</a>
                                    <a href="{{route('users.books.show', $book->id)}}" class="btn btn-success">Ayrıntılar</a>
                                    <a href="{{route('emails.product', $book->id)}}" class="btn btn-primary">Mail Gönder</a>
                                </td>
                              </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection