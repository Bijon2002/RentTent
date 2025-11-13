<div class="fullscreen-slideshow w-100">
  <!-- Slides Container -->
  <div class="slides-container position-relative w-100 h-100" style="overflow: hidden;">
    <!-- Slide 1 -->
    <div class="slide position-absolute w-100 h-100" 
         style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1478131143081-80f7f84ca84d?w=1600&q=80') center/cover;">
      <div class="content position-absolute slide-content slide-content-first">
        <h2 class="text-white display-4 fw-bold mb-3 neon-text">Premium Camping</h2>
        <p class="text-light-blue fs-3">Luxury tents with premium amenities</p>
      </div>
    </div>

    <!-- Slide 2 -->
    <div class="slide position-absolute w-100 h-100" 
         style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600&q=80') center/cover;">
      <div class="content position-absolute slide-content slide-content-right">
        <h2 class="text-white display-4 fw-bold mb-3 neon-text">Gourmet Food</h2>
        <p class="text-light-blue fs-3">From top local vendors</p>
      </div>
    </div>

    <!-- Slide 3 -->
    <div class="slide position-absolute w-100 h-100" 
         style="background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?w=1600&q=80') center/cover;">
      <div class="content position-absolute slide-content slide-content-center">
        <h2 class="text-white display-4 fw-bold mb-3 neon-text">Comfortable Properties</h2>
        <p class="text-light-blue fs-3">Find your perfect space</p>
      </div>
    </div>
  </div>

  <!-- Permanent Tagline -->
  <div class="tagline-container position-absolute w-100 text-center" style="top: 40%; left: 50%; transform: translateX(-50%); z-index: 10;">
    <h1 class="permanent-tagline text-white display-3 fw-bold mb-0">Your Space, Your Peace</h1>
  </div>

  <!-- Neon Search Bar -->
  <div class="search-container position-absolute w-100 d-flex align-items-center justify-content-center" style="top: 50%; left: 50%; transform: translateX(-50%); z-index: 10;">
    <div class="neon-search-bar" 
         style="width: 600px; background: linear-gradient(90deg, #0a1f3d, #4da6ff, #0a1f3d); background-size: 200% 100%; animation: gradientFlow 6s ease-in-out infinite;">
      <form class="d-flex h-100">
        <input type="text" class="form-control border-0 py-2 px-4 bg-dark text-white search-input" 
               placeholder="Search vendors, properties, services..." 
               style="color: white !important;">
        <button class="btn btn-neon py-2 px-4 text-white fw-bold search-btn" style="letter-spacing: 1px;">
          <i class="fas fa-search me-2"></i>SEARCH
        </button>
      </form>
    </div>
  </div>
</div>

