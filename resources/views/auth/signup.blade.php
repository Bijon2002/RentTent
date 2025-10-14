@extends('Layout.cmaster')

@section('content')
<div class="signup-page d-flex align-items-center justify-content-center" style="min-height:100vh; background: transparent;">
<style>
@media (min-width: 1200px) {
  .signup-page {
    margin-top: 1cm !important;
  }
}
</style>
  
  <div class="container" style="margin-top:3cm;">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 1200px; width:100%;">
      <div class="row g-0">
        <!-- Left Section (Form) -->
        <div class="col-md-6 p-5 bg-transparent" style="height: 600px; overflow-y: auto; background: transparent;">
          <div class="text-center mb-4">
            <h2 class="fw-bold">Begin Your Adventure</h2>
            <p class="text-muted">Sign up for your account</p>
          </div>

          <div class="d-flex justify-content-center gap-3 mb-4">
            <a href="#" class="btn btn-outline-dark rounded-circle"><i class="fa-brands fa-apple"></i></a>
            <a href="#" class="btn btn-outline-danger rounded-circle"><i class="fa-brands fa-google"></i></a>
            <a href="#" class="btn btn-outline-dark rounded-circle"><i class="fa-brands fa-x-twitter"></i></a>
          </div>
          <p class="text-center text-muted mb-3">or</p>

          <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" class="form-control" name="name" placeholder="eli_trekker" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" placeholder="elitrekker@gmail.com" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Mobile Number</label>
              <input type="text" class="form-control" name="phone" required>
            </div>

            <div class="mb-3">
              <label class="form-label">National ID</label>
              <input type="text" class="form-control" name="nic_number" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Upload NIC Image</label>
              <input type="file" class="form-control" name="nic_image" accept="image/*" required>
            </div>

            <div class="mb-3">
              <div class="alert alert-info" style="background: #fff8dc; color: #333; border: 1px solid #ffd700;">
                <strong>Role Information:</strong><br>
                <ul style="margin-bottom:0; padding-left:1.2em;">
                  <li><b>Provider</b>: Boarding provider</li>
                  <li><b>Finder</b>: Boarding finder</li>
                  <li><b>Vendor</b>: Food provider</li>
                </ul>
              </div>
              <label class="form-label">Role</label>
              <select class="form-select" name="role" required>
                <option value="finder">Finder</option>
                <option value="provider">Provider</option>
                <option value="vendor">Vendor</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label">Profile Picture</label>
              <input type="file" class="form-control" name="profile_pic" accept="image/*">
            </div>

            <div class="mb-3">
              <label class="form-label">Location</label>
              <input type="text" class="form-control" name="location" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password" required>
            </div>

            <div class="mb-3">
              <label class="form-label">Confirm Password</label>
              <input type="password" class="form-control" name="password_confirmation" required>
            </div>

            <!-- Privacy Policy Modal Trigger -->
            <button type="button" class="btn btn-dark w-100" id="letsStartBtn" data-bs-toggle="modal" data-bs-target="#privacyModal">Let's Start</button>

            <!-- Privacy Policy Modal -->
            <div class="modal fade" id="privacyModal" tabindex="-1" aria-labelledby="privacyModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="privacyModalLabel">Greetings from RentTent! Here is our Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div style="max-height:200px; overflow-y:auto;">
                     <p><strong>Privacy, Security & Verification Policy – RentTent</strong></p>
<p>Welcome to RentTent! Your trust is our top priority. Before signing up, please read carefully how we handle your personal information, verification, payments, and interactions on our platform.</p>

<ul>
  <li><strong>Identity Verification:</strong> We collect your <em>NIC, profile picture, and personal details</em> strictly for identity verification. Verification ensures a safe and trustworthy community.</li>

  <li><strong>Unverified Users:</strong> If your account is <strong>not yet verified</strong>, you will <strong>not be able to post boardings or food menus</strong>, and you <strong>cannot book anything</strong>. Verification is currently done manually by our team. In the future, automated verification will be implemented to process your data securely and efficiently.</li>

  <li><strong>Data Protection:</strong> Your information is <strong>fully protected</strong>. We do <strong>not share, sell, or upload</strong> your data to any third-party applications or websites without your explicit consent.</li>

  <li><strong>Site Security:</strong> RentTent uses advanced security measures, including encryption and secure servers, to ensure your data is always safe. Your privacy is our highest priority.</li>

  <li><strong>Use of Information:</strong> Your information is used to enhance your experience on RentTent, including personalized room and food suggestions, booking confirmations, and improved search results.</li>

  <li><strong>Cookies & Analytics:</strong> We use cookies for session management, login persistence, and analytics to understand user interactions. No sensitive personal data is stored in cookies.</li>

  <li><strong>Payments & Booking Fees:</strong> For bookings, RentTent charges <strong>10% of the rent</strong> as a service fee. Food vendors receive <strong>40% of the booked rent</strong> for meals posted. Users can subscribe to vendors for updates, promotions, and exclusive offers.</li>

  <li><strong>User Rights & Consent:</strong> By signing up, you agree to our Terms of Service and Privacy Policy. You have full control over your data and can request updates, access, or deletion at any time.</li>

  <li><strong>Transparency & Trust:</strong> Your personal information is used only to make RentTent secure, reliable, and enjoyable. You are always informed about how your data is handled.</li>

  <li><strong>Contact & Support </strong> For any questions or concerns about privacy, verification, or security, our support team is ready to assist. Your trust matters, and we are here to ensure a safe experience for every user.</li>
