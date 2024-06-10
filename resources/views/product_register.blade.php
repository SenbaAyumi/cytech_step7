@extends('layouts.template')

@push ('css')
 <link rel="stylesheet" href="{{ asset('\css\product_list.css') }}" >
@endpush


  @section('title', '商品情報登録画面')

@section('content')
  <h1>商品情報登録画面</h1>


  <div class = "register">
    <form method="POST" action="{{ route('product.post') }}" enctype='multipart/form-data'>
      @csrf
    <table>
        <tr>
            <th class = "required">商品名</th>
            <td><input type = "text" name="product_name"  required></td>
        </tr>
        @error('product_name')
        <tr><th>error</th><td>入力してください</td></tr>
        @enderror
        <tr>
            <th class = "required">メーカー名</th>
            <td><select name = "company_id" required >
                        <option value='' disabled selected style='display:none;'>分類を選択してください</option>
                   @foreach ($companies as $company)
                        <option value="{{ $company->id }}">{{ $company->company_name}}</otion>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <th class = "required" >価格</th>
            <td><input type = "text" name = "price" required ></td>
        </tr>
        <tr>
            <th class = "required">在庫数</th>
            <td><input type = "text" name = "stock" required ></td>
        </tr>
        <tr>
            <th>コメント</th>
            <td><input type = "text" name = "comment" class = "form-control"></td>
        </tr>
        <tr>
            <th>商品画像</th>
            <td><input type = "file" name = "img_path" class = "form-control"></td>
        </tr>
    </table>
    @foreach($errors->all() as $message)
    <p class="error">{{$message}}</p>
    @endforeach
    <button type="submit" id = "mainbtn">新規登録</button>
 </form>
 <br>
  <a  href="{{ route('product.list') }}" ><button id="backbutton" >戻る</bottom></a>
 </div>   
@endsection