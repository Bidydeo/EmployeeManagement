@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create clients</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/clients">Clients</a></li>
                        <li class="breadcrumb-item active">Create a new client</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $clientFields = include resource_path('views/clients/client-fields.blade.php');
    @endphp

    <x-form-create name="clients_create" action="client_store" form="Create a new client" :fields="$clientFields" />
@endsection
