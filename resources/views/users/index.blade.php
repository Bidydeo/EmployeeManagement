@extends($userLayout)
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'List all users',
                'breadcrumbs' => [['label' => 'List all users', 'active' => true]],
            ])
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid ">
            @foreach ($users as $user)
                <a href="{{ route('chat', $user->id) }}" class="bg-gray-100 p-4 rounded-lg shadow-md block hover:bg-gray-200">
                    <h3 class="text-lg font-semibold">{{ $user->name }}</h3>
                    <p>{{ $user->email }}</p>
                </a>
            @endforeach
        </div>
    </section>
@endsection
