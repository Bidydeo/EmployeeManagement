<x-guest-layout>
    <div class="register-box">
        <div class="register-logo">
          <a href="../../index2.html"><b>NEO</b>App</a>
        </div>
      
        <div class="card">
          <div class="card-body register-card-body" style="padding-bottom: 0;">
            <p class="login-box-msg">Register a new user</p>
      
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="input-group mb-3">
                <input type="text" class="form-control" type="text" name="username" id="username" placeholder="Add a username">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" type="text" name="employee_name" id="name" placeholder="Add a name">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="text" class="form-control" type="text" name="employee_lastname" id="lastname" placeholder="Add a lastname">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Retype password">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                  </div>
                </div>
              </div>
              {{-- <div class="input-group mb-3">
                <input type="text" class="form-control" name="sba_name" id="sba_name" placeholder="Select sba_name">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="input-group mb-3">
                <input type="file" class="form-control" name="avatar" id="avatar" placeholder="Input avatar">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-user"></span>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-8">
                  <div class="icheck-primary">
                    <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                    <label for="agreeTerms">
                     I agree to the <a href="#">terms</a>
                    </label>
                  </div>
                </div> --}}
                <!-- /.col -->
                <div class="col-12">
                  <button type="submit" class="btn btn-primary btn-block ">Register</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
      
            {{-- <div class="social-auth-links text-center" style="padding:0 20 0 20;">
              <p>- OR -</p>
              <a href="#" class="btn btn-block btn-primary">
                <i class="fab fa-facebook mr-2"></i>
                Sign up using Facebook
              </a>
              <a href="#" class="btn btn-block btn-danger">
                <i class="fab fa-google-plus mr-2"></i>
                Sign up using Google+
              </a>
            </div> --}}
      
            <a href="{{ route('login') }}" class="text-center mb-3">I am already a user</a>
          </div>
          <!-- /.form-box -->
        </div><!-- /.card -->
      </div>
      <!-- /.register-box -->
</x-guest-layout>
