@extends($userLayout)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'List all employees',
                'breadcrumbs' => [['label' => 'List all employees', 'active' => true]],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Employees</h3>
                </div>
                <div class="card-body">
                    {{-- <div class="pull-right mb-2">
                        @can('create', Employee::class)
                            <a class="btn btn-success" href="{{ route('employee_create') }}"> Create Employee</a>
                        @endcan
                    </div> --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name & Lastname</th>
                                <th>Company</th>
                                <th>Department</th>
                                <th>Status</th>
                                <th>Email & Phone</th>
                                <th>Job Location</th>
                                @role('Super Admin')
                                    <th>Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($employees as $index => $employee)
                                <td>{{ $index + 1 }}</td> <!-- Număr de ordine -->
                                <td>{{ $employee->employee_name }}<br>
                                    {{ $employee->employee_lastname }}</td>
                                <td>{{ $employee->company->company_name }}</td>
                                <td>{{ $employee->department->name }}
                                </td>
                                <td>{{ $employee->status }}</td>
                                <td>{{ $employee->email }}<br>{{ $employee->phone }}</td>
                                <td>{{ $employee->locations->pluck('name')->implode(', ') }}</td>
                                @role('Super Admin')
                                    <td>
                                        {{-- Editare doar pentru Super Admin --}}
                                        {{-- @can('edit', $employee)
                                            <a class="btn btn-primary btn-sm m-2"
                                                href="{{ route('employee_edit', $employee->id) }}">Edit</a>
                                        @endcan --}}
                                        {{-- Ștergere doar pentru Super Admin --}}
                                        {{-- @can('delete', $employee)
                                            <form action="{{ route('employee_destroy', $employee->id) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-2"
                                                    onclick="return confirm('Ești sigur că vrei să ștergi acest angajat?');">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan --}}
                                    </td>
                                @endrole
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No employee found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
