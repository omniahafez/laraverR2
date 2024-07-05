<!DOCTYPE html>
<html>
<head>
    <title>New Message Notification</title>
</head>
<body>
    <h1>New Message Received</h1>
    <p><strong>Full Name:</strong> {{ $data['fullName'] }}</p>
    <p><strong>Email:</strong> {{ $data['email'] }}</p>
    <p><strong>Message:</strong> {{ $data['messageContent'] }}</p>
</body>
</html>