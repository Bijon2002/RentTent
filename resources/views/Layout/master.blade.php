<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="theme-color" content="#0a1f3d">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <title>@yield('title', 'RentTent')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
  
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <!-- Custom CSS -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
  
  <!-- Mobile Responsive CSS -->
  <link href="{{ asset('css/responsive.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/mobile-utilities.css') }}" rel="stylesheet" />

  <!-- Favicon -->
  <link rel="icon" href="{{ asset('favicon.ico') }}">
  
  @stack('styles')

  <style>
    /* 💎 Loader Styles */
    #loader {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      backdrop-filter: blur(8px); /* blur background */
      background: rgba(10, 31, 61, 0.4); /* semi-transparent overlay */
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 99999;
      transition: opacity 0.8s ease, visibility 0.8s ease;
    }

    /* Diamond wrapper for 3D flip */
    .diamond {
      width: 120px;
      height: 120px;
      perspective: 1000px; /* 3D perspective */
    }

    .diamond-inner {
      width: 100%;
      height: 100%;
      position: relative;
      transform-style: preserve-3d;
      animation: flip-card 2s infinite linear;
      border: 2px solid #4da6ff; /* thin neon border */
      border-radius: 12px;
      box-shadow: 0 0 20px rgba(77,166,255,0.6);
      background: transparent; /* no square background */
    }

    .diamond-front, .diamond-back {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      backface-visibility: hidden; /* hide when flipped */
    }

    .diamond-back {
      transform: rotateY(180deg); /* rotate back side */
    }

    .diamond-inner img {
      width: 70px;
    }

    @keyframes flip-card {
      0% { transform: rotateY(0deg); }
      50% { transform: rotateY(180deg); }
      100% { transform: rotateY(360deg); }
    }

    #loader.hidden {
      opacity: 0;
      visibility: hidden;
    }

    /* Chatbot button */
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
      box-shadow: 0 2px 8px rgba(0,0,0,0.12);
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      transition: transform 0.18s cubic-bezier(0.4,0.2,0.2,1);
    }

    #chatbot-float-btn:hover {
      transform: translateY(-7px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.25);
    }

    .animated-gradient-bg {
      background: rgb(16, 22, 58) !important;
    }

    /* Change headings to yellow */
    h2, h3, h4 {
      color: #FFD600 !important;
    }
    .renttent-title, .renttent-heading, .renttent-section-title {
      color: #FFD600 !important;
    }
    /* Add styles for Room Suggestions and Food Vendor Suggestions headings */
    .room-suggestions-title, .food-vendor-suggestions-title {
      color: #fff !important;
    }
  </style>
</head>
<body class="d-flex flex-column min-vh-100 animated-gradient-bg">

  <!-- 💎 Loader -->
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

  {{-- Navbar --}}
  @include('includes.navbar')

  {{-- Slideshow --}}
  @yield('slideshow')

  {{-- Features --}}
  @include('includes.features')

  {{-- Main Content --}}
  <main class="flex-grow-1 position-relative my-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
          @yield('content')
        </div>
      </div>
    </div>
  </main>

  {{-- Footer --}}
  @include('includes.footer')

  {{-- Scripts --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  @stack('scripts')

  <!-- Floating Chatbot Button -->
  <button id="chatbot-float-btn" title="Chatbot">
    <img src="{{ asset('img/bott.gif') }}" alt="Chatbot" style="width: 54px; height: 54px;">
  </button>

  <!-- Chat Window with Botpress iframe -->
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

  <script>
    // Loader fade-out after page loads
    window.addEventListener("load", function() {
      const loader = document.getElementById("loader");
      loader.classList.add("hidden");
    });

    // Chatbot toggle
    const chatWindow = document.getElementById('chat-window');
    const chatBtn = document.getElementById('chatbot-float-btn');
    const chatClose = document.getElementById('close-chat');
    chatBtn.addEventListener('click', () => {
      chatWindow.style.display = chatWindow.style.display === 'flex' ? 'none' : 'flex';
    });
    chatClose.addEventListener('click', () => {
      chatWindow.style.display = 'none';
    });
  </script>
</body>
</html>
