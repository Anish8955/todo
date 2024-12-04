<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ToDo - SignUp</title>
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
        .signup-container {
            background: #ffffff;
            padding: 70px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        .signup-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .signup-container input[type="text"],
        .signup-container input[type="email"],
        .signup-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .signup-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            
        }
        .signup-container button:hover {
            background-color: #218838;
        }
        .signup-container a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
        .signup-container a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <section>

        <div class="signup-container">
            <h1> To Do  Sign Up</h1>
            <form action="{{route('signupost')}}" method="post">
                @csrf
                  <input type="text" name="name" placeholder="Enter Your Name Here.." required>
                  <input type="email" name="email" placeholder="Enter Your Email Here.." required>
                  <input type="password" name="password" placeholder="Enter Your Password Here.." required>
                   <button type="submit">Sign Up</button>
            </form>
            <a href="{{route('loginpage')}}">Already User? Login Here</a>
        </div>

 </section>
</body>
</html>