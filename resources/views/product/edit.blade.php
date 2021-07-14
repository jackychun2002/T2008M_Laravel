@extends('layout')
@section("main")
    <div class="content-wrapper" style="min-height: 1302.4px;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Thêm Mới</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Simple Tables</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm Mới </h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{url("/categories/update",["id"=>$cat->id])}}" method="post">
                                @csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input name="name" value="{{$cat->name}}" type="text" class="form-control" placeholder="Tên Danh Mục">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-outline-primary">Submit</button>
                            </div>
                            </form>
                        </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </section>
    </div>
@endsection
