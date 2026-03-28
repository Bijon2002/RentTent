@php
use Illuminate\Support\Facades\Auth;

// Get user safely
$userSession = session('user');
$user = $userSession ? (object) $userSession : Auth::user();

// Safe helpers
$profilePic = isset($userSession['profile_pic']) ? asset('storage/profile_pics/' . basename($userSession['profile_pic'])) 
               : ($user && $user->profile_pic ? asset('storage/profile_pics/' . basename($user->profile_pic)) 
               : asset('img/default-user.png'));

$role = isset($userSession['role']) ? $userSession['role'] : ($user->role ?? null);
@endphp

<nav class="navbar navbar-expand-lg custom-navbar floating-navbar">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
      <img src="{{ asset('img/logo2.png') }}" alt="RentTent Logo" class="me-2 rounded-circle" style="width: 32px; height: 32px;">
      <span class="logo-text">RentTent</span>
    </a>

    <!-- Mobile Toggle -->
    <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu Items -->
    <div class="collapse navbar-collapse justify-content-center" id="mainNavbar">
      <ul class="navbar-nav gap-lg-4">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}"><i class="bi bi-house-door"></i> Home</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/properties') }}"><i class="bi bi-building"></i> Properties</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/foodplans') }}"><i class="bi bi-egg-fried"></i> Food Plans</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/about') }}"><i class="bi bi-person"></i> About Us</a></li>
      </ul>
    </div>

    <!-- Right Buttons / Profile + Language -->
    <div class="d-flex gap-2 align-items-center">
      <!-- Language Selector -->
      <select id="languageSelect" class="form-select form-select-sm">
        <option value="en" selected>English</option>
        <option value="ta">தமிழ்</option>
        <option value="si">සිංහල</option>
      </select>

      @if($user)
        <div class="dropdown">
          <!-- Profile with Neon Circle -->
          <a class="d-flex align-items-center position-relative" href="{{ route('profile') }}" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 5px;">
              <span style="
                  position: absolute;
                  top: 50%; left: 50%;
                  transform: translate(-50%, -50%);
                  width: 50px; height: 50px;
                  border-radius: 50%;
                  border: 2px solid #4da6ff;
                  box-shadow: 0 0 8px #4da6ff, 0 0 16px rgba(77,166,255,0.3);
                  z-index: 0;
              "></span>

              <img src="{{ $profilePic }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover; position: relative; z-index: 1;">
          </a>

          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
            @if($role === 'provider')
              <li><a class="dropdown-item" href="{{ route('provider.options') }}">Provider Options</a></li>
            @elseif($role === 'vendor')
              <li><a class="dropdown-item" href="{{ route('vendor.options') }}">Vendor Options</a></li>
            @endif
            <li>
              <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
              </form>
            </li>
          </ul>
        </div>
      @else
        <a href="{{ route('register') }}" class="btn signup-btn">Signup</a>
        <a href="{{ route('login') }}" class="btn login-btn">Login</a>
      @endif
    </div>
  </div>
</nav>

