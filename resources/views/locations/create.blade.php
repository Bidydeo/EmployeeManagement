@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create new locations</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/locations">Locations</a></li>
                        <li class="breadcrumb-item active">Create new locations</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    @php

        $locationFields = include resource_path('views/locations/location-fields.blade.php');

    @endphp

    <x-form-create name="locations_create" action="locations_store" form="Create a new location" :fields="$locationFields" />
@endsection
