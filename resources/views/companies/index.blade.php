@extends($userLayout)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Companies</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @role('Super Admin')
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        @endrole
                        @unlessrole('Super Admin')
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        @endunlessrole
                        <li class="breadcrumb-item active">Companies</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of Companies</h3>
                </div>
                <div class="card-body">
                    <div class="pull-right mb-2">
                        @can('create', Company::class)
                            <a class="btn btn-success" href="{{ route('companies_create') }}"> Create Company</a>
                        @endcan
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Projects</th>
                                <th>Clients</th>
                                <th>Registru comertului</th>
                                <th>Address</th>
                                <th>Email & Phone</th>
                                <th>Admin</th>
                                @role('Super Admin')
                                    <th>Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($companies as $company)
                                <td>{{ $company->company_name }}</td>
                                <td>
                                    @if ($company->company_logo)
                                        <img src="{{ asset($company->company_logo) }}" alt="Company Logo" width="100">
                                    @else
                                        <p>Fără logo</p>
                                    @endif
                                </td>
                                <td>{{ $company->projects->pluck('name')->implode(', ') }}</td>
                                <td>{{ $company->clients->pluck('name')->implode(', ') }}</td>
                                <td>{{ $company->company_reg_com }}
                                    {{ $company->company_cui }}</td>
                                <td>{{ $company->company_country }}
                                    {{ $company->company_town }}
                                    {{ $company->company_district }}
                                    {{ $company->company_street_name }}
                                    {{ $company->company_street_no }}
                                </td>
                                <td>{{ $company->company_email }} <br>{{ $company->company_phone }}</td>
                                <td>{{ $company->company_admin }}</td>
                                @role('Super Admin')
                                    <td>
                                        {{-- Editare doar pentru Super Admin --}}
                                        @can('edit', $company)
                                            <a class="btn btn-primary btn-sm m-2"
                                                href="{{ route('company_edit', $company->id) }}">Edit</a>
                                        @endcan
                                        {{-- Ștergere doar pentru Super Admin --}}
                                        @can('delete', $company)
                                            <form action="{{ route('company_destroy', $company->id) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm m-2"
                                                    onclick="return confirm('Ești sigur că vrei să ștergi acesta companie?');">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </td>
                                @endrole
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No companies found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
