@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Create a new location',
                'breadcrumbs' => [
                    ['label' => 'List all locations', 'url' => route('locations_index')],
                    ['label' => 'Create a new location', 'active' => true],
                ],
            ])
        </div><!-- /.container-fluid -->
    </div>
    @php

        $locationFields = include resource_path('views/locations/location-fields.blade.php');

    @endphp

    <x-form-create name="locations_create" action="locations_store" form="Create a new location" :fields="$locationFields" />
@endsection
