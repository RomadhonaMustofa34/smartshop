<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    * {
      box-sizing: border-box;
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, rgb(229, 233, 234) 0%, #a084e8 100%);
      color: #333;
      margin: 0;
      padding: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .container {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      transition: all 0.3s ease;
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      font-weight: 600;
      color: #6c63ff;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      font-size: 14px;
      color: #555;
      margin-bottom: 6px;
      display: block;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      font-size: 14px;
      border: 1.5px solid #ccc;
      border-radius: 8px;
      transition: 0.3s;
      font-family: 'Poppins', sans-serif;
    }

    input[type="email"]:focus,
    input[type="password"]:focus {
      border-color: #6c63ff;
      outline: none;
      box-shadow: 0 0 8px rgba(108, 99, 255, 0.4);
    }

    .btn-group {
      display: flex;
      gap: 15px;
      margin-top: 10px;
    }

    button,
    .btn-cancel {
      flex: 1;
      padding: 12px;
      font-weight: 600;
      font-size: 15px;
      border-radius: 8px;
      cursor: pointer;
      border: none;
      font-family: 'Poppins', sans-serif;
      transition: background 0.3s ease, color 0.3s ease;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      user-select: none;
    }

    button {
      background: #6c63ff;
      color: white;
    }

    button:hover {
      background: #554ed6;
    }

    .btn-cancel {
      background: transparent;
      border: 2px solid #6c63ff;
      color: #6c63ff;
      line-height: 1;
      padding-top: 10px;
      padding-bottom: 10px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .btn-cancel:hover {
      background: #6c63ff;
      color: white;
      border-color: #6c63ff;
    }

    p {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
      color: #666;
    }

    p a {
      color: #6c63ff;
      font-weight: 600;
      text-decoration: none;
      transition: text-decoration 0.3s ease;
    }

    p a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Login</h1>
    <form action="{{ route('login.post') }}" method="POST">
      @csrf
      <div class="form-group">
        <label for="email">Email</label>
        <input placeholder="Masukkan email anda" type="email" id="email" name="email" required />
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input placeholder="Masukkan password anda" type="password" id="password" name="password" required />
      </div>
      <div class="btn-group">
        <button type="submit">Login</button>
        <a href="{{ route('home') }}" class="btn-cancel">Batal</a>
      </div>
    </form>
    <p>Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a></p>
  </div>
</body>
</html>
