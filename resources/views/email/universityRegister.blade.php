<!DOCTYPE html>
<html>
<body>
    <h2>Hello {{ $name }},</h2>

    <p>Your university has been successfully registered on <strong>Alumni Connect</strong>.</p>

    <p><strong>Email:</strong> {{ $email }}</p>
    <p><strong>Phone:</strong> {{ $phone }}</p>

    <p>You can now login and manage your university profile.</p>

    <p>
        <a href="{{ $loginUrl }}"
           style="display:inline-block;padding:10px 18px;background:#0d6efd;color:#fff;text-decoration:none;border-radius:5px;">
            Login to Alumni Connect
        </a>
    </p>

    <br>
    <p>Regards,<br>Alumni Connect Team</p>
</body>
</html>
