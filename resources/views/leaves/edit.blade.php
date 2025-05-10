@extends($userLayout)
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Edit ' . $leave->leave_type->name,
                'breadcrumbs' => [
                    ['label' => 'List all leaves', 'url' => route('leaves_index')],
                    ['label' => 'Edit ' . $leave->leave_type->name, 'active' => true],
                ],
            ])
        </div><!-- /.container-fluid -->
    </div>
    @php
        $leaveTypes = \App\Models\LeaveType::pluck('name', 'id')->toArray();
        $employees = \App\Models\Employee::pluck('employee_name', 'id')->toArray();

        $leaveFields = include resource_path('views/leaves/leave-fields.blade.php');

    @endphp
    <x-form-edit name="leaves_edit" action="leaves_update" form="Edit {{ $leave->leave_type->name }}" :model="$leave"
        :fields="$leaveFields" />
@endsection
