@extends($userLayout)

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit {{ $company->company_name }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="/admin/companies">Companies</a></li>
                        <li class="breadcrumb-item active">Edit {{ $company->company_name }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    @php
        $companyFields = include resource_path('views/companies/company-fields.blade.php');
    @endphp

    <x-form-edit name="companies_edit" action="company_update" form="Edit company" :model="$company" :fields="$companyFields" />
@endsection
