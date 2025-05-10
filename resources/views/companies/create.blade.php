@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Create a new Company',
                'breadcrumbs' => [
                    ['label' => 'List all companies', 'url' => route('companies_index')],
                    ['label' => 'Create a new company', 'active' => true],
                ],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $companyFields = include resource_path('views/companies/company-fields.blade.php');
    @endphp

    <x-form-create name="companies_create" action="company_store" form="Create a new company" :fields="$companyFields" />
@endsection
