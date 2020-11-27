@extends('layouts.app')


@section('title')
    سداد قيمة الفاتورة عن طريق البنك   
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>سداد قيمة الفاتورة عن طريق البنك   </h2>
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
                <form class="forms-sample" action="{{ route('purchase.bank') }}" method="POST">
                @csrf
                <div class="form-group">
                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center" >
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>

            @if (Session::has('success'))

                <div class="form-group">
                    @if(Session::has('success'))
                        <div class="alert alert-success text-center" >
                            {{Session::get('success')}}
                        </div>
                    @endif
                </div>
            @else
                <div class="form-group">
                    <label for="name">رقم الفاتورة</label>
                    <input type="text" class="form-control" value="{{ $purchase->id }}" id="id" name="id" readonly reqiured>
                </div>
                <div class="form-group">
                    <label for="name">موظف البيع</label>
                    <input type="text" class="form-control" value="{{ $purchase->user->name }}" id="name" name="name" readonly reqiured>
                </div>
                 <div class="form-group">
                    <label for="name"> المورد</label>
                    <input type="text" class="form-control" value="{{ $purchase->vendor->name }}" id="name" name="name" readonly reqiured>
                </div>
                <div class="form-group">
                    <label for="name">تاريخ الفاتورة</label>
                    <input type="text" class="form-control" value="{{ $purchase->created_at }}" id="name" name="name" readonly reqiured>
                </div>
                <div class="form-group">
                    <label for="total_amount">إجمالي الفاتورة</label>
                    <input type="text" class="form-control" value="{{ $purchase->total_amount }}" id="total_amount" name="total_amount" readonly reqiured>
                </div>

                <div class="form-group">
                    <label for="acc_number">قم حساب المورد </label>
                <input type="text" class="form-control" value="{{ old('acc_number') }}" id="acc_number" name="acc_number"  reqiured>
                </div>
                
                <div class="form-group text-center" >
                    <hr>
                    <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    <a href="{{ route('purchase.index') }}" class="btn btn-defualt">إلغاء</a>
                </div>
            @endif
            
                </form>
            </div>
            </div>
        </div>
    </div>
@stop
