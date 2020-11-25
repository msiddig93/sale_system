@extends('layouts.app')


@section('title')
    إضافة تفاصيل الي طلب المبيعات
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>إضافة تفاصيل الي طلب المبيعات</h2>
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
                <form class="forms-sample" action="{{ route('sales_detail.store') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center" >
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="product_id">إسم المنتج</label>
                    <select id="product_id" name="product_id" class="form-control">
                        @foreach( $products as $product)
                            <option {{ old('product_id') == $product->id ? "selected" : "" }} value="{{ $product->id }}" >{{ $product->name }}</option>
                        @endforeach
                    </select>
                    
                </div>
                <div class="form-group">
                    <label for="qte"> الكمية</label>
                    <input type="number" class="form-control" value="{{ old('qte') }}" id="qte" name="qte" placeholder="" reqiured>
                </div>
                <div class="form-group">
                    <label for="price"> السعر</label>
                    <input type="number" class="form-control" value="{{ old('price') }}" id="price" name="price" placeholder="" reqiured>
                </div>
                <div class="form-group text-center" >
                    <hr>
                    <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    <a href="{{ route('sales_bill.create') }}" class="btn btn-defualt">إلغاء</a>
                </div>
                
                </form>
            </div>
            </div>
        </div>
    </div>
@stop
