@extends('Layout.master_dash')

@section('title', 'Manage Boardings')

@section('content')
<div class="glass-card w-100 p-4 position-relative" style="margin-top:2cm;">
<button id="sidebarToggle" class="btn position-fixed" style="top:2.5cm; right:2rem; z-index:3000; background:transparent; border:none;">
  <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="black" class="bi bi-list" viewBox="0 0 16 16">
    <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z"/>
  </svg>
</button>

<h2 class="mb-4 text-primary fw-bold">Your Boarding Listings</h2>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBoardingModal">
    <i class="bi bi-plus-circle"></i> Add New Boarding
</button>

@if($boardings->isEmpty())
    <p class="text-muted fst-italic">No boardings yet, start by adding one!</p>
@else
    <div class="row g-4">
        @foreach($boardings as $boarding)
            @php $mainPhoto = $boarding->photos->where('is_main', true)->first(); @endphp
            <div class="col-md-4">
                <div class="card shadow-sm h-100 border-0">
                    @if($mainPhoto)
                        <img src="{{ asset('storage/'.$mainPhoto->image_url) }}" class="card-img-top" style="height:180px; object-fit:cover;">
                    @else
                        <div class="d-flex align-items-center justify-content-center bg-light" style="height:180px;">
                            <span class="text-muted">No Image</span>
                        </div>
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $boarding->title }}</h5>
                        <p class="card-text text-muted mb-1">{{ $boarding->location }}</p>
                        <p class="fw-bold text-success mb-1">Rs. {{ number_format($boarding->monthly_rent, 2) }}</p>
                        <p class="mb-1">Room Type: {{ ucfirst($boarding->room_type) }} | Size: {{ $boarding->room_size ?? 'N/A' }} sq.ft</p>
                        <p class="mb-1">Advance: {{ $boarding->advance_percent ?? 0 }}% | Refundable: {{ $boarding->is_refundable ? 'Yes' : 'No' }}</p>
                        <p class="mb-1">
                            Food: 
                            @if($boarding->is_food_included)
                                <span class="badge bg-success">🍽 Included</span>
                            @else
                                <span class="badge bg-secondary">❌ Not Included</span>
                            @endif
                        </p>
                        <p class="mb-1">
                            Gender: {{ ucfirst($boarding->gender_preference ?? 'Any') }} |
                            Amenities: 
                            {{ $boarding->wifi ? 'WiFi, ' : '' }}
                            {{ $boarding->parking ? 'Parking, ' : '' }}
                            {{ $boarding->laundry ? 'Laundry, ' : '' }}
                            {{ $boarding->attached_bathroom ? 'Attached Bath, ' : '' }}
                            {{ $boarding->furnished ? 'Furnished' : '' }}
                        </p>
                        <p class="mb-2">
                            Status: 
                            @if($boarding->is_approved)
                                <span class="badge bg-success">✅ Approved</span>
                            @else
                                <span class="badge bg-warning text-dark">⏳ Pending</span>
                            @endif
                        </p>
                        <p class="text-muted" style="font-size:0.85rem;">Posted: {{ \Carbon\Carbon::parse($boarding->posted_date)->format('d M, Y') }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-white border-0">
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#editBoardingModal{{ $boarding->boarding_id }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form action="{{ route('provider.boardings.destroy', $boarding->boarding_id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this boarding?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
</div>

<!-- Add Boarding Modal -->
<div class="modal fade" id="addBoardingModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('provider.boardings.store') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="modal-content shadow">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Add New Boarding</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">

            <!-- Title & Location -->
            <div class="col-md-6">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control" placeholder="Ex: Cozy 2BHK near beach" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Location</label>
              <input type="text" name="location" class="form-control" placeholder="Ex: Colombo, Sri Lanka" required>
            </div>

            <!-- Monthly Rent & Room Type -->
            <div class="col-md-6">
              <label class="form-label">Monthly Rent (LKR)</label>
              <input type="number" step="0.01" name="monthly_rent" class="form-control" placeholder="Ex: 15000" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Room Type</label>
              <select name="room_type" class="form-select" required>
                <option value="" disabled selected>Select room type</option>
                <option value="single">Single</option>
                <option value="shared">Shared</option>
                <option value="family">Family</option>
              </select>
            </div>

            <!-- Room Size & Advance -->
            <div class="col-md-6">
              <label class="form-label">Room Size (sq.ft)</label>
              <input type="number" name="room_size" class="form-control" placeholder="Ex: 200">
            </div>
            <div class="col-md-6">
              <label class="form-label">Advance %</label>
              <input type="number" name="advance_percent" class="form-control" placeholder="Ex: 50" step="1" min="0">
            </div>

            <!-- Refundable & Gender Preference -->
            <div class="col-md-6">
              <label class="form-label">Refundable?</label>
              <select name="is_refundable" class="form-select">
                <option value="1">Yes</option>
                <option value="0" selected>No</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">Gender Preference</label>
              <select name="gender_preference" class="form-select">
                <option value="any" selected>Any</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
              </select>
            </div>

            <!-- Amenities -->
            <div class="col-md-12">
              <label class="form-label">Amenities</label>
              <div class="d-flex flex-wrap gap-2">
                <div class="form-check"><input class="form-check-input" type="checkbox" name="wifi" value="1"><label class="form-check-label">WiFi</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="parking" value="1"><label class="form-check-label">Parking</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="laundry" value="1"><label class="form-check-label">Laundry</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="attached_bathroom" value="1"><label class="form-check-label">Attached Bath</label></div>
                <div class="form-check"><input class="form-check-input" type="checkbox" name="furnished" value="1"><label class="form-check-label">Furnished</label></div>
              </div>
            </div>

            <!-- Photos -->
            <div class="col-md-12">
              <label class="form-label">Upload Photos</label>
              <input type="file" name="photos[]" class="form-control" multiple onchange="previewPhotos(event, 'addPhotoPreview')">
              <div id="addPhotoPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
            </div>

            <!-- Property Doc & Police Report -->
            <div class="col-md-6">
              <label class="form-label">Property Document</label>
              <input type="file" name="property_doc_image" class="form-control" onchange="previewSingleFile(event, 'addPropertyDocPreview')">
              <small class="text-muted">PDF/JPG ownership proof</small>
              <div id="addPropertyDocPreview" class="mt-2"></div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Police Report</label>
              <input type="file" name="police_report_image" class="form-control" onchange="previewSingleFile(event, 'addPoliceReportPreview')">
              <small class="text-muted">Upload police clearance if any</small>
              <div id="addPoliceReportPreview" class="mt-2"></div>
            </div>

            <!-- Description -->
            <div class="col-md-12">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"></textarea>
            </div>

            <!-- Food & Posted Date -->
            <div class="col-md-6">
              <label class="form-label">Food Included?</label>
              <select name="is_food_included" class="form-select" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label">post active untill</label>
              <input type="date" name="posted_date" class="form-control" required>
            </div>

            <!-- Privacy Policy -->
            <div class="col-md-12">
              <label class="form-label">Privacy Policy</label>
              <textarea name="privacy_policy" class="form-control" rows="2"></textarea>
            </div>

          </div>
        </div>
        <div class="modal-footer d-flex flex-column">
          <div class="text-center mb-3">
            <p class="mb-1"><small class="text-muted">By adding a boarding, you agree to our <a href="#" class="text-decoration-none">Terms & Conditions</a></small></p>
            <p class="mb-1"><small class="text-muted">10% of the advance amount will be collected as security deposit</small></p>
            <p class="mb-0"><small class="text-muted">You can add more boardings at any time</small></p>
          </div>
          <div class="d-flex gap-2 justify-content-end">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Add Boarding</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Edit Boarding Modal -->
@foreach($boardings as $boarding)
<div class="modal fade" id="editBoardingModal{{ $boarding->boarding_id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('provider.boardings.update', $boarding->boarding_id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="modal-content shadow">
        <div class="modal-header bg-warning text-dark">
          <h5 class="modal-title">Edit Boarding</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">

            <!-- Title & Location -->
            <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ $boarding->title }}" required></div>
            <div class="col-md-6"><label class="form-label">Location</label><input type="text" name="location" class="form-control" value="{{ $boarding->location }}" required></div>

            <!-- Monthly Rent & Room Type -->
            <div class="col-md-6"><label class="form-label">Monthly Rent</label><input type="number" step="0.01" name="monthly_rent" class="form-control" value="{{ $boarding->monthly_rent }}" required></div>
            <div class="col-md-6"><label class="form-label">Room Type</label>
              <select name="room_type" class="form-select" required>
                <option value="single" {{ $boarding->room_type=='single'?'selected':'' }}>Single</option>
                <option value="shared" {{ $boarding->room_type=='shared'?'selected':'' }}>Shared</option>
                <option value="family" {{ $boarding->room_type=='family'?'selected':'' }}>Family</option>
              </select>
            </div>

            <!-- Room Size & Advance -->
            <div class="col-md-6"><label class="form-label">Room Size (sq.ft)</label><input type="number" name="room_size" class="form-control" value="{{ $boarding->room_size }}"></div>
            <div class="col-md-6"><label class="form-label">Advance %</label><input type="number" name="advance_percent" class="form-control" value="{{ $boarding->advance_percent }}"></div>

            <!-- Refundable & Gender -->
            <div class="col-md-6"><label class="form-label">Refundable?</label>
              <select name="is_refundable" class="form-select">
                <option value="1" {{ $boarding->is_refundable?'selected':'' }}>Yes</option>
                <option value="0" {{ !$boarding->is_refundable?'selected':'' }}>No</option>
              </select>
            </div>
            <div class="col-md-6"><label class="form-label">Gender Preference</label>
              <select name="gender_preference" class="form-select">
                <option value="any" {{ $boarding->gender_preference=='any'?'selected':'' }}>Any</option>
                <option value="male" {{ $boarding->gender_preference=='male'?'selected':'' }}>Male</option>
                <option value="female" {{ $boarding->gender_preference=='female'?'selected':'' }}>Female</option>
              </select>
            </div>

            <!-- Existing Photos -->
            <div class="col-md-12">
              <label class="form-label">Existing Photos</label>
              <div class="d-flex flex-wrap gap-2 mb-2">
                @foreach($boarding->photos as $photo)
                  <div class="position-relative" style="width:120px;">
                    <img src="{{ asset('storage/'.$photo->image_url) }}" class="img-thumbnail" style="width:100%; height:80px; object-fit:cover;">
                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="deletePhoto({{ $photo->photo_id }})">&times;</button>
                    <div class="form-check text-center mt-1">
                      <input class="form-check-input" type="radio" name="main_photo" value="{{ $photo->photo_id }}" {{ $photo->is_main ? 'checked' : '' }}>
                      <label class="form-check-label">Main</label>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Add More Photos -->
            <div class="col-md-12">
              <label class="form-label">Add More Photos</label>
              <input type="file" name="photos[]" class="form-control" multiple onchange="previewPhotos(event)">
              <div id="editPhotoPreview" class="d-flex flex-wrap gap-2 mt-2"></div>
            </div>

            <!-- Property Doc & Police Report -->
            <div class="col-md-6">
              <label class="form-label">Property Document</label>
              <input type="file" name="property_doc_image" class="form-control" onchange="previewSingleFile(event, 'editPropertyDocPreview{{ $boarding->boarding_id }}')">
              <div id="editPropertyDocPreview{{ $boarding->boarding_id }}" class="mt-2">
                @if($boarding->property_doc_image)
                    @php $ext = pathinfo($boarding->property_doc_image, PATHINFO_EXTENSION); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/'.$boarding->property_doc_image) }}" style="width:120px; height:80px; object-fit:cover;" class="img-thumbnail">
                    @else
                        <span class="badge bg-info text-dark p-2">📄 Existing PDF</span>
                    @endif
                @endif
              </div>
            </div>
            <div class="col-md-6">
              <label class="form-label">Police Report</label>
              <input type="file" name="police_report_image" class="form-control" onchange="previewSingleFile(event, 'editPoliceReportPreview{{ $boarding->boarding_id }}')">
              <div id="editPoliceReportPreview{{ $boarding->boarding_id }}" class="mt-2">
                @if($boarding->police_report_image)
                    @php $ext = pathinfo($boarding->police_report_image, PATHINFO_EXTENSION); @endphp
                    @if(in_array($ext, ['jpg','jpeg','png']))
                        <img src="{{ asset('storage/'.$boarding->police_report_image) }}" style="width:120px; height:80px; object-fit:cover;" class="img-thumbnail">
                    @else
                        <span class="badge bg-info text-dark p-2">📄 Existing PDF</span>
                    @endif
                @endif
              </div>
            </div>

            <!-- Description & Food & Posted Date -->
            <div class="col-md-12"><label class="form-label">Description</label><textarea name="description" class="form-control" rows="3">{{ $boarding->description }}</textarea></div>
            <div class="col-md-6"><label class="form-label">Food Included?</label>
              <select name="is_food_included" class="form-select" required>
                <option value="1" {{ $boarding->is_food_included?'selected':'' }}>Yes</option>
                <option value="0" {{ !$boarding->is_food_included?'selected':'' }}>No</option>
              </select>
            </div>
            <div class="col-md-6"><label class="form-label">Change the post validity</label><input type="date" name="posted_date" class="form-control" value="{{ $boarding->posted_date }}" required></div>
            <div class="col-md-12"><label class="form-label">Privacy Policy</label><textarea name="privacy_policy" class="form-control" rows="2">{{ $boarding->privacy_policy }}</textarea></div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-warning">Update Boarding</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endforeach

