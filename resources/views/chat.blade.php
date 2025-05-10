<!-- resources/views/chat.blade.php -->
@extends($userLayout)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Chat Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Chat Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid ">
            <div class="col-lg-8 col-12" id="app">
                <chat-component :user="{{ $user }}" :current-user="{{ auth()->user() }}"></chat-component>
            </div>
        </div>
        </div>
    </section>
@endsection
