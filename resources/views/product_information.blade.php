@extends('layouts.template')

@push ('css')
 <link rel="stylesheet" href="{{ asset('\css\product_list.css') }}" >
@endpush
  

  @section('title', '商品情報詳細画面')

@section('content')
  <h1>商品情報詳細画面</h1>

  <div class = "info">
    <table>
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}.</td>
        </tr>
        <tr>
            <th>商品画像</th>
            <td><img src="{{ asset('storage/'. $product->img_path) }}" class = "img" alt="商品画像"></td>
        </tr>
        <tr>
            <th>商品名</th>
            <td>{{ $product->product_name }}</td>
        </tr>
        <tr>
            <th>メーカー</th>
            <td>
                @foreach ($companies as $company)
                  @if($company->id==$product->company_id) {{ $company->company_name }} @endif
                @endforeach
            </td>
        </tr>
        <tr>
            <th>価格</th>
            <td>{{ $product->price }} 円</td>
        </tr>
        <tr>
            <th>在庫数</th>
            <td>{{ $product->stock }}</td>
        </tr>
        <tr>
            <th>コメント</th>
            <td>{{ $product->comment }}</td>
        </tr>
    </table>
  </div>

  <div class="button-container">
    <a href = "{{route('product.edit',$product->id)}}"><button id = "mainbtn">編集</button></a>
    <a href="{{ route('product.list') }}"><button id="backbutton" >戻る</button></a>
  </div>

  
@endsection
