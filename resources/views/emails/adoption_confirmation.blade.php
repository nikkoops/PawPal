<!DOCTYPE html>
<html>
<head>
    <title>PawPal Adoption Confirmation</title>
</head>
<body>
    <h2>Hi {{ $adopterData['name'] }},</h2>
    <p>Thank you for submitting your adoption form at PawPal!</p>

    <p>Here’s a summary of your submission:</p>
    <ul>
        <li><strong>Pet Name:</strong> {{ $adopterData['pet_name'] }}</li>
        <li><strong>Email:</strong> {{ $adopterData['email'] }}</li>
        <li><strong>Message:</strong> {{ $adopterData['message'] }}</li>
    </ul>

    <p>We’ll get in touch with you soon regarding your adoption request.</p>

    <p>Best regards,  
    <br>PawPal Team 🐾</p>
</body>
</html>
