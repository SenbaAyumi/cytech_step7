@extends('layouts.template')

@section('title')
商品一覧画面
@endsection

@push ('css')
 <link rel="stylesheet" href="{{ asset('\css\product_list.css') }}" >
@endpush

@section('content')
  <h1>商品一覧画面</h1>
  <form action = "{{ route('product.list') }}"  method = "get" id= search>
    @csrf
    <input type = "search" name = "search" placeholder = "検索キーワード">
    <select name = "select">
       <option value='' disabled selected style='display:none;'>メーカー名</option>
       @foreach ($companies as $company)
       <option value="{{ $company->id }}" >{{ $company->company_name}}</otion>
      @endforeach
    </select>
    <input type = "submit" name = "submit" value = "検索">
  </form>

  <div class="links">
   <table>
    <thead>
        <th>ID</th>
        <th>商品画像</th>
        <th>商品名</th>
        <th>価格</th>
        <th>在庫数</th>
        <th>メーカー名</th>
        <th colspan="2"><a href="{{route('product.create')}}"><button id = "mainbtn">新規登録</button></a></th>
    </thead>
    <tbody>
    @foreach ($products as $product)
      <tr>
       <td> {{ $product->id }} .</td>
       <td> <img src="{{ asset('storage/'. $product->img_path) }}" class = "img" alt="商品画像"></td>
       <td> {{ $product->product_name }} </td>
       <td> {{ $product->price }} 円 </td>
       <td> {{ $product->stock }} </td>
       <td>     @foreach ($companies as $company)
                  @if($company->id==$product->company_id) {{ $company->company_name }} @endif
                @endforeach </td> 
       <td>
         <a href = "{{route('product.show',$product->id)}}"><button id = "infobtn">詳細</button></a>
       </td>
       <td>
         <form method="POST" action="{{ route('product.delete', $product->id) }}" >
          @csrf
          @method('DELETE')
         <button type="submit"  id = "delbtn" onclick='return confirm("削除しますか？");'>削除</button>
         </form>
       </td>
      </tr>
    @endforeach
    </tbody>
   </table>

   {{ $products->appends(request()->query())->links() }}

  </div>
@endsection