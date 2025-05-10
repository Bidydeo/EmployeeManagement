  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
          </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Navbar Search -->
          <li class="nav-item">
              <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                  <i class="fas fa-search"></i>
              </a>
              <div class="navbar-search-block">
                  <form class="form-inline">
                      <div class="input-group input-group-sm">
                          <input class="form-control form-control-navbar" type="search" placeholder="Search"
                              aria-label="Search">
                          <div class="input-group-append">
                              <button class="btn btn-navbar" type="submit">
                                  <i class="fas fa-search"></i>
                              </button>
                              <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                  <i class="fas fa-times"></i>
                              </button>
                          </div>
                      </div>
                  </form>
              </div>
          </li>
          <!-- Messages Dropdown Menu -->
          @if ($usersWithUnreadMessages->count() > 0)
              <li class="nav-item dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">
                      <i class="far fa-comments"></i>
                      @if (Auth::user()->messages_receiver->where('is_read', false)->count() > 0)
                          <span
                              class="badge badge-danger navbar-badge">{{ Auth::user()->messages_receiver->where('is_read', false)->count() }}</span>
                      @endif
                  </a>
                  <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                      <!-- Message Start -->
                      @foreach ($usersWithUnreadMessages as $user)
                          <a href="/chat/{{ $user->id }}" class="dropdown-item">
                              <div class="media">
                                  @php
                                      $unreadCount = $user->messages_sender->where('is_read', false)->count();
                                  @endphp

                                  @if ($unreadCount > 0)
                                      <span class="badge badge-danger navbar-badge">{{ $unreadCount }}</span>
                                  @endif

                                  <img src="/storage/users_avatar/{{ $user->avatar }}" alt="{{ $user->name }}"
                                      class="img-size-50 mr-3 img-circle">

                                  <div class="media-body">
                                      <h3 class="dropdown-item-title">
                                          {{ $user->name }}
                                          <p class="text-sm text-muted">
                                              <i class="far fa-clock mr-1"> Last seen:</i>
                                              {{ $user->last_active ? $user->last_active->diffForHumans() : 'Inactive' }}
                                          </p>
                                      </h3>
                                      <p class="text-sm">
                                          Message: {{ optional($user->last_unread_message)->text ?? 'No messages yet' }}
                                          <span class="ml-1">
                                              ({{ $user->last_unread_message->created_at->diffForHumans() }})
                                          </span>
                                      </p>
                                  </div>
                              </div>
                          </a>
                          <div class="dropdown-divider"></div>
                      @endforeach
                      <a href="/contacts" class="dropdown-item dropdown-footer">See All Messages</a>
                  </div>
              </li>
          @endif
          <!-- Notifications Dropdown Menu -->
          <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="dropdown" href="#">
                  <i class="far fa-bell"></i>
                  <span class="badge badge-warning navbar-badge">15</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">15 Notifications</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-envelope mr-2"></i> 4 new messages
                      <span class="float-right text-muted text-sm">3 mins</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-users mr-2"></i> 8 friend requests
                      <span class="float-right text-muted text-sm">12 hours</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <i class="fas fa-file mr-2"></i> 3 new reports
                      <span class="float-right text-muted text-sm">2 days</span>
                  </a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
              </div>
          </li>
          <li class="nav-item">
              <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                  <i class="fas fa-expand-arrows-alt"></i>
              </a>
          </li>
          <li class="nav-item">
              <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <span class="user-img " style="display: inline-flex; align-items: center;">
                      <img src="{{ URL::to('/storage/users_avatar/' . Auth::user()->avatar) }}"
                          alt="{{ Auth::user()->name }}" width="20" height="20" class="img-circle elevation-2"
                          style="margin-right: 5px;">
                      <span class="status online"></span>
                      <span>{{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <span class="dropdown-item dropdown-header">You are logged as {{ Auth::user()->name }}</span>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item">
                      <form method="POST" action="{{ route('logout') }}">
                          @csrf
                          <i class="fas fa-user mr-2"></i>
                          <span :href="{{ route('logout') }}"
                              onclick="event.preventDefault();
                                                            this.closest('form').submit();">
                              {{ __('Log Out') }}
                          </span>
                      </form>
                  </a>
                  <div class="dropdown-divider"></div>
                    @role('Super Admin')
                        <a href="/admin/profile" class="dropdown-item">
                    @endrole
                    @unlessrole('Super Admin')
                        <a href="/profile" class="dropdown-item">
                    @endunlessrole
                          <i class="fas fa-envelope mr-2"></i>{{ Auth::user()->name }} profile
                          <span
                              class="float-right text-muted text-sm">{{ Auth::user()->created_at->diffforHumans() }}</span>
                      </a>
              </div>
          </li>
      </ul>
  </nav>
  <!-- /.navbar -->
