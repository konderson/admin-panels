@extends('admin_layout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Главная </a> <a href="#">Товары</a> <a href="#" class="current">Просмотреть товары</a> </div>

            <h1>Товары </h1>

        </div>
        @if(Session::has('flash_message_error'))
            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_error')!!}</strong>
            </div>

        @endif
        @if(Session::has('flash_message_success'))
            <div class="alert alert-success alert-block">

                <button type="button" class="close" data-dismiss="alert">x</button>
                <strong>{!! session('flash_message_success')!!}</strong>
            </div>

        @endif
        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Список категорий</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID </th>
                                    <th>Наименование </th>
                                    <th>Описание</th>
                                    <th width="20px">ID категории</th>
                                    <th>Код товара</th>
                                    <th>Цена</th>
                                    <th>Цвет </th>
                                    <th>Аватар </th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr class="gradeX">
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->product_name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->category_name}}</td>
                                        <td>{{$product->product_code}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->product_color}}</td>
                                        <td>

                                            <img width="30px" height="30px" src="/img/products/large/{{$product->img}}">
                                        </td>
                                        <td class="center"><a href="{{url('/admin/edit-product/'.$product->id)}}" class="btn btn-primary btn-mini">Изменить</a>  <a rel="{{$product->id}}" rel1="delete_product" href="javascript" class="btn btn-danger btn-mini deleteRecord delete_product">Удалить</a>
                                            <a href="{{url('/admin/add-attributes/'.$product->id)}}" class="btn btn-success btn-mini">Добавить </a>
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
    </div>
@endsection