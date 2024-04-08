<!DOCTYPE html>
<html>

<head>
    <title>{{ config('app.name') }} Password Reset</title>
</head>

<body>
    <h1>{{ config('app.name') }} Password Reset</h1>

    <p>Hello {{ $user->name }},</p>

    <p>You are receiving this email because we received a password reset request for your account.</p>

    <p>
        Click the following link to reset your password:
        <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
    </p>

    <p>If you did not request a password reset, no further action is required.</p>

    <p>Thank you,</p>
    <p>{{ config('app.name') }} Team</p>
</body>

</html>
