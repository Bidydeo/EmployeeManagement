<!-- resources/views/chat.blade.php -->
@extends($userLayout)
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            @include('partials.header-breadcrumbs', [
                'pageTitle' => 'Chat',
                'breadcrumbs' => [['label' => 'Chat', 'active' => true]],
            ])
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
