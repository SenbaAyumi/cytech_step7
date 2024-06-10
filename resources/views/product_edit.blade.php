@extends('layouts.template')

@push ('css')
 <link rel="stylesheet" href="{{ asset('\css\product_list.css') }}" >
@endpush

  @section('title', '商品情報編集画面')

@section('content')
  <h1>商品情報編集画面</h1>

  <div class = "edit">
    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype='multipart/form-data'>
      @method('PUT')
      @csrf
    <table>
        <tr>
            <th>ID.</th>
            <td>{{ $product->id }}.</td>
        </tr>
        <tr>
            <th class = "required" >商品名</th>
            <td><input type = "text" name="product_name" value = "{{ $product->product_name }}" required> </td>
        </tr>
        <tr>
            <th class = "required">メーカー名</th>
            <td><select name = "company_id" >
                   <option>分類を選択してください</option>
                   @foreach ($companies as $company)
                        <option value = "{{ $company->id }}" @if ($company -> id == $product -> company_id) selected @endif> {{ $company->company_name}} </otion>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th class = "required"  >価格</th>
            <td><input type = "text" name = "price" value = "{{ $product -> price }} " ></td>
        </tr>
        <tr>
            <th class = "required" >在庫数</th>
            <td><input type = "text" name = "stock" value = "{{ $product -> stock }}"></td>
        </tr>
        <tr>
            <th>コメント</th>
            <td><input type = "text" name = "comment" class = "form-control" value = "{{ $product -> comment }}"></td>
        </tr>
        <tr>
            <th>商品画像</th>
            <td><input type = "file" name = "img_path" class = "form-control" >
                <img src="{{ asset('storage/'. $product->img_path) }}" class = "img" alt="商品画像">
            </td>
        </tr>
    </table>
    @foreach($errors->all() as $message)
    <p class="error">{{$message}}</p>
    @endforeach
    <button type="submit" id = "mainbtn">更新</button>
</form>
    <a  href="{{route('product.show',$product->id)}}"><button id="backbutton">戻る</button></a>
  </div> 
@endsection