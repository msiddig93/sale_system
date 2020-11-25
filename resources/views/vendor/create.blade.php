@extends('layouts.app')


@section('title')إضافة مورد جديد
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>إضافة مورد جديد</h2>
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
                <form class="forms-sample" action="{{ route('vendor.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center" >
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">إسم المورد</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="" reqiured>
                </div>
               
                <div class="form-group">
                    <label for="name">العنوان</label>
                    <input type="text" class="form-control" value="{{ old('address') }}" id="address" name="address" placeholder="" reqiured>
                </div>
                <div class="form-group">
                    <label for="name">اسم البلد</label>
                    <input type="text" class="form-control" value="{{ old('country_name') }}" id="country_name" name="country_name" placeholder="" reqiured>
                </div>
                <div class="form-group">
                    <label for="name">الشركة</label>
                    <input type="text" class="form-control" value="{{ old('company') }}" id="company" name="company" placeholder="" reqiured>
                </div>
                <div class="form-group text-center" >
                    <hr>
                    <button type="submit" class="btn btn-primary mr-2">حفظ</button>
                    <a href="{{ route('vendor.index') }}" class="btn btn-defualt">إلغاء</a>
                </div>
                
                </form>
            </div>
            </div>
        </div>
    </div>
@stop

