@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users list</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid ">
            @foreach ($users as $user)
                <a href="{{ route('chat', $user->id) }}"
                    class="bg-52, 58, 64) p-4 rounded-lg shadow-md block hover:bg-gray-200">
                    <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                    <p>{{ $user->email }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection
