@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'List all projects',
                'breadcrumbs' => [['label' => 'List all projects', 'active' => true]],
            ])
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">List all projects</h3>
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
                            <td>{{ $project->name }} <br> <small>{{ $project->created_at->toFormattedDateString() }}</small>
                            </td>
                            <td>{{ $project->employees()->pluck('employee_name')->implode(', ') }}</td>
                            <td>{{ $project->teams->pluck('name')->implode(', ') }}</td>
                            <td>
                                <ul class="list-inline">
                                    @foreach ($project->teams as $team)
                                        @foreach ($team->employees as $employee)
                                            @if ($employee->user && $employee->user->avatar)
                                                <li class="list-inline-item">
                                                    {{ $employee->employee_name }}<img alt="{{ $employee->user->username }}"
                                                        width="40" height="40" class="img-circle elevation-2"
                                                        src="/storage/users_avatar/{{ $employee->user->avatar }}">
                                                </li>
                                            @endif
                                        @endforeach
                                    @endforeach
                                </ul>
                            </td>
                            <td class="project_progress">
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-green" role="progressbar"
                                        aria-valuenow="{{ $project->progress }}" aria-valuemin="0" aria-valuemax="100"
                                        style="width: {{ $project->progress }}%">
                                    </div>
                                </div>
                                <small>
                                    {{ $project->progress }}% Complete
                                </small>
                            </td>
                            @php
                                $statusClasses = [
                                    'Completed' => 'badge badge-success',
                                    'On Hold' => 'badge badge-warning',
                                    'Canceled' => 'badge badge-danger',
                                    'In Progress' => 'badge badge-primary',
                                    'Info' => 'badge badge-info',
                                    'Not Started' => 'badge badge-secondary',
                                    'Light' => 'badge badge-light',
                                    'Dark' => 'badge badge-dark',
                                ];

                                $statusClass = $statusClasses[$project->status] ?? 'badge badge-secondary';
                            @endphp
                            <td class="project-state">
                                <span class="{{ $statusClass }}">{{ $project->status }}</span>
                            </td>
                            <td>{{ $project->company->company_name }}</td>
                            <td>{{ $project->client->name }}</td>
                            <td><a class="btn btn-primary btn-sm m-2" href="{{ route('project_detail', $project->slug) }}">
                                    <i class="fas fa-folder"></i>
                                    View
                                </a></td>
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
