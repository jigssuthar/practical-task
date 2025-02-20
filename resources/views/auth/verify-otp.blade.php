<form method="POST" action="{{ route('otp.verify', $user->id) }}">
    @csrf
    <label for="otp">Enter OTP:</label>
    <input type="text" name="otp" required>
    <button type="submit">Verify OTP</button>
</form>
