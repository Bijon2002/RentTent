<<<<<<< HEAD
@extends('Layout.master_dash')

@section('content')
@php
    use App\Models\User;
    $userId = session('user_id');
    $user = $userId ? User::find($userId) : null;
    if (!$user) {
        $user = auth()->user();
    }
@endphp

<div class="d-flex align-items-center justify-content-center w-100 py-5"
     style="min-height:100vh; margin-top:2cm;"
     data-aos="fade-up" data-aos-duration="1200">

    <div class="glass-card shadow-lg border-0 rounded-4 p-4"
         style="max-width:1000px; width:100%; margin: auto;">

        <!-- Profile Header -->
        <div class="d-flex flex-column align-items-center mb-4 position-relative">
            <!-- Profile Image Centered -->
            <div class="position-relative mb-3">
                <img src="{{ $user && $user->profile_pic ? asset('storage/' . $user->profile_pic) : asset('img/default-user.png') }}"
                     class="rounded-circle border border-4 border-white shadow squircle-img"
                     style="width:150px; height:150px; object-fit:cover;">
                <button class="btn btn-primary rounded-circle p-2 position-absolute bottom-0 end-0"
                        data-bs-toggle="modal" data-bs-target="#profileModal"
                        style="width:40px; height:40px;">
                    <i class="bi bi-pencil-fill"></i>
                </button>
            </div>

            <!-- Text Info Left-aligned -->
            <div class="text-start w-100 ps-md-4">
                <h3 class="fw-bold mb-1 text-light">{{ $user ? $user->name : 'Unknown User' }}</h3>
                <p class="text-light mb-0">{{ $user ? ucfirst($user->role) : '' }}</p>
                <p class="text-light">Member since {{ $user ? $user->created_at->format('F Y') : '' }}</p>
            </div>

            <!-- Hamburger Icon top-right -->
            <button id="sidebarToggle" class="btn position-absolute" style="top:2rem; right:2rem; z-index:110; background:transparent; border:none;">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12.5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5zm0-5a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1h-10a.5.5 0 0 1-.5-.5z"/>
                </svg>
            </button>
        </div>
<<<<<<< HEAD
=======

        <!-- Profile Info -->
        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="glass-card p-3 h-100">
                    <h6 class="fw-bold text-primary mb-3">Personal Information</h6>

                    <div class="d-flex justify-content-between border-bottom py-2">
                        <strong>Email</strong>
                        <span>{{ $user->email ?? 'N/A' }}</span>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-2">
                        <strong>Phone</strong>
                        <span>{{ $user->phone ?? 'N/A' }}</span>
                    </div>

                    <div class="d-flex justify-content-between border-bottom py-2">
                        <strong>NIC</strong>
                        <span>{{ $user->nic_number ?? 'N/A' }}</span>
                    </div>

                    <div class="d-flex justify-content-between py-2">
                        <strong>Location</strong>
                        <span>{{ $user->location ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="glass-card p-3 h-100">
                    <h6 class="fw-bold text-primary mb-3">Account Status</h6>

                    <div class="d-flex justify-content-between border-bottom py-2">
                        <strong>Verification</strong>
                        <span class="badge bg-{{ strtolower($user->verification_status) === 'verified' ? 'success' : 'warning' }}">
                            {{ ucfirst($user->verification_status ?? 'pending') }}
                        </span>
                    </div>

                    @if($user && $user->nic_image)
                    <div class="mt-3">
                        <strong>NIC Image:</strong>
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $user->nic_image) }}"
                                 alt="NIC Image"
                                 class="img-fluid rounded-3 border"
                                 style="max-height: 120px;">
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ auth()->user()->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ auth()->user()->email }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone No</label>
                            <input type="text" class="form-control" id="phone" name="phone" value="{{ auth()->user()->phone }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nic_number" class="form-label">NIC Number</label>
                            <input type="text" class="form-control" id="nic_number" name="nic_number" value="{{ auth()->user()->nic_number }}">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="{{ auth()->user()->location }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="profile_pic" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nic_image" class="form-label">NIC Image</label>
                            <input type="file" class="form-control" id="nic_image" name="nic_image">
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
.squircle-img { border-radius: 30% / 40%; }

/* Filament light-bulb glow effect for all cards */
.glass-card {
    box-shadow: 0 0 15px rgba(255,255,255,0.3), 0 0 30px rgba(255,255,255,0.2) inset;
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    transition: box-shadow 0.3s ease;
}
.glass-card:hover {
    box-shadow: 0 0 25px rgba(255,255,255,0.5), 0 0 50px rgba(255,255,255,0.3) inset;
}
</style>

@endsection
>>>>>>> f5cbcfb68cd8625b004de01d362194b118ef6be0
=======
>>>>>>> 13bcfc4250f19caec8fccf6698d7dcadfe1f6862
