@extends('layouts.app')


@section('title')
    إضافة فاتورة جديدة 
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>إضافة فاتورة جديدة </h2>
                    </div>
                </div>
                <div class="d-flex justify-content-between align-items-end flex-wrap">
                    {{--  <button class="btn btn-success mt-2 ml-2 mt-xl-0">إضافة جديد </button>  --}}
                    {{--  <button class="btn btn-primary mt-2 mt-xl-0">Generate report</button>  --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
            <div class="card-body">
                {{--  @error('email')  --}}
                    
                {{--  @enderror  --}}
                <form class="forms-sample" action="{{ route('sales_bill.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center" >
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    @if(Session::has('success'))
                        <div class="alert alert-success text-center" >
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">رقم الفاتورة</label>
                    <input type="text" class="form-control" value="{{ \App\sales_bill::max('id')+1 }}" id="name" name="name" readonly reqiured>
                </div>
                <div class="form-group">
                    <label for="name">موظف البيع</label>
                    <input type="text" class="form-control" value="{{ auth()->user()->name }}" id="name" name="name" readonly reqiured>
                </div>
                <div class="form-group">
                    <label for="name">تاريخ الفاتورة</label>
                    <input type="text" class="form-control" value="{{ date('Y-m-d h:m:i') }}" id="name" name="name" readonly reqiured>
                </div>
                <?php $total = 0; ?>
                @foreach (\App\SaleDetail::where("sales_bill_id",\App\sales_bill::max('id')+1)->get() as $sales_bill)
                    <?php $total += $sales_bill->price * $sales_bill->qte; ?>
                @endforeach
                <div class="form-group">
                    <label for="total_amount">إجمالي الفاتورة</label>
                    <input type="text" class="form-control" value="{{ $total }}" id="total_amount" name="total_amount" readonly reqiured>
                </div>
                <hr>
                   <div class="card">
                        <h3 class="card-title p-4 m-0"><a href="{{ route('sales_detail.create') }}" style="float: left;" class="btn btn-success pull-rigth">إضافة منتج</a>  تفاصيل الفاتورة</h3>
                        <div class="card-body">
                          <div class="table-responsive">
                              <table class="table table-striped table-hover table-bordered">
                                  <thead>
                                      <tr>
                                          <th>#</th>
                                          <th>إسم المنتج</th>
                                          <th> إسم الصنف</th>
                                          <th>الكمية</th>
                                          <th>السعر</th>
                                          <th>المبلغ الاجمالي</th>
                                          <th>العمليات</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                        <?php $i = 1; ?>
                                        @foreach (\App\SaleDetail::where("sales_bill_id",\App\sales_bill::max('id')+1)->get() as $sales_bill)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $sales_bill->product->name }}</td>
                                                <td>{{ $sales_bill->product->category->name }}</td>
                                                <td>{{ $sales_bill->qte }}</td>
                                                <td>{{ $sales_bill->price }}</td>
                                                <td>{{ $sales_bill->price * $sales_bill->qte  }}</td>
                                                <td>
                                                    <div class="btn-group" role="group" dir="ltr" aria-label="Basic example">
                                                        <a href="{{ route('sales_detail.delete',$sales_bill->id) }}" title="حذف" class="btn btn-danger delete"><i class="mdi mdi-delete-forever" ></i></a>
                                                        <a href="{{ route('sales_detail.edit', $sales_bill->id) }}" title="تعديل" class="btn btn-success"><i class="mdi mdi-lead-pencil" ></i></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                  </tbody>
                              
                              </table>
                          </div>
                        </div>
                    </div>

                <hr>
                <div class="form-group text-center" >
                    <hr>
                    <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    <a href="{{ route('user.index') }}" class="btn btn-defualt">إلغاء</a>
                </div>
                
                </form>
            </div>
            </div>
        </div>
    </div>
@stop
