@extends($userLayout)
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editeaza {{ $leave->leave_type->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/leaves">Leaves list</a></li>
                        <li class="breadcrumb-item active">Editeaza {{ $leave->leave_type->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    @php
        $leaveTypes = \App\Models\LeaveType::pluck('name', 'id')->toArray();
        $employees = \App\Models\Employee::pluck('employee_name', 'id')->toArray();

        $leaveFields = include resource_path('views/leaves/leave-fields.blade.php');

    @endphp
    <x-form-edit name="leaves_edit" action="leaves_update" form="Edit leave" :model="$leave" :fields="$leaveFields" />
@endsection
