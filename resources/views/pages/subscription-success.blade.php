@extends('layout.master_entity')

@section('title', 'Subscription Successful!')

@section('content')
<div class="container py-5 text-center">
    <h2 class="mb-4 text-success">✅ Subscription Successful..!</h2>
    <p>You have successfully subscribed to <strong>{{ $menu->name }}</strong> by <strong>{{ $menu->user->name }}</strong>.</p>

    <div class="my-4">
        <h5>QR Code for your Subscription:</h5>
        {!! $qr_image !!}
    </div>

    <div class="mt-3">
        <p>Amount Paid: Rs. {{ number_format($subscription->amount, 2) }}</p>
       
    </div>

    <a href="{{ route('foodplans.index') }}" class="btn btn-primary mt-4">Back to Marketplace</a>
</div>
@endsection
