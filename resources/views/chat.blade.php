<!-- resources/views/chat.blade.php -->
@extends('layouts.master')
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
                {{-- <div class="card card-primary card-outline direct-chat direct-chat-primary direct-chat-contacts-open"> --}}
                {{-- <div class="card-header">
                        <h3 class="card-title">Select a user to chat with</h3>
                        <div class="card-tools">
                            <span data-toggle="tooltip" title="3 New Messages" class="badge badge-light">unread
                                messages??</span>
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
                    </div> --}}
                <!-- /.card-header -->
                {{-- <div class="card-body">
                        <!-- Conversations are loaded here -->
                        <div class="direct-chat-messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left">Alexander Pierce</span>
                                    <span class="direct-chat-timestamp float-right">23 Jan 2:00 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="/docs/3.0/assets/img/user1-128x128.jpg"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    Is this template really for free? That's unbelievable!
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->
                            <!-- Message to the right -->
                            <div class="direct-chat-msg right">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right">Sarah Bullock</span>
                                    <span class="direct-chat-timestamp float-left">23 Jan 2:05 pm</span>
                                </div>
                                <!-- /.direct-chat-infos -->
                                <img class="direct-chat-img" src="/docs/3.0/assets/img/user3-128x128.jpg"
                                    alt="message user image">
                                <!-- /.direct-chat-img -->
                                <div class="direct-chat-text">
                                    You better believe it!
                                </div>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->
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
                                                    <small class="contacts-list-date float-right">last seen</small>
                                                </span>
                                                <span class="contacts-list-msg">last message..</span>
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
                    </div> --}}
                <!-- /.card-body -->
                {{-- <div class="card-footer">
                        <form action="#" method="post">
                            <div class="input-group">
                                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                                <span class="input-group-append">
                                    <button type="button" class="btn btn-primary">Send</button>
                                </span>
                            </div>
                        </form>
                    </div> --}}
                <!-- /.card-footer-->
                {{-- </div> --}}
                <!--/.direct-chat -->
            </div>
        </div>
        </div>
    </section>
@endsection
