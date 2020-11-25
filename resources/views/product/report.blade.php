@extends('layouts.print')


@section('title')
    تقرير عن المنتجات
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap" style="margin: auto;">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>تقرير عن المنتجات</h2>
                    </div>
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
