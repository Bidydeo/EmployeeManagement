@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Creează cerere de concediu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/leaves">Leaves list</a></li>
                        <li class="breadcrumb-item active">Creează cerere de concediu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    @php
        $leaveFields = include resource_path('views/leaves/leave-fields.blade.php');
    @endphp

    <x-form-create name="leaves_create" action="leaves_store" form="Create a new leave" :fields="$leaveFields" />
@endsection
