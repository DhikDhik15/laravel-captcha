<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    {!! NoCaptcha::renderJs() !!}
</head>

<body>
    <h2>Login</h2>

    @if ($errors->any())
        <ul style="color:red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}"><br>

        <label>Password</label>
        <input type="password" name="password"><br>

        {!! NoCaptcha::display() !!}

        <button type="submit">Login</button>
    </form>
</body>

</html>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