<!-- Styles -->
<style>
  .floating-navbar {
    position: fixed; top: 1cm; left: 0; right: 0; width: 100%;
    max-width: 1200px; height: 75px; border-radius: 12px; margin: 0 auto;
    z-index: 1030; box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    background: rgba(0,5,15,0.45) !important; backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
  }
  @media (min-width: 1367px) { .floating-navbar { max-width: 1400px; } }
  @media (min-width: 2560px) { 
    .floating-navbar { max-width: 1800px; height: 90px; } 
    .logo-text { font-size: 1.6rem !important; } .nav-link { font-size: 1.1rem !important; }
    .signup-btn, .login-btn { font-size:1.1rem !important; padding:0.6rem 1.5rem !important; }
  }
  
  /* Mobile Navbar Improvements */
  @media (max-width: 991px) {
    .floating-navbar {
      top: 0;
      border-radius: 0;
      margin: 0;
      max-width: 100%;
      height: auto;
      min-height: 70px;
      padding: 0.5rem 0;
    }
    
    .navbar-brand img {
      width: 28px;
      height: 28px;
    }
    
    .logo-text {
      font-size: 1.1rem !important;
    }
    
    .navbar-collapse {
      background: rgba(0, 5, 15, 0.95);
      backdrop-filter: blur(10px);
      margin-top: 1rem;
      padding: 1rem;
      border-radius: 8px;
      max-height: 70vh;
      overflow-y: auto;
    }
    
    .navbar-nav {
      gap: 0 !important;
    }
    
    .nav-link {
      padding: 0.75rem 0 !important;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      font-size: 1rem;
      justify-content: flex-start;
    }
    
    .nav-link:last-child {
      border-bottom: none;
    }
    
    .navbar-toggler {
      border: 1px solid rgba(255, 255, 255, 0.3);
      padding: 0.5rem 0.75rem;
    }
    
    .navbar-toggler-icon {
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    }
    
    #languageSelect {
      font-size: 0.8rem;
      padding: 0.3rem 0.6rem;
      margin-bottom: 0.5rem;
    }
    
    .signup-btn,
    .login-btn {
      display: block;
      width: 100%;
      margin-top: 0.5rem;
      text-align: center;
    }
    
    .d-flex.gap-2.align-items-center {
      flex-direction: column;
      align-items: stretch !important;
      gap: 0.5rem !important;
    }
    
    .dropdown-menu {
      position: static !important;
      transform: none !important;
      width: 100%;
      margin-top: 0.5rem;
    }
  }
  
  .floating-navbar .container { display:flex; justify-content:space-between; align-items:center; height:100%; padding:0 1rem; }
  .navbar-brand img { border:1px solid rgba(100,200,255,0.3); transition: all 0.3s ease; }
  .logo-text { font-weight:700; font-size:1.3rem; color:white; transition: all 0.3s ease; }
  .nav-link { color: rgba(255,255,255,0.8)!important; font-weight:500; display:flex; align-items:center; gap:0.4rem; transition:all 0.3s ease; padding:0.5rem 0; position:relative; }
  .nav-link::after { content:''; position:absolute; bottom:0; left:0; width:0; height:1px; background:#4da6ff; transition: all 0.3s ease; }
  .nav-link:hover { color: rgba(255,255,255,0.9)!important; }
  .nav-link:hover::after { width:100%; }
  .signup-btn { background:transparent; border:1px solid rgba(100,200,255,0.3); color:white; border-radius:50px; padding:0.5rem 1.2rem; }
  .signup-btn:hover { background: rgba(77,166,255,0.1); border-color:#4da6ff; color:#4da6ff; }
  .login-btn { background: rgba(0,150,255,0.2); color:white; border-radius:50px; padding:0.5rem 1.2rem; border:1px solid rgba(0,200,255,0.3); }
  .login-btn:hover { background: rgba(77,166,255,0.2); border-color:#4da6ff; color:#4da6ff; }
  .dropdown-menu {
    min-width: 150px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.25);
    background: rgba(0, 5, 15, 0.45) !important;
    backdrop-filter: blur(3px);
    -webkit-backdrop-filter: blur(3px);
    border: 1px solid rgba(100,200,255,0.15);
    transition: background 0.3s cubic-bezier(.4,0,.2,1);
  }
  .dropdown-item {
    transition: background 0.3s ease, color 0.3s ease;
    color: rgba(255,255,255,0.85);
  }
  .dropdown-item:hover {
    background: rgba(77,166,255,0.15);
    color: #4da6ff;
  }
  #languageSelect {
    background: rgba(0,5,15,0.6);
    color: white;
    border-radius: 8px;
    border: 1px solid rgba(77,166,255,0.5);
    padding: 0.2rem 0.5rem;
    font-size: 0.85rem;
  }

  /* Ensure action buttons and select align vertically */
  .floating-navbar .d-flex.gap-2.align-items-center > .form-select,
  .floating-navbar .d-flex.gap-2.align-items-center > .btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    padding-top: 0;
    padding-bottom: 0;
  }

  .floating-navbar .signup-btn, .floating-navbar .login-btn {
    line-height: 1;
    margin: 0;
  }

  /* Small tweak: make select match button height exactly */
  .floating-navbar .d-flex.gap-2.align-items-center > .form-select {
    padding: 0 0.5rem;
  }
</style>
