@extends('layouts.app')


@section('title')
    إضافة مستخدم جديد
@stop


@section('content')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="d-flex justify-content-between flex-wrap">
                <div class="d-flex align-items-end flex-wrap">
                    <div class="mr-md-3 mr-xl-5">
                        <h2>إضافة مستخدم جديد</h2>
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
                <form class="forms-sample" action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    @if(Session::has('error'))
                        <div class="alert alert-danger text-center" >
                            {{Session::get('error')}}
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">الاسم الكامل</label>
                    <input type="text" class="form-control" value="{{ old('name') }}" id="name" name="name" placeholder="" reqiured>
                </div>
                <div class="form-group">
                    <label for="email">البريد الالكتروني</label>
                    <input type="email" class="form-control" value="{{ old('email') }}" id="email" name="email" reqiured>
                </div>
                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" class="form-control" value="{{ old('password') }}  id="password" name="password" reqiured>
                </div>
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
