<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes">
  <meta name="theme-color" content="#0a1f3d">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <title>@yield('title', 'User Dashboard')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Mobile Responsive CSS -->
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/mobile-utilities.css') }}" rel="stylesheet" />

  <style>
    :root {
      --sidebar-bg: rgba(10,25,41,0.7);
      --sidebar-hover: #102a43;
      --primary-accent: #3b82f6;
      --primary-accent-light: #60a5fa;
      --text-primary: #1f2937;
      --text-light: #f8fafc;
      --card-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      --transition: all 0.3s ease;
    }

    body { 
      margin: 0;
      padding: 0;
      font-family: 'Inter', sans-serif;
      color: var(--text-primary);
      background: url('{{ asset('img/m.png') }}') no-repeat center center fixed;
      background-size: cover;
    }

    .main-content {
      margin: 0;
      width: 100vw;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
      padding: 0;
    }

    .glass-card {
      background: rgba(255, 255, 255, 0.15);
      backdrop-filter: blur(10px);
      -webkit-backdrop-filter: blur(10px);
      border-radius: 16px;
      box-shadow: 0 8px 32px rgba(0,0,0,0.25);
      border: 1px solid rgba(255,255,255,0.18);
      padding: 2rem;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .glass-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 12px 40px rgba(0,0,0,0.35);
    }

    @media (max-width: 992px) {
      .sidebar { width: 80px; }
      .main-content { margin-left: 80px; width: calc(100% - 80px); }
    }
    @media (max-width: 768px) {
      .sidebar { 
        width: 0; 
        overflow: hidden; 
        transform: translateX(-100%);
      }
      .sidebar.active { 
        width: 280px;
        transform: translateX(0);
      }
      .main-content { 
        margin-left: 0 !important; 
        width: 100% !important;
        padding: 1rem !important;
      }
      .glass-card {
        padding: 1.5rem !important;
        margin: 1rem 0 !important;
      }
    }

    #chatbot-float-btn {
      position: fixed;
      bottom: 24px;
      right: 24px;
      z-index: 9999;
      background: #fff;
      border: none;
      border-radius: 30px;
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
      cursor: pointer;
      transition: transform 0.18s cubic-bezier(0.4,0.2,0.2,1);
    }
    #chatbot-float-btn:hover {
      transform: translateY(-7px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }
    
    @media (max-width: 767px) {
      #chatbot-float-btn {
        width: 50px;
        height: 50px;
        bottom: 20px;
        right: 20px;
      }
      #chatbot-float-btn img {
        width: 44px !important;
        height: 44px !important;
      }
      #chat-window {
        width: 100% !important;
        height: 80vh !important;
        bottom: 0 !important;
        right: 0 !important;
        border-radius: 12px 12px 0 0 !important;
      }
    }

    #loader {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      backdrop-filter: blur(8px);
      background: rgba(10,31,61,0.4);
      display: flex; justify-content: center; align-items: center;
      z-index: 99999;
      transition: opacity 0.8s ease, visibility 0.8s ease;
    }
    .diamond { width: 120px; height: 120px; perspective: 1000px; }
    .diamond-inner {
      width: 100%; height: 100%; position: relative; transform-style: preserve-3d;
      animation: flip-card 2s infinite linear;
      border: 2px solid #4da6ff; border-radius: 12px; box-shadow: 0 0 20px rgba(77,166,255,0.6);
      background: transparent;
    }
    .diamond-front, .diamond-back {
      position: absolute; width: 100%; height: 100%;
      display: flex; justify-content: center; align-items: center;
      backface-visibility: hidden;
    }
    .diamond-back { transform: rotateY(180deg); }
    .diamond-inner img { width: 70px; }
    @keyframes flip-card {
      0% { transform: rotateY(0deg); }
      50% { transform: rotateY(180deg); }
      100% { transform: rotateY(360deg); }
    }
    #loader.hidden { opacity: 0; visibility: hidden; }

  </style>
</head>

