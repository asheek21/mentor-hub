@extends('components.email-layout')


@section('message')
    Great news! Your session booking has been confirmed and payment has been processed successfully. Your session is now
    <strong>pending mentor approval</strong>.
    <br><br>
    We've notified your mentor about your booking request, and you'll receive another email once they approve the session.
    This typically happens within 24 hours.
@endsection

@section('slot')
    <div class="session-card">
        <h3>📅 Session Details</h3>
        <table class="session-details" width="100%">
            <tr>
                <td class="label">Booking ID:</td>
                <td class="value">#{{ $booking->reference_number }}</td>
            </tr>
            <tr>
                <td class="label">Date & Time:</td>
                <td class="value">{{ \Carbon\Carbon::parse($booking->schedule)->format('l, F j, Y \a\t g:i A') }}</td>
            </tr>
            <tr>
                <td class="label">Duration:</td>
                <td class="value">{{ $booking->duration }} minutes</td>
            </tr>
            <tr>
                <td class="label">Session Type:</td>
                <td class="value">Video Call</td>
            </tr>
            <tr>
                <td class="label">Amount Paid:</td>
                <td class="value">{{ rupeeFormatter($booking->price) }}</td>
            </tr>
            <tr>
                <td class="label">Status:</td>
                <td class="value" style="color: #f59e0b; font-weight: 600;">Pending Approval</td>
            </tr>
        </table>
    </div>

    <div class="mentor-info">
        <img src="{{ $mentor->profile_picture }}" alt="{{ $mentor->full_name }}" class="mentor-avatar">
        <div class="mentor-details">
            <h4>{{ $mentor->full_name }}</h4>
            <p>{{ $mentor->mentorProfile->current_role }}</p>
        </div>
    </div>

    <div class="next-steps">
        <h4>🔔 What happens next?</h4>
        <ul>
            <li><strong>Mentor Review:</strong> {{ $mentor->full_name }} will review your booking request within 24 hours</li>
            <li><strong>Approval Notification:</strong> You'll receive an email confirmation once the session is approved
            </li>
            <li><strong>Calendar Invite:</strong> After approval, you'll get a calendar invite with the meeting link</li>
            <li><strong>Session Preparation:</strong> Start preparing your questions and materials for the session</li>
        </ul>
    </div>
@endsection
