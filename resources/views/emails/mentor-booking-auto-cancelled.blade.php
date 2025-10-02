@extends('components.email-layout')


@section('message')
    The {{ $booking->meeting_heading }} session (Booking ID: {{ $booking->reference_number }}) with {{ $mentee->full_name }},
    scheduled for {{ $booking->schedule->format('l, F j, Y \a\t g:i A') }},
    was <strong>automatically cancelled</strong> because it remained pending for more than 24 hours.
@endsection