<style>
.card:hover { transform: scale(1.03); transition: all 0.2s; }
.card-body h5 { font-size:1.1rem; }
</style>

<script>
// Preview uploaded photos
function previewPhotos(event){
    const preview = document.getElementById('addPhotoPreview') || document.getElementById('editPhotoPreview');
    preview.innerHTML = '';
    const files = event.target.files;
    for(let i=0; i<files.length; i++){
        const reader = new FileReader();
        reader.onload = function(e){
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '120px';
            img.style.height = '80px';
            img.style.objectFit = 'cover';
            img.classList.add('img-thumbnail');
            preview.appendChild(img);
        }
        reader.readAsDataURL(files[i]);
    }
}

// Preview single file (image/pdf)
function previewSingleFile(event, previewId){
    const preview = document.getElementById(previewId);
    preview.innerHTML = '';
    const file = event.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(e){
            let content;
            if(file.type === "application/pdf"){
                content = document.createElement('span');
                content.textContent = "📄 PDF Selected";
                content.classList.add('badge','bg-info','text-dark','p-2');
            } else {
                content = document.createElement('img');
                content.src = e.target.result;
                content.style.width = '120px';
                content.style.height = '80px';
                content.style.objectFit = 'cover';
                content.classList.add('img-thumbnail');
            }
            preview.appendChild(content);
        }
        reader.readAsDataURL(file);
    }
}

// Delete photo via AJAX
function deletePhoto(id){
    if(confirm('Delete this photo?')){
        fetch('/provider/boardings/photo/'+id, {
            method:'DELETE',
            headers:{ 'X-CSRF-TOKEN':'{{ csrf_token() }}' }
        }).then(()=> location.reload());
    }
}
</script>

@endsection
