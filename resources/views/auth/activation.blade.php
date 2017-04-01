Hi, {{ $name }}
<br>
Please active your account: 
<a href="{{ route('users.activation', ['id' => $email, 'token' => $link]) }}">Click Here</a>
