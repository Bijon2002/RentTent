@extends('Layout.master_dash')

@section('content')
<div class="d-flex align-items-center justify-content-center w-100 animated-gradient-bg" style="min-height:100vh;">
		<div class="card shadow-lg border-0 rounded-4 text-center p-4" style="max-width:600px; width:100%; background:white;">
				<h2 class="fw-bold mb-3">Welcome to Your Dashboard.!</h2>
				<p class="text-muted">Here you can view your profile, recent activities and more.</p>
				<!-- Add dashboard widgets/content here -->
		</div>
</div>
@endsection

@push('styles')
<style>
	.animated-gradient-bg {
		background: linear-gradient(120deg, #0a2540, #4f8cff, #0a2540);
		background-size: 200% 200%;
		animation: gradientMove 8s ease-in-out infinite;
	}
	@keyframes gradientMove {
		0% { background-position: 0% 50%; }
		50% { background-position: 100% 50%; }
		100% { background-position: 0% 50%; }
	}
</style>
@endpush
