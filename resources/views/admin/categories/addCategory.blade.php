@extends('admin_layout.admin_design')
@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>Главная </a> <a href="#">Категории</a> <a href="#" class="current">Добавить категорию</a> </div>
            <h1>Добавить категорию</h1>
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
        <div class="container-fluid"><hr>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Данные об категории</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{url('/admin/add-category')}}" name="add_validate" id="add_validate" novalidate="novalidate">
                              {{csrf_field()}}

                                <div class="control-group">
                                    <label class="control-label">Название категории</label>
                                    <div class="controls">
                                        <input type="text" name="category-name" id="name">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Описание </label>
                                    <div class="controls">
                                        <input type="text" name="description" id="description">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Родительская категория </label>
                                    <div class="controls">
                                        <select name="parent_id">
                                            <option value="0">Главная категория </option>
                                            @foreach($levels as $level)
                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">URL (Start with http://)</label>
                                    <div class="controls">
                                        <input type="text" name="url" id="url">
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
    </div>

    @endsection