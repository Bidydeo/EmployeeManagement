@extends($userLayout)

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'List all clients',
                'breadcrumbs' => [['label' => 'List all clients', 'active' => true]],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List all clients</h3>
                </div>
                <div class="card-body">
                    <div class="pull-right mb-2">
                        @can('create', Client::class)
                            <a class="btn btn-success" href="{{ route('clients_create') }}"> Create new Client</a>
                        @endcan
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Country</th>
                                <th>Email</th>
                                <th>Company</th>
                                <th>Projects</th>
                                @role('Super Admin')
                                    <th>Action</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->country }}</td>
                                    <td>{{ $client->email }}</td>
                                    <td>{{ $client->companies->pluck('company_name')->join(', ') }}</td>
                                    @if ($client->projects->isEmpty())
                                        <td>No project yet</td>
                                    @else
                                        <td>{{ $client->projects->pluck('name')->join(', ') }}</td>
                                    @endif
                                    @role('Super Admin')
                                        <td>
                                            {{-- Editare doar pentru Super Admin --}}
                                            @can('edit', $client)
                                                <a class="btn btn-primary btn-sm m-2"
                                                    href="{{ route('client_edit', $client->id) }}">Edit</a>
                                            @endcan
                                            {{-- Ștergere doar pentru Super Admin --}}
                                            @can('delete', $client)
                                                <form action="{{ route('client_destroy', $client->id) }}" method="Post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm m-2"
                                                        onclick="return confirm('Ești sigur că vrei să ștergi acest client?');">
                                                        Delete
                                                    </button>
                                                </form>
                                            @endcan
                                        </td>
                                    @endrole
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No clients found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
