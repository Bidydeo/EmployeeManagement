@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Projects</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        @role('Super Admin')
                            <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        @endrole
                        @unlessrole('Super Admin')
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        @endunlessrole
                        <li class="breadcrumb-item active">Project list</li>
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
                <h3 class="card-title">List of projects</h3>
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
                    {{-- @can('create', EMployeeLocation::class)
                        <a class="btn btn-success" href="{{ route('locations_create') }}"> Create Location</a>
                    @endcan --}}
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Project</th>
                            <th>Project members</th>
                            <th>Project team</th>
                            {{-- <th>Project slug</th> --}}
                            <th>Project company</th>
                            <th>Project client</th>
                            @role('Super Admin')
                                <th>Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($projects as $project)
                            <td>{{ $project->name }}</td>
                            <td>{{ $project->employees()->pluck('employee_name')->implode(', ') }}</td>
                            <td>{{ $project->teams->pluck('name')->implode(', ') }}</td>
                            {{-- <td>{{ $project->slug }}</td> --}}
                            <td>{{ $project->company->company_name }}</td>
                            <td>{{ $project->client->name }}</td>
                            {{-- @role('Super Admin')
                                <td>

                                    @can('edit', $location)
                                        <a href="{{ route('locations_edit', $location->id) }}"
                                            class="btn btn-primary btn-sm m-2">Editare</a>
                                    @endcan

                                    @can('delete', $location)
                                        <form action="{{ route('locations_destroy', $location->id) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm m-2"
                                                onclick="return confirm('Ești sigur că vrei să ștergi acest punct de lucru?');">
                                                Delete
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            @endrole --}}
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No project found.</td>
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
