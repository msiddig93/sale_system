@extends('layouts.print')


@section('title')
    تقرير عن المشتريات
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap" style="margin: auto;">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>تقرير عن المشتريات</h2>
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
                                <th>رقم الفاتورة</th>
                                <th>موظف البيع</th>
                                <th> المورد</th>
                                <th> إجمالي الفاتورة</th>
                                <th>تاريخ الاضافة</th>
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
