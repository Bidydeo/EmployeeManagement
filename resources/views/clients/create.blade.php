@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Create a new Client',
                'breadcrumbs' => [
                    ['label' => 'List all clients', 'url' => route('clients_index')],
                    ['label' => 'Create a new client', 'active' => true],
                ],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $clientFields = include resource_path('views/clients/client-fields.blade.php');
    @endphp

    <x-form-create name="clients_create" action="client_store" form="Create a new client" :fields="$clientFields" />
@endsection
