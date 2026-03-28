<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-dark-blue text-white pt-5 pb-4" data-aos="fade-up" data-aos-duration="900">
  <div class="container">
    <div class="row g-4 g-md-4">
      <!-- Logo + Description -->
      <div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
        <div class="d-flex align-items-center mb-3">
          <img src="{{ asset('img/logo2.png') }}" alt="RentTent Logo" class="me-2" style="height:40px;" />
          <span class="text-white fw-bold fs-4" style="letter-spacing: 1px;">RentTent</span>
        </div>
        <p class="text-white-50 mb-4">Discover your perfect getaways with RentTent., We offer premium properties and food plans for unforgettable experiences in nature's lap..</p>
        <div class="social-icons d-flex gap-3">
          <a href="#" class="social-icon facebook rounded-circle d-flex align-items-center justify-content-center">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="social-icon twitter rounded-circle d-flex align-items-center justify-content-center">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="social-icon instagram rounded-circle d-flex align-items-center justify-content-center">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="social-icon linkedin rounded-circle d-flex align-items-center justify-content-center">
            <i class="fab fa-linkedin-in"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-4" data-aos="fade-up" data-aos-delay="200">
        <h5 class="text-white mb-4 fw-bold">Quick Links</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="{{ url('/') }}" class="text-white footer-link">Home</a></li>
          <li class="mb-2"><a href="{{ url('/properties') }}" class="text-white footer-link">Properties</a></li>
          <li class="mb-2"><a href="{{ url('/foodplans') }}" class="text-white footer-link">Food Plans</a></li>
          <li class="mb-2"><a href="{{ url('/contact') }}" class="text-white footer-link">Contact</a></li>
          <li class="mb-2"><a href="{{ url('/about') }}" class="text-white footer-link">About Us</a></li>
        </ul>
      </div>

      <!-- Contact Info -->
      <div class="col-lg-3 col-md-4" data-aos="fade-up" data-aos-delay="300">
        <h5 class="text-white mb-4 fw-bold">Contact Us</h5>
        <ul class="list-unstyled text-white">
          <li class="mb-3 d-flex align-items-start">
            <i class="fas fa-map-marker-alt text-light-blue mt-1 me-2"></i>
            <span>No 14, Dhubai kuruku santhu, Dhubai main road uh , Dhubai</span>
          </li>
          <li class="mb-3 d-flex align-items-start">
            <i class="fas fa-phone-alt text-light-blue mt-1 me-2"></i>
            <span>+94773155125</span>
          </li>
          <li class="mb-3 d-flex align-items-start">
            <i class="fas fa-envelope text-light-blue mt-1 me-2"></i>
            <span>info@renttent.com</span>
          </li>
        </ul>
      </div>

      <!-- Newsletter -->
      <div class="col-lg-3 col-md-4" data-aos="fade-left" data-aos-delay="400">
        <h5 class="text-white mb-4 fw-bold">Newsletter</h5>
        <p class="text-white-50 mb-3">Subscribe to get updates on new properties and special offers.</p>
        <form class="mb-3">
          <div class="input-group">
            <input type="email" class="form-control bg-medium-blue border-0 text-white" placeholder="Your Email" style="height: 45px;">
                    <button class="btn btn-light-blue text-white newsletter-btn" type="submit" style="background-color: #4da6ff; height: 45px;">
          <i class="fas fa-paper-plane"></i>
        </button>
          </div>
        </form>
        <small class="text-white-50">We'll never share your email with anyone else.</small>
      </div>
    </div>

    <hr class="my-4" style="border-color: rgba(77, 166, 255, 0.2);">

    <!-- Copyright -->
    <div class="row align-items-center">
      <div class="col-md-6 text-center text-md-start">
        <p class="text-white-50 mb-0">&copy; {{ date('Y') }} RentTent. All rights reserved.</p>
      </div>
      <div class="col-md-6 text-center text-md-end">
        <a href="#" class="text-white me-3 footer-link">Privacy Policy</a>
        <a href="#" class="text-white me-3 footer-link">Terms of Service</a>
        <a href="#" class="text-white footer-link">FAQ</a>
      </div>
    </div>
  </div>
</footer>
<!-- AOS CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    AOS.init({ once: true });
    // Smooth scroll for footer links
    document.querySelectorAll('.footer-link').forEach(link => {
      link.addEventListener('click', function(e) {
        if (this.getAttribute('href').startsWith('#')) {
          e.preventDefault();
          const target = document.querySelector(this.getAttribute('href'));
          if (target) {
            window.scrollTo({
              top: target.offsetTop - 80,
              behavior: 'smooth'
            });
          }
        }
      });
    });
  });
</script>

<style>
  .bg-dark-blue {
    background-color:rgb(10, 15, 41);
  }
  
  .bg-medium-blue {
    background-color: rgba(26, 59, 106, 0.5);
  }
  
  .bg-light-blue {
    background-color: #4da6ff;
  }
  
  .text-light-blue {
    color: #4da6ff;
  }
  
  .footer-link {
    transition: all 0.3s ease;
    position: relative;
    text-decoration: none;
    opacity: 0.8;
  }
  
  .footer-link::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 1px;
    background: #4da6ff;
    transition: all 0.3s ease;
  }
  
  .footer-link:hover {
    color: #4da6ff !important;
    opacity: 1;
  }
  
  .footer-link:hover::after {
    width: 100%;
  }
  
  /* Social Icons with Gradients */
  .social-icon {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 18px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    z-index: 1;
  }
  
  .social-icon::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(77, 166, 255, 0.8), rgba(10, 31, 61, 0.8));
    z-index: -1;
    transition: all 0.3s ease;
  }
  
  .social-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(77, 166, 255, 0.3);
  }
  
  .social-icon:hover::before {
    background: linear-gradient(135deg, rgba(77, 166, 255, 1), rgba(10, 31, 61, 1));
  }
  
  /* Platform-specific colors on hover */
  .facebook:hover { color: #0a1f3d !important; }
  .twitter:hover { color: #1da1f2 !important; }
  .instagram:hover { color: #e1306c !important; }
  .linkedin:hover { color: #0a1f3d !important; }
  
  .input-group:focus-within {
    box-shadow: 0 0 0 0.25rem rgba(77, 166, 255, 0.25);
  }
  
  .form-control:focus {
    background-color: rgba(26, 59, 106, 0.7) !important;
    border-color: #4da6ff !important;
    box-shadow: none !important;
    color: white !important;
  }
  
  .text-white-50 {
    color: rgba(255, 255, 255, 0.7);
  }
  
  .newsletter-btn {
    transition: all 0.3s ease;
  }
  
  .newsletter-btn:hover {
    background: linear-gradient(135deg, #4da6ff, #3a8de0) !important;
    transform: translateY(-1px);
  }
</style>