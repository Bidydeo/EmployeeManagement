@extends($userLayout)
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Edit ' . $location->name,
                'breadcrumbs' => [
                    ['label' => 'List all locations', 'url' => route('locations_index')],
                    ['label' => 'Edit ' . $location->name, 'active' => true],
                ],
            ])
        </div><!-- /.container-fluid -->
    </div>
    @php

        $locationFields = include resource_path('views/locations/location-fields.blade.php');

    @endphp
    <x-form-edit name="locations_edit" action="locations_update" form="Edit {{ $location->name }}" :model="$location"
        :fields="$locationFields" />
@endsection
