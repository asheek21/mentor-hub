@extends('components.email-layout')


@section('message')
   The {{ $booking->meeting_heading }} session (Booking ID: {{ $booking->reference_number }}) with {{ $mentor->full_name }},
   scheduled for {{ $booking->schedule->format('l, F j, Y \a\t g:i A') }},
   was <strong>automatically cancelled</strong> because it remained pending for more than 24 hours.
@endsection

@section('slot')

    <div class="next-steps">
        <h4>🔔 What to do next ?</h4>
        <ol>
            <li>Login to your account</li>
            <li>Navigate to Sessions → <strong>Cancelled</strong> tab</li>
            <li>Locate your cancelled booking in the list</li>
            <li>Select either:</li>
            <ul>
                <li>📅 <strong>Rebook</strong> - Reschedule with the same mentor</li>
                <li>💸 <strong>Request Refund</strong> - Get your payment refunded</li>
            </ul>
        </ol>
    </div>
@endsection
