<!DOCTYPE html>
<html lang="en">
<head>
<style>
    body { font-family: Arial, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
    .login-container { background: #fff; padding: 40px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); width: 300px; text-align: center; }
    h2 { margin-bottom: 25px; color: #333; }
    input { width: 100%; padding: 12px; margin: 10px 0; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
    button { width: 100%; padding: 12px; background-color: #5c67f2; border: none; border-radius: 5px; color: white; font-size: 16px; cursor: pointer; }
    button:hover { background-color: #4a54e1; }
    .footer { margin-top: 15px; font-size: 14px; color: #777; }
</style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="{{route('login.submit')}}" method="post">
            @csrf

        <input type="text" placeholder="Username" required>
        <input type="password" placeholder="Password" required>
        <button type ="submit">Login</button>
        </form>

        <a href ="" class="forgot-pass">Forgot Password</a>
    </div>
</body>
</html>