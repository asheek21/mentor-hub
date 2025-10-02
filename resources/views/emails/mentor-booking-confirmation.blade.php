@extends('components.email-layout')


@section('message')
    You have received a new session booking request! A mentee has booked a session with you and completed their payment.
    <br><br>
    <strong>Please review the details below and approve or decline this session within 24 hours.</strong>
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
                <td class="label">Requested Date:</td>
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
                <td class="value" style="color: #f59e0b; font-weight: 600;"> Awaiting Your Approval</td>
            </tr>
        </table>
    </div>

    <div class="mentor-info">
        <img src="{{ $mentee->profile_picture }}" alt="{{ $mentee->full_name }}" class="mentor-avatar">
        <div class="mentor-details">
            <h4>{{ $mentee->full_name }}</h4>
            <p>{{ $mentee->menteeProfile->current_role }}</p>
            <p>📧 {{ $mentee->email }}</p>
        </div>
    </div>

    <div class="next-steps">
        <h4>Response Timeline</h4>
        <ul>
            <li><strong>Please respond within 24 hours</strong> to maintain a good mentor rating</li>
            <li><strong>If approved, the session will be confirmed and calendar invites sent </li>
            <li><strong>If declined, the mentee will be refunded and notified</li>
            <li><strong>Auto-decline after 24 hours if no response</li>
        </ul>
    </div>
@endsection
