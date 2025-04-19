<!DOCTYPE html>
<html>
<head>
    <title>Temporary Password</title>
</head>
<body>
    <h2>Hello {{ $name }},</h2>
    <p>You recently requested to reset your password. Here is your temporary password:</p>
    
    <div style="background: #f4f4f4; padding: 10px; margin: 10px 0;">
        <strong>Temporary Password:</strong> {{ $temporaryPassword }}
    </div>
    
    <p>Please use this password to log in. You will be prompted to change it immediately after logging in.</p>
    
    <p>If you didn't request this password reset, please contact our support team immediately.</p>
    
    <p>Thanks,<br>
    {{ config('app.name') }}</p>
</body>
</html>