@extends('Layout.cmaster')

@push('styles')
<style>
  /* Override master layout background for login page */
  body.animated-gradient-bg {
    background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('img/m.png') }}') no-repeat center center fixed !important;
    background-size: cover !important;
  }
  
  /* Remove padding from main content area */
  body.animated-gradient-bg main {
    padding: 0 !important;
  }
  
  /* Make login page take full width */
  .login-page-wrapper {
    min-height: calc(100vh - 200px);
    width: 100%;
    padding-top: 4cm;
    padding-bottom: 2cm;
  }
  
  .login-page-wrapper .container {
    position: relative;
  }
</style>
@endpush

@section('content')
<div class="login-page-wrapper d-flex justify-content-center">
  
  <!-- Floating error popup -->
  @if(session('login_error'))
  <script>
      document.addEventListener('DOMContentLoaded', function() {
          let errorMsg = "{{ session('login_error') }}";
          let alertDiv = document.createElement('div');
          alertDiv.className = 'alert alert-danger alert-dismissible fade show position-fixed top-0 end-0 m-3';
          alertDiv.style.zIndex = 1050;
          alertDiv.innerHTML = `
              ${errorMsg}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
          `;
          document.body.appendChild(alertDiv);
          setTimeout(() => { alertDiv.remove(); }, 5000); // auto close after 5s
      });
  </script>
  @endif

  <div class="container">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 1200px; width:100%; margin: 0 auto;">
      <div class="row g-0">
        <!-- Left Section (Form) -->
        <div class="col-md-6 p-5 bg-transparent" style="height: 600px; overflow-y: auto; background: transparent;">
          <div class="text-center mb-4">
            <h2 class="fw-bold">Welcome Back</h2>
            <p class="text-muted">Sign in to your account</p>
          </div>

          <!-- Login Form -->
          <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="elitrekker@gmail.com" 
                     value="{{ old('email') }}" required autofocus>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-check mb-3">
              <input type="checkbox" class="form-check-input" id="remember" name="remember" 
                     {{ old('remember') ? 'checked' : '' }}>
              <label for="remember" class="form-check-label">Remember me</label>
            </div>
            <button type="submit" class="btn btn-dark w-100">Login</button>
          </form>

          <div class="text-center mt-3">
            <a href="{{ route('register') }}" class="text-decoration-none">Don't have an account? Sign up</a>
          </div>
        </div>

        <!-- Right Section (Slideshow) -->
        <div class="col-md-6 d-none d-md-block position-relative">
          <div id="loginCarousel" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
              <div class="carousel-item active h-100">
                <img src="{{ asset('assets/images/slide01.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 1">
              </div>
              <div class="carousel-item h-100">
                <img src="{{ asset('assets/images/food.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 2">
              </div>
              <div class="carousel-item h-100">
                <img src="{{ asset('assets/images/park.jpeg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
              </div>
              <div class="carousel-item h-100">
                <img src="{{ asset('assets/images/yog.jpg') }}" class="d-block w-100 h-100 object-fit-cover" alt="Slide 4">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#loginCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#loginCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>

          <!-- Overlay Text -->
          <div class="position-absolute top-0 start-0 p-4 text-white">
            <h5 class="fw-bold">Welcome Back to RentTent!</h5>
            <p style="max-width: 250px;">Sign in and continue your journey with personalized experiences.</p>
          </div>
          <div class="position-absolute bottom-0 start-0 p-4 text-white">
            <h5 class="fw-bold">Adventure Awaits!</h5>
            <button class="btn btn-light btn-sm mt-2">Start exploring now!</button>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection
