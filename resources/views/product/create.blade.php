@extends('layouts.app')


@section('title')
    إضافة منتج جديد
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>إضافة منتج جديد</h2>
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
                <form class="forms-sample" action="{{ route('product.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center" >
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">إسم المنتج</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="" reqiured>
                </div>
                <div class="form-group">
                    <label for="category_id">صنف المنتج</label>
                    <select id="category_id" name="category_id" class="form-control">
                        @foreach( $categories as $category)
                            <option {{ old('category_id') == $category->id ? "selected" : "" }} value="{{ $category->id }}" >{{ $category->name }}</option>
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
                    <a href="{{ route('category.index') }}" class="btn btn-defualt">إلغاء</a>
                </div>
                
                </form>
            </div>
            </div>
        </div>
    </div>
@stop
