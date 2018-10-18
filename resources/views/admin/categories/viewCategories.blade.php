@extends('admin_layout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="/admin/dashboard" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Главная </a> <a href="#">Категории</a> <a href="#" class="current">Просмотреть</a> </div>

            <h1>Категории </h1>

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
                                    <th>Имя категории</th>
                                    <th>Описание</th>
                                    <th width="20px">ID Подкатегории</th>
                                    <th>URL</th>
                                    <th>Действие</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                <tr class="gradeX">
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->description}}</td>
                                    <td>{{$category->parent_id}}</td>
                                    <td>{{$category->url}}</td><!--('/admin/delete-category/'.$category->id)-->
                                    <td class="center"><a href="{{url('/admin/edit-category/'.$category->id)}}" class="btn btn-primary btn-mini">Изменить</a>  <a  rel="{{$category->id}}" id="deleteCat" href="#" class="btn btn-danger delete_Category  btn-mini">Удалить</a></td>
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