<body>
  {{-- Navbar --}}
  @include('Includes.navbar')

  <div class="container-fluid p-0" style="min-height:100vh;">
    <div class="row g-0" style="min-height:100vh;">
      
      <!-- Sidebar -->
      <div id="sidebar" class="sidebar d-flex flex-column justify-content-between p-3"
           style="width:5cm; background: var(--sidebar-bg); min-height:100vh; backdrop-filter: blur(8px); position: fixed; left:0; top:0; height:100vh; z-index:10; transform: translateX(-100%); transition: transform 0.3s;">
        
        <div style="margin-top:4cm;">
          <ul class="nav flex-column gap-2">
            
            <!-- Always show Profile -->
            <li class="nav-item">
              <a href="{{ route('profile') }}" 
                 class="nav-link {{ request()->routeIs('profile') ? 'fw-bold text-warning' : 'text-light' }}">
                 Profile
              </a>
            </li>

            <!-- Finder -->
            @if(auth()->check() && auth()->user()->role === 'finder')
             <li class="nav-item">
    <a href="{{ route('finder.booked.boardings') }}" class="nav-link text-light">Booked Boardings</a>
</li>
<li class="nav-item">
    <a href="{{ route('finder.subscribed.foods') }}" class="nav-link text-light">Subscribed Foods</a>
</li>

            @endif

        
  <!-- Provider -->
@if(auth()->check() && auth()->user()->role === 'provider')
  <li class="nav-item">
    <a href="{{ route('provider.boardings.index') }}" class="nav-link text-light">Manage Boarding</a>
  </li>
@endif


            <!-- Vendor -->
            @if(auth()->check() && auth()->user()->role === 'vendor')
              <li class="nav-item">
                <a href="{{ route('vendor.foods') }}" 
                   class="nav-link {{ request()->routeIs('vendor.foods') ? 'fw-bold text-warning' : 'text-light' }}">
                   Manage Food Subscriptions
                </a>
              </li>
            @endif

          </ul>
        </div>

        <div>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">Logout</button>
          </form>
        </div>
      </div>

      <!-- Main Content -->
      <div class="col-lg-9 col-md-8 main-content d-flex align-items-center justify-content-center p-4" style="margin-left:0;">
        @yield('content')
      </div>
    </div>
  </div>



  <!-- Floating Chatbot Button -->
  <button id="chatbot-float-btn" title="Chatbot">
    <img src="{{ asset('img/bott.gif') }}" alt="Chatbot" style="width: 54px; height: 54px;">
  </button>

  <!-- Chat Window -->
  <div id="chat-window" style="display:none; position:fixed; bottom:90px; right:24px; width:400px; height:500px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.2); background:#fff; z-index:9999; flex-direction:column;">
    <div id="chat-header" style="padding:10px; background:#0a2540; color:#fff; font-weight:bold; border-top-left-radius:12px; border-top-right-radius:12px;">
      RentTent Chat
      <span id="close-chat" style="float:right; cursor:pointer;">&times;</span>
    </div>
    <iframe
      id="chat-iframe"
      src="https://cdn.botpress.cloud/webchat/v3.3/shareable.html?configUrl=https://files.bpcontent.cloud/2025/09/05/07/20250905073149-I99PXM74.json&clientId=abe605af-5da9-4952-86a9-b31bb360f547"
      style="flex:1; border:none; border-bottom-left-radius:12px; border-bottom-right-radius:12px;">
    </iframe>
  </div>

  <!-- Loader -->
  <div id="loader">
    <div class="diamond">
      <div class="diamond-inner">
        <div class="diamond-front">
          <img src="{{ asset('img/logo2.png') }}" alt="Logo">
        </div>
        <div class="diamond-back">
          <img src="{{ asset('img/logo2.png') }}" alt="Logo">
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    window.addEventListener("load", function() {
      document.getElementById("loader").classList.add("hidden");
    });

    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    if(sidebarToggle && sidebar){
      sidebarToggle.addEventListener('click', () => {
        sidebar.style.transform = (sidebar.style.transform === 'translateX(0%)') ? 'translateX(-100%)' : 'translateX(0%)';
      });
    }

    const chatWindow = document.getElementById('chat-window');
    const chatBtn = document.getElementById('chatbot-float-btn');
    const chatClose = document.getElementById('close-chat');

    chatBtn.addEventListener('click', () => {
      chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
    });

    chatClose.addEventListener('click', () => { chatWindow.style.display = 'none'; });
  </script>
     @stack('scripts')
</body>
</html>
