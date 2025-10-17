<!DOCTYPE html>
<html>
<head>
    <title>Logo Test</title>
</head>
<body>
    <h1>Logo Test Page</h1>
    <p>Testing direct access to logo:</p>
    <img src="{{ asset('images/pawpal-logo.png') }}" alt="PawPal Logo" style="width: 64px; height: 64px; border: 1px solid red;">
    <br><br>
    <p>Asset URL: {{ asset('images/pawpal-logo.png') }}</p>
    <br>
    <p>Testing with cache buster:</p>
    <img src="{{ asset('images/pawpal-logo.png') }}?v={{ time() }}" alt="PawPal Logo" style="width: 64px; height: 64px; border: 1px solid blue;">
</body>
</html>