<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>

        <style type="text/css">
        /* Reset styles */
        body, table, td, p, a, li, blockquote {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table, td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        /* Email styles */
        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            background-color: #f4f4f4;
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }

        .header {
            background-color: #3b82f6;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: bold;
            margin: 0;
            line-height: 1.2;
        }

        .content {
            padding: 40px;
        }

        .status-badge {
            display: inline-block;
            background-color: #fbbf24;
            color: #92400e;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .greeting {
            font-size: 18px;
            color: #1f2937;
            margin-bottom: 20px;
            line-height: 1.5;
        }

        .message {
            font-size: 16px;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .session-card {
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            margin: 30px 0;
            background-color: #f9fafb;
        }

        .session-card h3 {
            color: #1f2937;
            font-size: 18px;
            font-weight: 600;
            margin: 0 0 16px 0;
        }

        .session-details {
            margin: 0;
            padding: 0;
        }

        .session-details tr {
            border-bottom: 1px solid #e5e7eb;
        }

        .session-details tr:last-child {
            border-bottom: none;
        }

        .session-details td {
            padding: 12px 0;
            font-size: 14px;
            vertical-align: top;
        }

        .session-details .label {
            color: #6b7280;
            font-weight: 500;
            width: 130px;
        }

        .session-details .value {
            color: #1f2937;
            font-weight: 600;
        }

        .mentor-info {
            display: flex;
            align-items: center;
            margin: 20px 0;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .mentor-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            margin-right: 16px;
        }

        .mentor-details h4 {
            margin: 0 0 4px 0;
            font-size: 16px;
            font-weight: 600;
            color: #1f2937;
        }

        .mentor-details p {
            margin: 0;
            font-size: 14px;
            color: #6b7280;
        }

        .next-steps {
            background-color: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }

        .next-steps h4 {
            color: #1e40af;
            font-size: 16px;
            font-weight: 600;
            margin: 0 0 12px 0;
        }

        .next-steps ul {
            margin: 0;
            padding-left: 20px;
            color: #1e40af;
        }

        .next-steps li {
            margin-bottom: 8px;
            font-size: 14px;
            line-height: 1.5;
        }

        .cta-button {
            display: inline-block;
            background-color: #3b82f6;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 10px 20px 0;
            text-align: center;
        }

        .secondary-button {
            display: inline-block;
            background-color: #ffffff;
            color: #3b82f6;
            text-decoration: none;
            padding: 14px 28px;
            border: 2px solid #3b82f6;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 10px 20px 0;
            text-align: center;
        }

        .footer {
            background-color: #f9fafb;
            padding: 30px 40px;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .footer p {
            margin: 0 0 10px 0;
            color: #6b7280;
            font-size: 14px;
            line-height: 1.5;
        }

        .footer a {
            color: #3b82f6;
            text-decoration: none;
        }

        .social-links {
            margin: 20px 0;
        }

        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #6b7280;
            font-size: 18px;
            text-decoration: none;
        }

        @media only screen and (max-width: 600px) {
            .content {
                padding: 20px !important;
            }

            .header {
                padding: 20px !important;
            }

            .header h1 {
                font-size: 24px !important;
            }

            .mentor-info {
                flex-direction: column;
                text-align: center;
            }

            .mentor-avatar {
                margin: 0 0 12px 0;
            }

            .cta-button, .secondary-button {
                display: block;
                margin: 10px 0;
            }
        }
    </style>
</head>
<body>
     <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
        <tr>
             <td>
                <div class="email-container">
                    <div class="header">
                        <h1>{{ config('app.name') }}</h1>
                    </div>

                     <div class="content">
                        <div class="greeting">
                            Hi, {{ $name }}
                        </div>

                        <div class="message">
                            @yield('message')
                        </div>

                        @yield('slot')
                     </div>

                    <div class="footer">
                        <p><strong>Need help?</strong> Contact our support team at <a href="mailto:support@skillbridge.com">support@skillbridge.com</a></p>
                        <p>or visit our <a href="https://skillbridge.com/help">Help Center</a></p>

                        <p style="font-size: 12px; color: #9ca3af; margin-top: 20px;">
                            You're receiving this email because you are part of {{ config('app.name') }}.<br>
                        </p>

                        <p style="font-size: 12px; color: #9ca3af; margin-top: 10px;">
                            {{ config('app.name') }} Inc. | 123 Tech Street, San Francisco, CA 94105<br>
                            <a href="#" style="color: #6b7280;">Unsubscribe</a> | <a href="#" style="color: #6b7280;">Privacy Policy</a>
                        </p>
                    </div>
                </div>
             </td>
        </tr>
     </table>
</body>
</html>
