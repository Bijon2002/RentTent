@extends('layout.master_entity')

@section('title', 'RentTent - Discover Properties')

@push('styles')
<style>
:root {
    --primary: #0a174e;
    --primary-dark: #001f54;
    --gradient-blue: linear-gradient(135deg, #0a174e, #20378a);
    --secondary: #FF9800;
    --gray-light: #f5f5f5;
    --dark: #333;
    --shadow: 0 4px 12px rgba(0,0,0,0.1);
    --radius: 8px;
}
.btn-heart {
    background: transparent;
    border: none;
    cursor: pointer;
    font-size: 1.2rem;
    color: #e74c3c;
    margin-left: 0.5rem;
    transition: transform 0.2s;
    min-width: 44px;
    min-height: 44px;
}
.btn-heart.liked i { color: #c0392b; transform: scale(1.2); }


body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f8f9fa;
    color: var(--dark);
    line-height: 1.6;
}

.main-container { display: flex; flex-direction: column; gap: 1.5rem; }
@media(min-width: 992px) { .main-container { flex-direction: row; align-items: flex-start; } }

.sidebar {
    background: #fff; border-radius: var(--radius); box-shadow: var(--shadow); padding: 1.2rem; flex: 0 0 250px;
    position: sticky;
    top: 20px;
}
/* Mobile Overlay Styles - Enhanced for better UX */
@media(max-width: 991px) {
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: 1050;
        overflow-y: auto;
        border-radius: 0;
        display: none;
        padding-bottom: 6rem;
        animation: slideIn 0.3s ease-out;
    }
    .sidebar.show-filter {
        display: block;
    }
    .close-filters {
        display: block !important;
        font-size: 1.5rem;
        cursor: pointer;
        color: var(--primary);
        min-width: 44px;
        min-height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    @keyframes slideIn {
        from {
            transform: translateX(-100%);
        }
        to {
            transform: translateX(0);
        }
    }
}

.sidebar-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem; padding-bottom: 0.8rem; border-bottom: 1px solid #eee; }
.sidebar-title { font-size: 1.1rem; font-weight: 600; color: var(--primary); }

.filter-group { margin-bottom: 1.2rem; }
.filter-title { font-weight: 600; margin-bottom: 0.6rem; display: flex; justify-content: space-between; font-size: 0.9rem; }
.filter-options { display: flex; flex-direction: column; gap: 0.5rem; }
.filter-checkbox { display: flex; align-items: center; gap: 0.5rem; font-size: 0.9rem; cursor: pointer; padding: 0.25rem 0; }
.filter-checkbox input[type="checkbox"] { width: 20px; height: 20px; accent-color: var(--primary); cursor: pointer; }

.price-range { display: flex; flex-direction: column; gap: 0.5rem; }
.price-inputs { display: flex; gap: 0.5rem; }
.price-inputs input { flex: 1; padding: 0.75rem; border: 1px solid #ddd; border-radius: var(--radius); font-size: 0.9rem; min-height: 44px; }

/* Filter buttons alignment fix */
.filter-buttons {
    display: flex;
    gap: 0.6rem;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #eee;
}
@media(max-width: 991px) {
    /* Make buttons stick to bottom on mobile overlay */
    .filter-buttons {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 1rem 1.2rem;
        background: #fff;
        box-shadow: 0 -4px 10px rgba(0,0,0,0.05);
        margin-top: 0;
        z-index: 1051;
    }
}
@media(min-width: 992px) { .filter-buttons { position: static; padding-bottom: 0; border-top: 1px solid #eee; } }


.filter-buttons button { flex: 1; padding: 0.75rem; border-radius: var(--radius); border: none; font-weight: 600; cursor: pointer; font-size: 0.9rem; min-height: 44px; transition: all 0.3s; }
.btn-apply { background: var(--gradient-blue); color: white; }
.btn-apply:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }
.btn-reset { background: #f5f5f5; color: var(--dark); }
.btn-reset:hover { background: #e0e0e0; }

.main-content { flex: 1; }

.hero {
    position: relative;
    height: 420px;
    margin-top: -1cm;
    background: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.4)), url('https://images.unsplash.com/photo-1560185007-cde436f6a4d0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1600&q=80');
    background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center;
}
.hero-content { max-width: 800px; padding: 2rem; color: #fff; margin-top: 3cm; }
.hero-content h2 { font-size: 2.2rem; margin-bottom: 0.2rem; }
.hero-content p { font-size: 1.1rem; margin-bottom: 1.5rem; }

/* Mobile Hero Adjustments */
@media(max-width: 767px) {
    .hero {
        height: 300px;
        margin-top: 70px !important;
    }
    .hero-content {
        padding: 1rem;
        margin-top: 0;
    }
    .hero-content h2 {
        font-size: 1.5rem;
    }
    .hero-content p {
        font-size: 0.9rem;
    }
}

.btn { padding: 0.75rem 1.25rem; border: none; border-radius: var(--radius); font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 0.4rem; transition: all 0.3s; font-size: 0.9rem; min-height: 44px; }
.btn-darkblue { background: var(--gradient-blue); color: #fff; text-decoration: none; }
.btn-darkblue:hover { transform: translateY(-2px); box-shadow: 0 4px 8px rgba(0,0,0,0.2); }

/* Container responsiveness */
.container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 1.5rem;
}

@media(max-width: 767px) {
    .container {
        padding: 1rem;
    }
}

/* Properties Grid - Mobile First */
.properties {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.2rem;
}
@media(min-width: 768px){
    .properties { grid-template-columns: 1fr 1fr; }
}
@media(min-width: 992px){
    .properties { grid-template-columns: 1fr 1fr; }
}

/* Property Card - Mobile Optimized */
.property-card {
    background: #fff;
    padding: 1rem;
    border-radius: var(--radius);
    box-shadow: var(--shadow);
    transition: 0.3s;
    display: flex;
    flex-direction: column;
    height: 100%;
}
.property-card:hover { transform: translateY(-5px); box-shadow: 0 8px 16px rgba(0,0,0,0.15); }

/* Image Aspect Ratio - Responsive */
.property-image {
    width: 100%;
    aspect-ratio: 2 / 1;
    object-fit: cover;
    border-radius: var(--radius);
    margin-bottom: 0.6rem;
    height: auto;
}

@media(max-width: 767px) {
    .property-image {
        aspect-ratio: 16 / 9;
    }
}

.image-placeholder {
    width: 100%;
    aspect-ratio: 2 / 1;
    border-radius: var(--radius);
    margin-bottom: 0.6rem;
    background-color: var(--gray-light);
    color: var(--dark);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    padding: 1rem;
    font-size: 0.9rem;
}

@media(max-width: 767px) {
    .image-placeholder {
        aspect-ratio: 16 / 9;
    }
}

.property-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.4rem; flex-wrap: wrap; gap: 0.5rem; }
.property-title { font-size: 1.1rem; font-weight: 600; color: var(--dark); margin-bottom: 0.3rem; word-break: break-word; }
.property-info { flex-grow: 1; margin-bottom: 0.8rem; }
.property-info p { margin-bottom: 0.3rem; font-size: 0.9rem; }

@media(max-width: 767px) {
    .property-title {
        font-size: 1rem;
    }
    .property-info p {
        font-size: 0.85rem;
    }
}

.view-more-btn { margin-top: auto; width: 100%; text-align: center; }
.status-badge { display: inline-block; padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600; }
.status-available { background-color: #e8f5e9; color: #2e7d32; }
.status-unavailable { background-color: #ffebee; color: #c62828; }
.mobile-filter-btn { display: block; margin-bottom: 1rem; width: 100%; }
@media(min-width: 992px) { .mobile-filter-btn { display: none; } }

/* Section Header Responsive */
.section-header h2 {
    font-size: 1.75rem;
    margin-bottom: 0.5rem;
}

.section-header p {
    font-size: 1rem;
    color: #666;
}

@media(max-width: 767px) {
    .section-header h2 {
        font-size: 1.5rem;
    }
    .section-header p {
        font-size: 0.9rem;
    }
}
</style>
@endpush

@section('content')
<div class="hero">
    <div class="hero-content">
        <h2>Discover Properties</h2>
        <p>Find Your Perfect Boarding Or Rental Near You!</p>
        <button class="btn btn-darkblue"><i class="fas fa-search"></i> Explore Now</button>
    </div>
</div>

<div class="container">
    <button class="btn btn-darkblue mobile-filter-btn" id="filterToggle"><i class="fas fa-filter"></i> Show Filters</button>

    <div class="main-container">
        <aside class="sidebar" id="filterSidebar">
            <div class="sidebar-header">
                <h3 class="sidebar-title">Filter</h3>
                <span class="close-filters" id="closeFilters" style="display: none;"><i class="fas fa-times"></i></span>
            </div>

            <div class="filter-group">
                <div class="filter-title">Boarding Types</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="boarding_type" value="single"> Single</label>
                    <label class="filter-checkbox"><input type="checkbox" name="boarding_type" value="shared"> Shared</label>
                    <label class="filter-checkbox"><input type="checkbox" name="boarding_type" value="family"> Family</label>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Room Rent (Rs.)</div>
                <div class="price-range">
                    <div class="price-inputs">
                        <input type="number" placeholder="Min" id="priceMin">
                        <input type="number" placeholder="Max" id="priceMax">
                    </div>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Availabilities</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="availability" value="available"> Available</label>
                    <label class="filter-checkbox"><input type="checkbox" name="availability" value="unavailable"> Unavailable</label>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Room Size</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="room_size" value="small"> Small</label>
                    <label class="filter-checkbox"><input type="checkbox" name="room_size" value="medium"> Medium</label>
                    <label class="filter-checkbox"><input type="checkbox" name="room_size" value="large"> Large</label>
                </div>
            </div>

            <div class="filter-group">
                <div class="filter-title">Features</div>
                <div class="filter-options">
                    <label class="filter-checkbox"><input type="checkbox" name="parking" value="yes"> Parking</label>
                    <label class="filter-checkbox"><input type="checkbox" name="wifi" value="yes"> WiFi</label>
                    <label class="filter-checkbox"><input type="checkbox" name="attached_bathroom" value="yes"> Attached Bathroom</label>
                </div>
            </div>

            <div class="filter-buttons">
                <button class="btn-apply" id="applyFilters">Apply Filters</button>
                <button class="btn-reset" id="resetFilters">Reset</button>
            </div>
        </aside>

        <div class="main-content">
            <div class="section-header">
                <h2>Available Properties</h2>
                <p>Discover amazing properties near you</p>
            </div>

            <div class="properties">
                @foreach($boardings as $boarding)
                    @php $mainPhoto = $boarding->photos->where('is_main', true)->first(); @endphp
                    <div class="property-card">
                        @if($mainPhoto)
                            <img src="{{ asset('storage/'.$mainPhoto->image_url) }}" class="property-image" alt="{{ $boarding->title }}">
                        @else
                            <div class="image-placeholder">No Image Available</div>
                        @endif

                        <div class="property-header">
                            <h3 class="property-title">{{ $boarding->title }}</h3>
                            <div>
                                <span class="status-badge {{ $boarding->availability_status == 'available' ? 'status-available' : 'status-unavailable' }}">
                                    {{ ucfirst($boarding->availability_status) }}
                                </span>
                                <button class="btn-heart" data-id="{{ $boarding->boarding_id }}">
                                    <i class="far fa-heart"></i>
                                </button>
                            </div>
                        </div>

                        <div class="property-info">
                            <p><strong>Location:</strong> {{ $boarding->location }}</p>
                            <p><strong>Room Rent:</strong> Rs. {{ number_format($boarding->monthly_rent, 0) }}/month</p>
                            <p><strong>Boarding Type:</strong> {{ ucfirst($boarding->boarding_type) }}</p>
                            <p><strong>Parking:</strong> {{ $boarding->parking ? 'Yes' : 'No' }}</p>
                            <p><strong>WiFi:</strong> {{ $boarding->wifi ? 'Yes' : 'No' }}</p>
                            <p><strong>Attached Bathroom:</strong> {{ $boarding->attached_bathroom ? 'Yes' : 'No' }}</p>
                            <p><strong>Room Size:</strong> {{ ucfirst($boarding->room_size) }}</p>
                            @if($boarding->is_food_included)
                                <p><strong>Food:</strong> Included</p>
                            @endif
                        </div>

                        <div class="view-more-btn">
                            <a href="{{ route('boarding.details', $boarding->boarding_id) }}" class="btn btn-darkblue">View Details</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterToggle = document.getElementById('filterToggle');
    const filterSidebar = document.getElementById('filterSidebar');
    const closeFilters = document.getElementById('closeFilters');

    // Toggle filter sidebar for mobile view
    filterToggle.addEventListener('click', function() {
        filterSidebar.classList.toggle('show-filter');
        // Show close button when sidebar is open
        closeFilters.style.display = 'block';
    });

    // Close filter sidebar for mobile view
    closeFilters.addEventListener('click', function() {
        filterSidebar.classList.remove('show-filter');
        // Hide close button when sidebar is closed
        closeFilters.style.display = 'none';
    });

    // Toggle heart icon state
    document.querySelectorAll('.btn-heart').forEach(btn => {
        btn.addEventListener('click', function() {
            this.classList.toggle('liked');
            const heartIcon = this.querySelector('i');

            // Toggle between solid (fas) and regular (far) heart icon
            if (this.classList.contains('liked')) {
                heartIcon.classList.remove('far');
                heartIcon.classList.add('fas');
            } else {
                heartIcon.classList.remove('fas');
                heartIcon.classList.add('far');
            }

            const boardingId = this.dataset.id;
            console.log('Toggled bookmark for boarding:', boardingId);
        });
    });

    // Filter reset logic
    document.getElementById('resetFilters').addEventListener('click', function() {
        document.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
        document.getElementById('priceMin').value = '';
        document.getElementById('priceMax').value = '';
    });

    // Filter apply logic
    document.getElementById('applyFilters').addEventListener('click', function() {
        // Close the sidebar after applying filters on mobile
        if(window.innerWidth < 992) {
            filterSidebar.classList.remove('show-filter');
        }
        alert('Filters applied! Replace with actual filtering logic.');
    });

});
</script>
@endpush
@endsection
