@extends('layouts.app')


@section('title')
    فاتورة مبيعات
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>    فاتورة مبيعات</h2>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    <a href="{{ route('sales_bill.create') }}" class="btn btn-success mt-2 ml-2 mt-xl-0">إضافة جديد </a>
                    <a href="{{ route('sales_bill.report') }}"  target="_blank" class="btn btn-defualt mt-2 ml-2 mt-xl-0"> تقرير المبيعات </a>
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
                                <th> إجمالي الفاتورة</th>
                                <th>تاريخ الاضافة</th>
                                <th>العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            @foreach ($sales_bills as $sales_bill)
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $sales_bill->id }}</td>
                                    <td>{{ $sales_bill->user->name }}</td>
                                    <td>{{ $sales_bill->total_amount }}</td>
                                    <td dir="ltr" >{{ $sales_bill->created_at }}</td>
                                    <td>
                                        <div class="btn-group" role="group" dir="ltr" aria-label="Basic example">
                                            <a href="{{ route('sales_bill.delete',$sales_bill->id) }}" title="حذف" class="btn btn-danger delete"><i class="mdi mdi-delete-forever" ></i></a>
                                            {{--  <a href="{{ route('sales_bill.edit', $sales_bill->id) }}" title="تعديل" class="btn btn-success"><i class="mdi mdi-lead-pencil" ></i></a>  --}}
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
