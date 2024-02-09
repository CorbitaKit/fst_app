<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Page</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .image-container {
            flex: 1;
            background: url('/images/login-page.jpeg') center/cover no-repeat;
            background-size: cover;
        }

        .form-container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f4f4f4;
            /* Form container background color */
        }

        .login-form {
            width: 50%;
            padding: 80px;
            /* Adjust the padding as needed */
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background: #ffffff;
            /* Form background color */
        }

        .form-group {
            margin-bottom: 40px;
        }

        label {
            display: block;
            margin-bottom: 16px;
        }

        input {
            width: 100%;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 18px;
        }

        button {
            width: 100%;
            padding: 20px;
            background: #007bff;
            /* Button background color */
            color: #ffffff;
            /* Button text color */
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 20px;
        }

        #error-message {
            margin-bottom: 5px;
            color: red;
        }
    </style>
</head>

<body>

    <div class="image-container"></div>

    <div class="form-container">
        <form class="login-form" onsubmit="handleLogin(event)">
            @csrf
            <div id="error-message" class="text-danger"></div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
    <script>
        async function handleLogin(event) {
            event.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            try {
                const response = await fetch('/login', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        email,
                        password
                    }),
                });

                if (response.ok) {
                    const responseData = await response.json();

                    document.cookie = `token=${response.token}; path=/; samesite=lax; secure`;
                    window.location.href = '/home'
                } else {
                    document.getElementById('error-message').innerText = "Invalid Credentials";
                }
            } catch (error) {
                console.error('Error:', error);
            }
        }
    </script>

</body>

</html>