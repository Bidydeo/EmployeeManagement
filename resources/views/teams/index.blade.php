@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'List all teams',
                'breadcrumbs' => [['label' => 'List all teams', 'active' => true]],
            ])
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List all teams</h3>
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
                            <th>Team name</th>
                            <th>Project name</th>
                            <th>Client name</th>
                            <th>Company name</th>
                            <th>Team members</th>
                            @role('Super Admin')
                                <th>Action</th>
                            @endrole
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($teams as $team)
                            <td>{{ $team->name }}</td>
                            <td>{{ $team->project->name }}</td>
                            <td>{{ $team->project->client->name }}</td>
                            <td>{{ $team->project->company->company_name }}</td>
                            <td>{{ $team->employees->pluck('employee_name')->implode(', ') }}</td>
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
                                <td colspan="4">No team found.</td>
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