@push('styles')
<style>
  .fullscreen-slideshow {
   height: calc(122vh - 1cm - 60px); /* reduced height by 1cm */
   margin-top: calc(-1 * (1cm + 60px)); /* adjust margin to match height change */
   position: relative; /* ensure stacking context */
   overflow: hidden;
  }
  
  /* New container for slides */
  .slides-container {
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
  }
  
  .slide {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 1.2s cubic-bezier(0.65, 0, 0.35, 1);
    z-index: 0;
    transform: translateX(100%);
  }
  
  /* Active slide */
  .slide.active {
    transform: translateX(0);
    z-index: 2;
  }
  
  /* Previous slide */
  .slide.prev {
    transform: translateX(-100%);
    z-index: 1;
  }
  
  /* Next slide (preparing to enter) */
  .slide.next {
    transform: translateX(100%);
    z-index: 0;
  }
  
  .neon-text {
    text-shadow: 0 0 10px rgba(77, 166, 255, 0.8),
                 0 0 20px rgba(77, 166, 255, 0.6);
  }
  .text-light-blue {
    color: #4da6ff;
    text-shadow: 0 0 8px rgba(77, 166, 255, 0.5);
  }
  .permanent-tagline {
    text-shadow: 0 0 15px rgba(77, 166, 255, 0.8),
                 0 0 30px rgba(77, 166, 255, 0.6),
                 0 0 45px rgba(77, 166, 255, 0.4);
    animation: taglineGlow 3s ease-in-out infinite alternate;
  }
  @keyframes taglineGlow {
    0% { text-shadow: 0 0 15px rgba(77, 166, 255, 0.8),
                      0 0 30px rgba(77, 166, 255, 0.6),
                      0 0 45px rgba(77, 166, 255, 0.4); }
    100% { text-shadow: 0 0 20px rgba(77, 166, 255, 1),
                        0 0 40px rgba(77, 166, 255, 0.8),
                        0 0 60px rgba(77, 166, 255, 0.6); }
  }
  .neon-search-bar {
    border-radius: 50px;
    padding: 3px;
    box-shadow: 0 0 30px rgba(77, 166, 255, 0.5);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .neon-search-bar:hover {
    box-shadow: 0 0 40px rgba(77, 166, 255, 0.7);
    transform: translateY(-1px);
  }
  .search-input {
    border-radius: 47px 0 0 47px;
    box-shadow: 0 0 20px rgba(77, 166, 255, 0.7);
    transition: all 0.3s ease;
    font-size: 14px;
  }
  .search-btn {
    border-radius: 0 47px 47px 0;
    background: linear-gradient(135deg, #4da6ff, #3a8de0);
    box-shadow: 0 0 20px rgba(77, 166, 255, 0.7);
    border: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
    font-size: 14px;
  }
  .search-btn:hover {
    box-shadow: 0 0 30px rgba(77, 166, 255, 0.9);
    background: linear-gradient(135deg, #5bb3ff, #4a9cf0);
  }
  .search-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
      transparent, 
      rgba(255, 255, 255, 0.4), 
      transparent);
    transition: left 0.5s ease;
  }
  .search-btn:hover::before {
    left: 100%;
  }
  @keyframes gradientFlow {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }
  @keyframes shine {
    0% { left: -50%; }
    25% { left: 100%; }
    100% { left: 100%; }
  }
  .form-control:focus {
    box-shadow: 0 0 25px rgba(77, 166, 255, 0.8) !important;
    background-color: rgba(10, 31, 61, 0.9) !important;
    border: none !important;
  }
  .search-input::placeholder {
    color: rgba(255, 255, 255, 0.8) !important;
  }
  .search-input::-webkit-input-placeholder {
    color: rgba(255, 255, 255, 0.8) !important;
  }
  .search-input::-moz-placeholder {
    color: rgba(255, 255, 255, 0.8) !important;
  }
  
  /* Laptop Screen Height Adjustment */
  @media (min-width: 1024px) and (max-width: 1366px) {
    .fullscreen-slideshow {
      height: calc(142vh - 2cm - 60px); /* laptop specific height reduced by 8cm total */
    }
  }
  
  /* Responsive slide content positioning */
  .slide-content {
    bottom: 25%;
    left: 10%;
    max-width: 600px;
  }
  
  /* First slide specific positioning */
  .slide-content-first {
    bottom: 4% !important;
  }
  
  .slide-content-first .neon-text {
    font-size: 2.5rem !important;
  }
  
  .slide-content-first .text-light-blue {
    font-size: 1.4rem !important;
  }
  
  /* Laptop screen first slide positioning */
  @media (min-width: 1024px) and (max-width: 1366px) {
    .slide-content-first {
      bottom: 7% !important;
    }
  }
  
  .slide-content-right {
    left: auto;
    right: 10%;
    text-align: right;
  }
  
  .slide-content-center {
    left: 50%;
    transform: translateX(-50%);
    text-align: center;
    max-width: 700px;
  }
  
  /* Responsive design for different screen sizes */
  @media (max-width: 1200px) {
    .slide-content, .slide-content-right {
      max-width: 500px;
    }
    .slide-content-center {
      max-width: 600px;
    }
  }
  
  /* Laptop Screen Specific (1024px - 1366px) */
  @media (min-width: 1024px) and (max-width: 1366px) {
    .slide-content, .slide-content-right {
      max-width: 400px;
      bottom: 15%;
    }
    .slide-content-center {
      max-width: 500px;
      bottom: 15%;
    }
    .permanent-tagline {
      font-size: 2.8rem !important;
    }
    .neon-text {
      font-size: 2.5rem !important;
    }
    .text-light-blue {
      font-size: 1.6rem !important;
    }
    .tagline-container {
      top: 40.5% !important;
    }
    .search-container {
      top: 50.5% !important;
    }
  }
  
  @media (max-width: 992px) {
    .slide-content, .slide-content-right {
      max-width: 350px;
      bottom: 35%;
    }
    .slide-content-center {
      max-width: 450px;
      bottom: 35%;
    }
    .neon-search-bar {
      width: 500px !important;
    }
    .permanent-tagline {
      font-size: 2.2rem !important;
    }
    .neon-text {
      font-size: 2.2rem !important;
    }
    .text-light-blue {
      font-size: 1.4rem !important;
    }
    .tagline-container {
      top: 50% !important;
    }
    .search-container {
      top: 65% !important;
    }
  }
  
  @media (max-width: 768px) {
    .slide-content, .slide-content-right {
      max-width: 280px;
      bottom: 30%;
      left: 5%;
      right: 5%;
    }
    .slide-content-center {
      max-width: 320px;
      bottom: 30%;
    }
    .neon-search-bar {
      width: 90% !important;
      max-width: 400px !important;
    }
    .permanent-tagline {
      font-size: 1.8rem !important;
    }
    .neon-text {
      font-size: 1.6rem !important;
    }
    .text-light-blue {
      font-size: 1.1rem !important;
    }
    .tagline-container {
      top: 45% !important;
    }
    .search-container {
      top: 60% !important;
    }
  }
  
  @media (max-width: 576px) {
    .slide-content, .slide-content-right {
      max-width: 250px;
      bottom: 20%;
      left: 3%;
      right: 3%;
    }
    .slide-content-center {
      max-width: 280px;
      bottom: 20%;
    }
    .neon-search-bar {
      width: 95% !important;
      max-width: 350px !important;
    }
    .permanent-tagline {
      font-size: 1.5rem !important;
    }
    .neon-text {
      font-size: 1.5rem !important;
    }
    .text-light-blue {
      font-size: 1rem !important;
    }
    .search-input, .search-btn {
      padding: 0.5rem 1rem !important;
      font-size: 14px !important;
    }
    .tagline-container {
      top: 35% !important;
    }
    .search-container {
      top: 50% !important;
    }
  }
  
  @media (max-width: 480px) {
    .slide-content, .slide-content-right {
      max-width: 200px;
      bottom: 15%;
    }
    .slide-content-center {
      max-width: 220px;
      bottom: 15%;
    }
    .neon-search-bar {
      width: 98% !important;
      max-width: 300px !important;
    }
    .permanent-tagline {
      font-size: 1.3rem !important;
    }
    .neon-text {
      font-size: 1.3rem !important;
    }
    .text-light-blue {
      font-size: 0.9rem !important;
    }
    .tagline-container {
      top: 30% !important;
    }
    .search-container {
      top: 45% !important;
    }
  }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const slides = document.querySelectorAll('.slide');
  let currentSlide = 0;
  let slideCount = slides.length;

  if (slideCount) {
    // Initialize slides
    slides[0].classList.add('active');
    for (let i = 1; i < slideCount; i++) {
      slides[i].classList.add('next');
    }
    
    setTimeout(changeSlide, 5000);
  }

  function changeSlide() {
    // Get current, next, and previous slide indices
    const nextSlide = (currentSlide + 1) % slideCount;
    const prevSlide = currentSlide;
    
    // Update classes for animation
    slides[currentSlide].classList.remove('active');
    slides[currentSlide].classList.add('prev');
    
    slides[nextSlide].classList.remove('next');
    slides[nextSlide].classList.add('active');
    
    // After animation completes, reset the previous slide
    setTimeout(() => {
      slides[prevSlide].classList.remove('prev');
      slides[prevSlide].classList.add('next');
    }, 1200); // Match the CSS transition duration
    
    // Update current slide index
    currentSlide = nextSlide;
    
    // Schedule next slide change
    setTimeout(changeSlide, 5000);
  }
});
</script>
@endpush