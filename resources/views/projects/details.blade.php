@extends($userLayout)

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Project details',
                'breadcrumbs' => [
                    ['label' => 'List all projects', 'url' => route('projects_index')],
                    ['label' => 'Project details', 'active' => true],
                ],
            ])
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Project details</h3>
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
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated budget</span>
                                        <span class="info-box-number text-center text-muted mb-0"
                                            style="font-variant-numeric: tabular-nums;">{{ number_format($project->budget, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total amount spent</span>
                                        <span class="info-box-number text-center text-muted mb-0"
                                            style="font-variant-numeric: tabular-nums;">{{ number_format($project->spending, 2, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated project
                                            duration</span>
                                        <span class="info-box-number text-center text-muted mb-0"
                                            style="font-variant-numeric: tabular-nums;">{{ number_format($project->duration, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Recent Activity</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                            Demo File 1 v2</a>
                                    </p>
                                </div>

                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                            Demo File 2</a>
                                    </p>
                                </div>

                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> Demo
                                            File 1 v1</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i>{{ $project->name }}</h3>
                        <div class="text-muted">
                            <p class="text-sm">
                            <h6>Project Summary</h6>
                            <b class="d-block">{{ $project->description }}</b>
                            <br>
                            <div class="text-muted">
                                <p class="text-sm">Client Company
                                    <b class="d-block">{{ $project->client->name }}</b>
                                </p>
                                <p class="text-sm">Project Leader
                                    @if (!empty($project->projectleader))
                                        <b class="d-block"><i
                                                class="fas fa-user-circle mr-2"></i>{{ $project->projectleader }}</b>
                                    @else
                                        <p class="text-danger">Niciun lider de proiect desemnat.</p>
                                    @endif
                                </p>
                                {{-- <p class="text-sm">Project Teams
                                        @if ($project->teams->isEmpty())
                                            <p class="text-danger">Nicio echipă desemnată pentru acest proiect.</p>
                                        @else
                                            <b class="d-block">
                                                @foreach ($project->teams as $team)
                                                    {{ $team->name }}
                                                    <br>
                                                @endforeach
                                            </b>
                                        @endif
                                    </p> --}}
                                {{-- <p class="text-sm">Team Members
                                        @if ($project->teams->isEmpty() || $project->teams->every(fn($team) => $team->employees->isEmpty()))
                                            <p class="text-danger">Nicio echipă desemnată pentru acest proiect.</p>
                                        @else
                                            <b class="d-block">
                                                @foreach ($project->teams as $team)
                                                    @foreach ($team->employees as $employee)
                                                        {{ $employee->employee_name }} {{ $employee->employee_lastname }} -
                                                        {{ $employee->roles->pluck('name')->join(', ') }}
                                                        @if (!$loop->parent->last || !$loop->last)
                                                            ,<br>
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            </b>
                                        @endif
                                    </p>
                                </div> --}}

                                {{-- <h5 class="mt-5 text-muted">Project files</h5>
                                <ul class="list-unstyled">
                                    @foreach ($project->files as $file)
                                        <li>
                                            <a href="{{ Storage::url($file->path) }}" class="btn-link text-secondary"><i
                                                    class="far fa-fw fa-file-{{ $file->mime_type }}"></i>
                                                {{ $file->name }}</a>
                                        </li>
                                    @endforeach
                                </ul> --}}
                                <div class="text-center mt-5 mb-3">
                                    {{-- <a href="{{ route('project_file-manager.index', $project->slug) }}"
                                            class="btn btn-sm btn-primary">View files</a> --}}
                                    <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
