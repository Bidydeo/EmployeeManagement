@extends($userLayout)
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit {{ $location->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/locations">Locations</a></li>
                        <li class="breadcrumb-item active">Edit {{ $location->name }}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    @php

        $locationFields = include resource_path('views/locations/location-fields.blade.php');

    @endphp
    <x-form-edit name="locations_edit" action="locations_update" form="Edit location" :model="$location" :fields="$locationFields" />
@endsection
