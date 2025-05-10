@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Create a new leave',
                'breadcrumbs' => [
                    ['label' => 'List all leaves', 'url' => route('leaves_index')],
                    ['label' => 'Create a new leave', 'active' => true],
                ],
            ])
        </div><!-- /.container-fluid -->
    </div>
    @php
        $leaveFields = include resource_path('views/leaves/leave-fields.blade.php');
    @endphp

    <x-form-create name="leaves_create" action="leaves_store" form="Create a new leave" :fields="$leaveFields" />
@endsection
