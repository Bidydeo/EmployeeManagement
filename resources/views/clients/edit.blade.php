@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit {{ $client->name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/clients">Clients</a></li>
                        <li class="breadcrumb-item active">Edit {{ $client->name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $clientFields = include resource_path('views/clients/client-fields.blade.php');
    @endphp
    <x-form-edit name="clients_edit" action="client_update" form="Edit client" :model="$client" :fields="$clientFields" />
@endsection
