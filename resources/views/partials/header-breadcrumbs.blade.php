<div class="row mb-2">
    <div class="col-sm-6">
        <h1 class="m-0">{{ $pageTitle }}</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            @role('Super Admin')
                <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
            @else
                <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
            @endrole
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb['active'] ?? false)
                    <li class="breadcrumb-item active">{{ $breadcrumb['label'] }}</li>
                @else
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                @endif
            @endforeach
        </ol>
    </div><!-- /.col -->
</div><!-- /.row -->
