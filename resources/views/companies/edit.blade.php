@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Edit ' . $company->company_name,
                'breadcrumbs' => [
                    ['label' => 'List all companies', 'url' => route('companies_index')],
                    ['label' => 'Edit ' . $company->company_name, 'active' => true],
                ],
            ])
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $companyFields = include resource_path('views/companies/company-fields.blade.php');
    @endphp

    <x-form-edit name="companies_edit" action="company_update" form="Edit {{ $company->company_name }}" :model="$company"
        :fields="$companyFields" />
@endsection
