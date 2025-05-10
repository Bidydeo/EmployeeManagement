@extends($userLayout)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Project details',
                'breadcrumbs' => [
                    ['label' => 'List all projects', 'url' => route('projects_index')],
                    ['label' => 'Project details', 'active' => true],
                ],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ $project->name }}</h3>
            <div class="card-tools">
                <!-- Maximize Button -->
                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                <!-- Collapse Button -->
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-animation-speed="1000"><i
                        class="fas fa-minus"></i></button>
            </div>
            <!-- /.card-tools -->
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row mt-3 mb-3">
                <div class="col-md-3 d-flex justify-content-start">
                    <!-- Butonul pentru deschiderea ferestrei modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createDirectoryModal">
                        Creează Director Nou
                    </button>
                    <!-- Fereastra modală -->
                    <div class="modal fade" id="createDirectoryModal" tabindex="-1" role="dialog"
                        aria-labelledby="createDirectoryModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="createDirectoryModalLabel">Creează Director Nou</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formular pentru crearea directorului nou -->
                                    <form
                                        action="{{ route('project_file-manager.create-directory', ['project' => $project->id]) }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="path" value="{{ $path }}">
                                        <div class="form-group">
                                            <label for="directory_name">Nume Director</label>
                                            <input type="text" class="form-control" id="directory_name"
                                                name="directory_name" placeholder="Nume director nou" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="directory_path">Cale Director</label>
                                            <input type="text" class="form-control" id="directory_path"
                                                value="{{ $path }}">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Creează Director</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex justify-content-start">
                    <input type="text" class="form-control" placeholder="search for file and folders">
                </div>
                <div class="col-md-4 d-flex justify-content-end">
                    <!-- Aliniază butoanele la dreapta -->
                    <button class="btn btn-primary mr-2">Upload Files</button>
                    <button class="btn btn-info mr-2">Share</button>
                    <button class="btn btn-success mr-2">Download</button>
                    <button class="btn btn-danger">Delete</button>
                </div>
            </div>
            <div class="row">
                <!-- Secțiunea 1 care ocupă 3 coloane și are scrollbar propriu -->
                <div class="col-md-3" style="overflow-y: auto; max-height: 800px;">
                    {{-- <ul data-widget="treeview">
                    <li class="treeview">
                      <a href="#">My Project Files</a>
                      <ul class="treeview-menu">
                        <li><a href="/project_files">FOLDER 1</a></li>
                            <ul class="treeview-menu">
                            <li><a href="#">SUBFOLDER 1</a></li>
                            <li><a href="#">SUBFOLDER 2</a></li>
                            <li><a href="#">SUBFOLDER 3</a></li>
                            </ul>
                        <li><a href="#">FOLDER 2</a></li>
                        <li><a href="#">FOLDER 3</a></li>
                            <ul class="treeview-menu">
                            <li><a href="#">SUBFOLDER 1</a></li>
                            <li><a href="#">SUBFOLDER 2</a></li>
                            <li><a href="#">SUBFOLDER 3</a></li>
                            </ul>
                        <li><a href="#">FOLDER 4</a></li>
                        <li><a href="#">FOLDER 5</a></li>
                        <li><a href="#">FOLDER 6</a></li>
                            <ul class="treeview-menu">
                            <li><a href="#">SUBFOLDER 1</a></li>
                            <li><a href="#">SUBFOLDER 2</a></li>
                            <li><a href="#">SUBFOLDER 3</a></li>
                            </ul>
                      </ul>
                    </li>
                    <li><a href="#">Share with me</a></li>
                    <li><a href="#">Share by me</a></li>
                    <li><a href="#">Trash</a></li>
                </ul> --}}
                    <p>Current Path: /{{ $path }}</p>

                    <!-- Navigare în sus, dacă nu suntem în directorul rădăcină -->
                    @if ($path)
                        <a
                            href="{{ route('project_file-manager.index', ['project' => $project->id, 'path' => dirname($path)]) }}">Back</a>
                    @endif

                    <ul>
                        <!-- Listează directoarele -->
                        @foreach ($directories as $directory)
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24"
                                    viewBox="0 0 48 48">
                                    <linearGradient id="Om5yvFr6YrdlC0q2Vet0Ha_WWogVNJDSfZ5_gr1" x1="-7.018"
                                        x2="39.387" y1="9.308" y2="33.533" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#fac017"></stop>
                                        <stop offset=".909" stop-color="#e1ab2d"></stop>
                                    </linearGradient>
                                    <path fill="url(#Om5yvFr6YrdlC0q2Vet0Ha_WWogVNJDSfZ5_gr1)"
                                        d="M44.5,41h-41C2.119,41,1,39.881,1,38.5v-31C1,6.119,2.119,5,3.5,5h11.597	c1.519,0,2.955,0.69,3.904,1.877L21.5,10h23c1.381,0,2.5,1.119,2.5,2.5v26C47,39.881,45.881,41,44.5,41z">
                                    </path>
                                    <linearGradient id="Om5yvFr6YrdlC0q2Vet0Hb_WWogVNJDSfZ5_gr2" x1="5.851"
                                        x2="18.601" y1="9.254" y2="27.39" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#fbfef3"></stop>
                                        <stop offset=".909" stop-color="#e2e4e3"></stop>
                                    </linearGradient>
                                    <path fill="url(#Om5yvFr6YrdlC0q2Vet0Hb_WWogVNJDSfZ5_gr2)"
                                        d="M2,25h20V11H4c-1.105,0-2,0.895-2,2V25z"></path>
                                    <linearGradient id="Om5yvFr6YrdlC0q2Vet0Hc_WWogVNJDSfZ5_gr3" x1="2"
                                        x2="22" y1="19" y2="19" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#fbfef3"></stop>
                                        <stop offset=".909" stop-color="#e2e4e3"></stop>
                                    </linearGradient>
                                    <path fill="url(#Om5yvFr6YrdlC0q2Vet0Hc_WWogVNJDSfZ5_gr3)"
                                        d="M2,26h20V12H4c-1.105,0-2,0.895-2,2V26z"></path>
                                    <linearGradient id="Om5yvFr6YrdlC0q2Vet0Hd_WWogVNJDSfZ5_gr4" x1="16.865"
                                        x2="44.965" y1="39.287" y2="39.792" gradientUnits="userSpaceOnUse">
                                        <stop offset="0" stop-color="#e3a917"></stop>
                                        <stop offset=".464" stop-color="#d79c1e"></stop>
                                    </linearGradient>
                                    <path fill="url(#Om5yvFr6YrdlC0q2Vet0Hd_WWogVNJDSfZ5_gr4)"
                                        d="M1,37.875V38.5C1,39.881,2.119,41,3.5,41h41c1.381,0,2.5-1.119,2.5-2.5v-0.625H1z">
                                    </path>
                                    <linearGradient id="Om5yvFr6YrdlC0q2Vet0He_WWogVNJDSfZ5_gr5" x1="-4.879"
                                        x2="35.968" y1="12.764" y2="30.778" gradientUnits="userSpaceOnUse">
                                        <stop offset=".34" stop-color="#ffefb2"></stop>
                                        <stop offset=".485" stop-color="#ffedad"></stop>
                                        <stop offset=".652" stop-color="#ffe99f"></stop>
                                        <stop offset=".828" stop-color="#fee289"></stop>
                                        <stop offset="1" stop-color="#fed86b"></stop>
                                    </linearGradient>
                                    <path fill="url(#Om5yvFr6YrdlC0q2Vet0He_WWogVNJDSfZ5_gr5)"
                                        d="M44.5,11h-23l-1.237,0.824C19.114,12.591,17.763,13,16.381,13H3.5C2.119,13,1,14.119,1,15.5	v22C1,38.881,2.119,40,3.5,40h41c1.381,0,2.5-1.119,2.5-2.5v-24C47,12.119,45.881,11,44.5,11z">
                                    </path>
                                    <radialGradient id="Om5yvFr6YrdlC0q2Vet0Hf_WWogVNJDSfZ5_gr6" cx="37.836"
                                        cy="49.317" r="53.875" gradientUnits="userSpaceOnUse">
                                        <stop offset=".199" stop-color="#fec832"></stop>
                                        <stop offset=".601" stop-color="#fcd667"></stop>
                                        <stop offset=".68" stop-color="#fdda75"></stop>
                                        <stop offset=".886" stop-color="#fee496"></stop>
                                        <stop offset="1" stop-color="#ffe8a2"></stop>
                                    </radialGradient>
                                    <path fill="url(#Om5yvFr6YrdlC0q2Vet0Hf_WWogVNJDSfZ5_gr6)"
                                        d="M44.5,40h-41C2.119,40,1,38.881,1,37.5v-21C1,15.119,2.119,14,3.5,14h13.256	c1.382,0,2.733-0.409,3.883-1.176L21.875,12H44.5c1.381,0,2.5,1.119,2.5,2.5v23C47,38.881,45.881,40,44.5,40z">
                                    </path>
                                </svg>
                                <a
                                    href="{{ route('project_file-manager.index', ['project' => $project->slug, 'path' => $directory]) }}">{{ basename($directory) }}</a>
                            </li>
                        @endforeach

                        <!-- Listează fișierele -->
                        {{-- @foreach ($files as $file)
                        <li>
                            <a href="{{ route('project_file-manager.show', ['project' => $project->id,'path' => $file]) }}">{{ basename($file) }}</a>
                        </li>
                    @endforeach --}}
                    </ul>
                </div>

                <!-- Secțiunea 2 care ocupă celelalte 9 coloane -->
                <div class="col-md-9" style="overflow-y: auto; max-height: 800px;">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div>
                                        @if ($path)
                                            <a
                                                href="{{ route('project_file-manager.index', ['project' => $project->slug, 'path' => dirname($path)]) }}">Back</a>
                                        @endif
                                    </div>
                                    <div>
                                        @if ($path != '')
                                            <h3 class="card-title">{{ $path }}</h3>
                                        @else
                                            <h3 class="card-title">Projects root</h3>
                                        @endif

                                    </div>
                                    <div class="card-tools">
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="text" name="table_search" class="form-control float-right"
                                                placeholder="Search for files and folders">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <section class="content">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card card-primary">
                                                    <div class="card-body">
                                                        {{-- <div>
                              <div class="btn-group w-100 mb-2">
                                <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>
                                <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Category 1 (WHITE) </a>
                                <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Category 2 (BLACK) </a>
                                <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Category 3 (COLORED) </a>
                                <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Category 4 (COLORED, BLACK) </a>
                              </div>
                              <div class="mb-2">
                                <a class="btn btn-secondary" href="javascript:void(0)" data-shuffle> Shuffle items </a>
                                <div class="float-right">
                                  <select class="custom-select" style="width: auto;" data-sortOrder>
                                    <option value="index"> Sort by Position </option>
                                    <option value="sortData"> Sort by Custom Data </option>
                                  </select>
                                  <div class="btn-group">
                                    <a class="btn btn-default" href="javascript:void(0)" data-sortAsc> Ascending </a>
                                    <a class="btn btn-default" href="javascript:void(0)" data-sortDesc> Descending </a>
                                  </div>
                                </div>
                              </div>
                            </div> --}}
                                                        <div>
                                                            <div class="filter-container p-0 row">
                                                                @foreach ($directories as $directory)
                                                                    <div class="filtr-item col-sm-2" data-category="1"
                                                                        data-sort="white sample">
                                                                        <a
                                                                            href="{{ route('project_file-manager.index', ['project' => $project->slug, 'path' => $directory]) }}">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                                y="0px" width="96" height="96"
                                                                                viewBox="0 0 48 48">
                                                                                <linearGradient
                                                                                    id="Om5yvFr6YrdlC0q2Vet0Ha_WWogVNJDSfZ5_gr1"
                                                                                    x1="-7.018" x2="39.387"
                                                                                    y1="9.308" y2="33.533"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#fac017"></stop>
                                                                                    <stop offset=".909"
                                                                                        stop-color="#e1ab2d"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#Om5yvFr6YrdlC0q2Vet0Ha_WWogVNJDSfZ5_gr1)"
                                                                                    d="M44.5,41h-41C2.119,41,1,39.881,1,38.5v-31C1,6.119,2.119,5,3.5,5h11.597	c1.519,0,2.955,0.69,3.904,1.877L21.5,10h23c1.381,0,2.5,1.119,2.5,2.5v26C47,39.881,45.881,41,44.5,41z">
                                                                                </path>
                                                                                <linearGradient
                                                                                    id="Om5yvFr6YrdlC0q2Vet0Hb_WWogVNJDSfZ5_gr2"
                                                                                    x1="5.851" x2="18.601"
                                                                                    y1="9.254" y2="27.39"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#fbfef3"></stop>
                                                                                    <stop offset=".909"
                                                                                        stop-color="#e2e4e3"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#Om5yvFr6YrdlC0q2Vet0Hb_WWogVNJDSfZ5_gr2)"
                                                                                    d="M2,25h20V11H4c-1.105,0-2,0.895-2,2V25z">
                                                                                </path>
                                                                                <linearGradient
                                                                                    id="Om5yvFr6YrdlC0q2Vet0Hc_WWogVNJDSfZ5_gr3"
                                                                                    x1="2" x2="22"
                                                                                    y1="19" y2="19"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#fbfef3"></stop>
                                                                                    <stop offset=".909"
                                                                                        stop-color="#e2e4e3"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#Om5yvFr6YrdlC0q2Vet0Hc_WWogVNJDSfZ5_gr3)"
                                                                                    d="M2,26h20V12H4c-1.105,0-2,0.895-2,2V26z">
                                                                                </path>
                                                                                <linearGradient
                                                                                    id="Om5yvFr6YrdlC0q2Vet0Hd_WWogVNJDSfZ5_gr4"
                                                                                    x1="16.865" x2="44.965"
                                                                                    y1="39.287" y2="39.792"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#e3a917"></stop>
                                                                                    <stop offset=".464"
                                                                                        stop-color="#d79c1e"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#Om5yvFr6YrdlC0q2Vet0Hd_WWogVNJDSfZ5_gr4)"
                                                                                    d="M1,37.875V38.5C1,39.881,2.119,41,3.5,41h41c1.381,0,2.5-1.119,2.5-2.5v-0.625H1z">
                                                                                </path>
                                                                                <linearGradient
                                                                                    id="Om5yvFr6YrdlC0q2Vet0He_WWogVNJDSfZ5_gr5"
                                                                                    x1="-4.879" x2="35.968"
                                                                                    y1="12.764" y2="30.778"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset=".34"
                                                                                        stop-color="#ffefb2"></stop>
                                                                                    <stop offset=".485"
                                                                                        stop-color="#ffedad"></stop>
                                                                                    <stop offset=".652"
                                                                                        stop-color="#ffe99f"></stop>
                                                                                    <stop offset=".828"
                                                                                        stop-color="#fee289"></stop>
                                                                                    <stop offset="1"
                                                                                        stop-color="#fed86b"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#Om5yvFr6YrdlC0q2Vet0He_WWogVNJDSfZ5_gr5)"
                                                                                    d="M44.5,11h-23l-1.237,0.824C19.114,12.591,17.763,13,16.381,13H3.5C2.119,13,1,14.119,1,15.5	v22C1,38.881,2.119,40,3.5,40h41c1.381,0,2.5-1.119,2.5-2.5v-24C47,12.119,45.881,11,44.5,11z">
                                                                                </path>
                                                                                <radialGradient
                                                                                    id="Om5yvFr6YrdlC0q2Vet0Hf_WWogVNJDSfZ5_gr6"
                                                                                    cx="37.836" cy="49.317"
                                                                                    r="53.875"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset=".199"
                                                                                        stop-color="#fec832"></stop>
                                                                                    <stop offset=".601"
                                                                                        stop-color="#fcd667"></stop>
                                                                                    <stop offset=".68"
                                                                                        stop-color="#fdda75"></stop>
                                                                                    <stop offset=".886"
                                                                                        stop-color="#fee496"></stop>
                                                                                    <stop offset="1"
                                                                                        stop-color="#ffe8a2"></stop>
                                                                                </radialGradient>
                                                                                <path
                                                                                    fill="url(#Om5yvFr6YrdlC0q2Vet0Hf_WWogVNJDSfZ5_gr6)"
                                                                                    d="M44.5,40h-41C2.119,40,1,38.881,1,37.5v-21C1,15.119,2.119,14,3.5,14h13.256	c1.382,0,2.733-0.409,3.883-1.176L21.875,12H44.5c1.381,0,2.5,1.119,2.5,2.5v23C47,38.881,45.881,40,44.5,40z">
                                                                                </path>
                                                                            </svg>

                                                                            {{ basename($directory) }}
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                                {{-- </div>
                              <div class="filter-container p-0 row"> --}}
                                                                @foreach ($files as $file)
                                                                    <div class="filtr-item col-sm-2" data-category="1"
                                                                        data-sort="green sample">
                                                                        <a
                                                                            href="{{ route('project_file-manager.show', ['project' => $project->slug, 'path' => $file]) }}">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                                y="0px" width="96" height="96"
                                                                                viewBox="0 0 48 48">
                                                                                <path fill="#50e6ff"
                                                                                    d="M39,16v25c0,1.105-0.895,2-2,2H11c-1.105,0-2-0.895-2-2V7c0-1.105,0.895-2,2-2h17L39,16z">
                                                                                </path>
                                                                                <linearGradient
                                                                                    id="F8F33TU9HxDNWNbQYRyY3a_XWoSyGbnshH2_gr1"
                                                                                    x1="28.529" x2="33.6"
                                                                                    y1="15.472" y2="10.4"
                                                                                    gradientUnits="userSpaceOnUse">
                                                                                    <stop offset="0"
                                                                                        stop-color="#3079d6"></stop>
                                                                                    <stop offset="1"
                                                                                        stop-color="#297cd2"></stop>
                                                                                </linearGradient>
                                                                                <path
                                                                                    fill="url(#F8F33TU9HxDNWNbQYRyY3a_XWoSyGbnshH2_gr1)"
                                                                                    d="M28,5v9c0,1.105,0.895,2,2,2h9L28,5z">
                                                                                </path>
                                                                            </svg>
                                                                            {{ basename($file) }}
                                                                        </a>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- /.container-fluid -->
                                </section>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.card-body -->

    <!-- /.card-body -->
    <div class="card-footer">
        The footer of the card
    </div>
    <!-- /.card-footer -->
    </div>
    <!-- /.card -
@endsection
