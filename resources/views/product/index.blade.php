@extends('layouts.app')


@section('title')
    المنتجات
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>المنتجات</h2>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                <a href="{{ route('product.create') }}" class="btn btn-success mt-2 ml-2 mt-xl-0">إضافة جديد </a>
                <a href="{{ route('product.report') }}"  target="_blank" class="btn btn-defualt mt-2 ml-2 mt-xl-0"> تقرير المنتجات </a>
                    {{--  <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>  --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>إسم المنتج</th>
                                <th>إسم الصنف</th>
                                <th>الكمية</th>
                                <th>السعر</th>
                                <th>تاريخ الاضافة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->qte }}</td>
                                    <td>{{ $product->price }}</td>
                                    <td dir="ltr" >{{ $product->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" dir="ltr" aria-label="Basic example">
                                            <a href="{{ route('product.delete',$product->id) }}" title="حذف" class="btn btn-danger delete"><i class="mdi mdi-delete-forever" ></i></a>
                                            <a href="{{ route('product.edit', $product->id) }}" title="تعديل" class="btn btn-success"><i class="mdi mdi-lead-pencil" ></i></a>
                                        </div>
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
@stop
