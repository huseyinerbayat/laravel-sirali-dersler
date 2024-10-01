@extends('layouts.app2')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-6 text-white"> {{ __('Sepet') }}</div>
                        <div class="col-6 d-flex justify-content-end text-white">
                            Sepette {{ShoppingCart::countRows()}} adet kitap var    
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kitabın İsmi</th>
                            <th scope="col">Adet</th>
                            <th scope="col">Fiyatı</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                            <tr>
                                <th scope="row">{{$loop->index+1}}</th>
                                <td>{{$book->name}}</td>
                                <td>
                                    <a href="{{route('shopping.updatecart', [$book->__raw_id, 'decrease'])}}" class="btn btn-danger">-</a>
                                    {{$book->qty}}
                                    <a href="{{route('shopping.updatecart', [$book->__raw_id, 'increase'])}}" class="btn btn-success">+</a>
                                </td>
                                <td>{{$book->price}}₺</td>
                                <td>
                                    
                                    <a href="{{route('shopping.removefromcart', $book->__raw_id)}}" class="btn btn-danger">Sepetten Çıkar</a>
                                </td>
                              </tr>
                            @endforeach
                              <tr>
                                  <td>Toplam</td>
                                  <td>{{ShoppingCart::totalPrice()}} ₺</td>
                                  <td></td>
                                  <td></td>
                                  
                              </tr>
                        </tbody>
                      </table>
                      <h2>Sipariş Bilgileri</h2>
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="">Ad</label>
                            <input type="text" class="form-control" name="name" placeholder="Ad" required>
                        </div>
                        <div class="form-group">
                            <label for="">Soyad</label>
                            <input type="text" class="form-control" name="surname" placeholder="Soyad" required>
                        </div>
                        <div class="form-group">
                            <label for="">Adres</label>
                            <input type="text" class="form-control" name="address" placeholder="Adres" required>
                        </div>
                        <div class="form-group">
                            <label for="">Mesaj</label>
                            <input type="text" class="form-control" name="message" placeholder="Mesaj" required>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Sipariş Ver</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection