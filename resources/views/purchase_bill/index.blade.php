@extends('layouts.app')


@section('title')
    فاتورة المشتريات
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>    فاتورة المشتريات</h2>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <a href="{{ route('purchase.create') }}" class="btn btn-success mt-2 ml-2 mt-xl-0">إضافة جديد </a>
                    <a href="{{ route('purchase.report') }}"  target="_blank" class="btn btn-defualt mt-2 ml-2 mt-xl-0"> تقرير المبيعات </a>
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
                                <th>رقم الفاتورة</th>
                                <th>موظف البيع</th>
                                <th> المورد</th>
                                <th> إجمالي الفاتورة</th>
                                <th>تاريخ الاضافة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($purchase_bills as $purchase_bill)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $purchase_bill->id }}</td>
                                    <td>{{ $purchase_bill->user->name }}</td>
                                    <td>{{ $purchase_bill->vendor->name }}</td>
                                    <td>{{ $purchase_bill->total_amount }}</td>
                                    <td dir="ltr" >{{ $purchase_bill->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" dir="ltr" aria-label="Basic example">
                                            <a href="{{ route('purchase.delete',$purchase_bill->id) }}" title="حذف" class="btn btn-danger delete"><i class="mdi mdi-delete-forever" ></i></a>
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
