@extends('admin_layout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Главная </a> <a href="#">Товары</a> <a href="#" class="current">Добавить товар</a> </div>
            <h1>Добавить товар</h1>
        </div>
        @if(Session::has('flash_message_error'))
            <div class="alert alert-error alert-block">

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
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Данные об товаре</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('/admin/edit-product/'.$product->id)}}" name="add_validate" id="add_product" novalidate="novalidate">
                                {{csrf_field()}}

                                <div class="control-group">
                                    <label class="control-label">Название товара</label>
                                    <div class="controls">
                                        <input type="text" name="product_name" id="product_name" value="{{$product->product_name}}">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Подкатегории </label>
                                    <div class="controls" >
                                        <select style="width: 220px"  name="category_id" id="category_id" >
                                            <option selected disabled value='{{$categories_current->name}}'>Текущая категория : {{$categories_current->name}}</option>
                                         @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label">Описание </label>
                                    <div class="controls">
                                        <textarea type="text" name="description" id="description" >{{$product->description}}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Текущая аватарка продукта</label>
                                    <div class="controls">
                                        <img width="50px" height="50px" src="/img/products/large/{{$product->img}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Загрузите аватарку продукта</label>
                                    <div class="controls">
                                        <input type="hidden" id="current_img" name="current_img" value="{{$product->img}}">
                                        <input type="file"  id="avatar_img" name="avatar_img"/>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Цена </label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" value="{{$product->price}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Цвет продукта </label>
                                    <div class="controls">
                                        <input type="text" name="color" id="color"value="{{$product->product_color}}">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Код продукта </label>
                                    <div class="controls">
                                        <input type="text" name="code" id="code"value="{{$product->product_code}}">
                                    </div>
                                </div>


                                <div class="form-actions">
                                    <input type="submit" value="Сохранить " class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection