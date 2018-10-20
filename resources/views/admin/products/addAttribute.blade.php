@extends('admin_layout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Главная </a> <a href="/admin/viewProducts">Товары</a> <a href="#" class="current">Добавить Атрибут</a> </div>
            <h4>Добавить дополнительную информацию</h4>
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
                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="{{url('/admin/add-attributes/'.$product->id)}}" name="add_validate" id="add_product" novalidate="novalidate">
                                {{csrf_field()}}

                                <div class="control-group">
                                    <label class="control-label">Название товара</label>
                                    <div class="controls">
                                        <p> {{$product->product_name}}  </p>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">Цена </label>
                                    <div class="controls">
                                        <p> {{$product->price}}  </p>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Код продукта</label>
                                    <div class="controls">
                                        <p> {{$product->product_code}}  </p>
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label"></label>
                                    <div class="controls">
                                          <input type="hidden" name="product_id" value="{{$product->id}}}">
                                    </div>
                                </div>

                                <div class="control-group">
                                    <label class="control-label">   Атрибуты товара </label>
                                    <div class="controls">
                                        <div class="field_wrapper">
                                            <div>
                                               <input type="text" name="sku[]" id="sku" placeholder="SKU" style="width: 120px" required/>



                                                <select  name="size[]" id="size" placeholder="SIZE" style="width: 120px" required>"SKU"
                                                    <option>Small</option>
                                                    <option>Medium</option>
                                                    <option>Large</option>
                                                </select>

                                                <input type="text" name="price[]" id="price" placeholder="PRICE"  style="width:120px;" required/>

                                                <input type="text" name="stock[]" id="stock" placeholder="STOCK"  style="width:120px;" required/>
                                                <a href="javascript:void(0);" class="add_button" title="Add field"><img width="25px" height="25px" src="/img/icons/add.png"></a>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-actions">
                                    <input type="submit" value="Добавить" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="container-fluid">
            <hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Список товара по атрибудам</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                <tr>
                                    <th>ID SKU</th>
                                    <th>SIZE</th>
                                    <th>PRICE</th>
                                    <th width="20px">STOCK</th>
                                    <th width="20px">Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product['attributes'] as $attribute)
                                    <tr class="gradeX">

                                        <td>{{$attribute->sku}}</td>
                                        <td>{{$attribute->size}}</td>
                                        <td>{{$attribute->price}}</td>
                                        <td>{{$attribute->stock}}</td><!--('/admin/delete-category/'.$category->id)-->
                                        <td class="center">  <a  rel="{{$attribute->id}}" id="deleteAttribute" href="#" class="btn btn-danger delete_Attribute  btn-mini">Удалить</a></td>
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