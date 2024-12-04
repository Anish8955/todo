<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo - Login</title>
    <style>
        body{
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: #ffffff;
            padding: 70px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .login-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .login-container input[type="email"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            
        }
        .login-container button:hover {
            background-color: #218838;
        }
        .login-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .login-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
 <section>

        <div class="login-container">
            <h1>To Do  Login</h1>
            <form action="{{route('loginpost')}}" method="post">
                @csrf
                  <input type="email" name="email" placeholder="Enter Your Email Here.." required>
                  <input type="password" name="password" placeholder="Enter Your Password Here.." required>
                   <button type="submit">Login</button>
            </form>
            <a href="{{route('signuppage')}}">New User? SignUp Here</a>
        </div>

 </section>
    
</body>
</html>