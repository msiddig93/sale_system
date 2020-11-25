<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
    @yield('title')
    </title>
    {{--  <!-- plugins:css -->  --}}
    <link rel="stylesheet" href="{{ asset('vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/base/vendor.bundle.base.css') }}">
    {{--  <!-- endinject -->  --}}
    {{--  <!-- plugin css for this page -->  --}}
    <link rel="stylesheet" href="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <!-- End plugin css for this page -->
    {{--  <!-- inject:css -->  --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    {{--  <!-- endinject -->  --}}
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" />
    <style>
.page-body-wrapper {
    min-height: calc(100vh - 60px);
    display: flex;
    flex-direction: row;
    padding-left: 0px;
    padding-right: 0px;
    padding-top: 0px;
}
.main-panel {
    transition: width 0.25s ease 0s, margin 0.25s ease 0s;
    width: calc(100% - 0px);
    min-height: calc(100vh - 60px);
    display: flex;
    flex-direction: column;
}

.test {
    vertical-align: middle;
    border-style: none;
    width: 150px;
}
    </style>
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            
            {{--  <!-- partial -->  --}}
                <div class="main-panel">
                    <div class="content-wrapper">
                    <div class="row">
                    <div class="col-4 text-center">
                        <img class="test" src="{{ asset('img/logo.jpg') }}" >
                    </div>
                    <div class="col-4 text-center ">
                        <h2>إدارة المشتريات و المبيعات</h2>
                    </div>
                    <div class="col-4 text-center">
                        <img class="test" src="{{ asset('img/logo.jpg') }}" >
                    </div>
                    </div>
                        
                        @yield('content')
                        
                    </div>
                    
            </div>
            <!-- main-panel ends -->
        </div>
        {{--  <!-- page-body-wrapper ends -->  --}}
    </div>
    {{--  <!-- container-scroller -->  --}}

    {{--  <!-- plugins:js -->  --}}
    <script src="{{ asset('vendors/base/vendor.bundle.base.js') }}"></script>
    {{--  <!-- endinject -->  --}}
    {{--  <!-- Plugin js for this page-->  --}}
    <script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script>
    {{--  <!-- End plugin js for this page-->  --}}
    {{--  <!-- inject:js -->  --}}
    <script src="{{ asset('js/off-canvas.js') }}"></script>
    <script src="{{ asset('js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('js/template.js') }}"></script>
    {{--  <!-- endinject -->  --}}
    {{--  <!-- Custom js for this page-->  --}}
    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    {{--  <!-- End custom js for this page-->  --}}
    <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>
</body>

</html>