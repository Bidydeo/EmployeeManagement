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
                <div class="card card-primary card-outline direct-chat direct-chat-primary direct-chat-contacts-open">
                    <div class="card-header">
                        <h3 class="card-title">Select a user to chat with</h3>
                        <div class="card-tools">
                            <span data-toggle="tooltip"
                                title="{{ Auth()->user()->messages_receiver->where('is_read', 0)->count() }} New Messages"
                                class="badge badge-light">{{ Auth()->user()->messages_receiver->where('is_read', false)->count() }}</span>
                            <button type="button" class="btn btn-tool" data-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Contacts"
                                data-widget="chat-pane-toggle">
                                <i class="fas fa-comments"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-widget="remove"><i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <ul class="contacts-list ">
                                @foreach ($users as $user)
                                    <li>
                                        <a href="/chat/{{ $user->id }}">
                                            <img class="contacts-list-img" src="/storage/users_avatar/{{ $user->avatar }}">
                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    {{ $user->name }}
                                                    <small class="contacts-list-date float-right">
                                                        @if ($user->last_active)
                                                            {{ $user->last_active->diffForHumans() }}
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </small>
                                                </span>
                                                <span class="contacts-list-msg">
                                                    @if ($user->messages_sender->isNotEmpty() && $user->messages_sender->last()->text != null)
                                                        {{ $user->messages_sender->last()->text }}
                                                    @else
                                                        No messages yet
                                                    @endif
                                                </span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                @endforeach
                                <!-- End Contact Item -->
                            </ul>
                        </div>
                        <!--/.direct-chat-messages-->
                        <!-- Contacts are loaded here -->
                        <div class="direct-chat-contacts">
                            <ul class="contacts-list">
                                @foreach ($users as $user)
                                    <li>
                                        <a href="/chat/{{ $user->id }}">
                                            <img class="contacts-list-img" src="/storage/users_avatar/{{ $user->avatar }}">
                                            <div class="contacts-list-info">
                                                <span class="contacts-list-name">
                                                    {{ $user->name }}
                                                    <small class="contacts-list-date float-right">
                                                        @if ($user->last_active)
                                                            {{ $user->last_active->diffForHumans() }}
                                                        @else
                                                            Inactive
                                                        @endif
                                                    </small>
                                                </span>
                                                <span class="contacts-list-msg">
                                                    @if ($user->messages_sender->isNotEmpty() && $user->messages_sender->last()->text != null)
                                                        {{ $user->messages_sender->last()->text }}
                                                    @else
                                                        No messages yet
                                                    @endif
                                                </span>
                                            </div>
                                            <!-- /.contacts-list-info -->
                                        </a>
                                    </li>
                                @endforeach
                                <!-- End Contact Item -->
                            </ul>
                            <!-- /.contacts-list -->
                        </div>
                        <!-- /.direct-chat-pane -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-footer-->
                </div>
                <!--/.direct-chat -->
            </div>
        </div>
        </div>
    </section>
@endsection