</ul>

<p>By using RentTent, you confirm that you understand and agree to our policies, verification process, payment rules, and subscription practices. Together, we create a safe, secure, and reliable platform for finding rooms, boardings, and food services.</p>

                    </div>
                    <div class="form-check mt-3">
                      <input type="checkbox" class="form-check-input" id="agreeTerms">
                      <label for="agreeTerms" class="form-check-label">I agree to the terms and conditions</label>
                    </div>
                    <div id="agreeMsg" class="text-danger mt-2" style="display:none;">Agree the terms to continue</div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn w-100" id="continueBtn" style="background-color: #b0b0b0; color: #fff;" disabled>Continue</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">Already have an account? Log in</a>
          </div>
        </div>

        <!-- Right Section (Slideshow) -->
        <div class="col-md-6 d-none d-md-block position-relative">
          <div id="signupCarousel" class="carousel slide h-100" data-bs-ride="carousel">
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
            <button class="carousel-control-prev" type="button" data-bs-target="#signupCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#signupCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          <div class="position-absolute top-0 start-0 p-4 text-white">
            <h5 class="fw-bold">Travel the World, Your Way!</h5>
            <p style="max-width: 250px;">Explore destinations at your pace with personalized journeys & unforgettable experiences.</p>
          </div>
          <div class="position-absolute bottom-0 start-0 p-4 text-white">
            <h5 class="fw-bold">Explore the World, Beyond Boundaries!</h5>
            <button class="btn btn-light btn-sm mt-2">Start your adventure today!</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var agreeTerms = document.getElementById('agreeTerms');
  var continueBtn = document.getElementById('continueBtn');
  var agreeMsg = document.getElementById('agreeMsg');
  var signupForm = document.querySelector('form');

  // Helper to show error popup
  function showError(msg) {
    var errorModal = document.createElement('div');
    errorModal.className = 'modal fade';
    errorModal.id = 'errorModal';
    errorModal.innerHTML = `
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header bg-danger text-white">
            <h5 class="modal-title">Error</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>${msg}</p>
          </div>
        </div>
      </div>
    `;
    document.body.appendChild(errorModal);
    var modal = new bootstrap.Modal(errorModal);
    modal.show();
    errorModal.addEventListener('hidden.bs.modal', function() {
      errorModal.remove();
    });
  }

  if (agreeTerms && continueBtn && agreeMsg && signupForm) {
    agreeTerms.addEventListener('change', function() {
      if (agreeTerms.checked) {
        continueBtn.style.backgroundColor = '#0a174e';
        continueBtn.disabled = false;
        agreeMsg.style.display = 'none';
      } else {
        continueBtn.style.backgroundColor = '#b0b0b0';
        continueBtn.disabled = true;
        agreeMsg.style.display = 'block';
      }
    });
    continueBtn.addEventListener('click', function() {
      if (!agreeTerms.checked) {
        agreeMsg.style.display = 'block';
        return;
      }
      // Validate all required fields
      var requiredFields = [
        {name: 'name', label: 'Username'},
        {name: 'email', label: 'Email'},
        {name: 'phone', label: 'Mobile Number'},
        {name: 'nic_number', label: 'National ID'},
        {name: 'nic_image', label: 'NIC Image'},
        {name: 'role', label: 'Role'},
        {name: 'location', label: 'Location'},
        {name: 'password', label: 'Password'},
        {name: 'password_confirmation', label: 'Confirm Password'}
      ];
      for (var i = 0; i < requiredFields.length; i++) {
        var field = signupForm.querySelector('[name="' + requiredFields[i].name + '"]');
        if (!field || (field.type === 'file' ? !field.files.length : !field.value.trim())) {
          showError(requiredFields[i].label + ' is required.');
          return;
        }
      }
      // Password match validation
      var password = signupForm.querySelector('[name="password"]');
      var confirm = signupForm.querySelector('[name="password_confirmation"]');
      if (password.value !== confirm.value) {
        showError('Passwords do not match.');
        return;
      }
      // If all valid, submit and redirect to login
  signupForm.submit();
  // After successful signup, backend should redirect to login page. Remove client-side redirect.
    });
  }
});
</script>
