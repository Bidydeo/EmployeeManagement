@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Edit ' . $client->name,
                'breadcrumbs' => [
                    ['label' => 'List all clients', 'url' => route('clients_index')],
                    ['label' => 'Edit ' . $client->name, 'active' => true],
                ],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $clientFields = include resource_path('views/clients/client-fields.blade.php');
    @endphp
    <x-form-edit name="clients_edit" action="client_update" form="Edit {{ $client->name }}" :model="$client"
        :fields="$clientFields" />
@endsection
