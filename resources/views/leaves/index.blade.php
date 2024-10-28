@extends('layouts.master')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Creează cerere de concediu</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dasshboard</a></li>
                        <li class="breadcrumb-item active">Creează cerere de concediu</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List of Leaves</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="pull-right mb-2">
                    <a class="btn btn-success" href="{{ route('leaves.create') }}"> Create Leave</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Leave type</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Substitute employee</th>
                            <th>Manager</th>
                            <th>Reason</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($leaves as $leave)
                            <td>{{ $leave->employee->employee_name }}</td>
                            <td>{{ $leave->leave_type->name }}</td>
                            <td>{{ $leave->start_date }}</td>
                            <td>{{ $leave->end_date }}</td>
                            @if ($leave->substitute_employee_id && $leave->substitute_employee->employee_name)
                                <td>{{ $leave->substitute_employee->employee_name }}</td>
                            @else
                                <td>Fara inlocuitor</td>
                            @endif
                            <td>{{ $leave->employee->department->manager->employee_name }}</td>
                            <td>{{ $leave->reason }}</td>
                            <td>{{ $leave->comments }}</td>
                            <td>{{ $leave->status }}</td>
                            <td>
                                @if ($leave->substitute_employee == Auth::user()->employee && $leave->status == 'Pending')
                                    <form action="{{ route('leaves.substituteApproved', $leave->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Ești sigur că vrei să aprobi această cerere?');">
                                            Aprobare
                                        </button>
                                    </form>
                                    <form action="{{ route('leaves.substituteRejected', $leave->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning"
                                            onclick="return confirm('Ești sigur că vrei să respingi această cerere?');">
                                            Respingere
                                        </button>
                                    </form>
                                @elseif ($leave->employee->department->manager == Auth::user()->employee && $leave->status == 'ApprovedBySubstitute')
                                    <form action="{{ route('leaves.managerApproved', $leave->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success"
                                            onclick="return confirm('Ești sigur că vrei să aprobi această cerere ca manager?');">
                                            Aprobare Manager
                                        </button>
                                    </form>
                                    <form action="{{ route('leaves.managerRejected', $leave->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning"
                                            onclick="return confirm('Ești sigur că vrei să respingi această cerere ca manager?');">
                                            Respingere Manager
                                        </button>
                                    </form>
                                @elseif($leave->employee_id == Auth::user()->employee->id && $leave->status == 'Pending')
                                    <a href="{{ route('leaves.edit', $leave->id) }}" class="btn btn-info">Editare</a>
                                    <form action="{{ route('leaves.delete', $leave->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Ești sigur că vrei să ștergi această cerere?');">
                                            Ștergere
                                        </button>
                                    @else
                                        <button class="btn btn-secondary" disabled>{{ $leave->status }}
                                            at {{ $leave->updated_at }}</button>
                                    </form>
                                @endif
                            </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No leaves found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->
    </section>
    <!-- /.content -->
@endsection
