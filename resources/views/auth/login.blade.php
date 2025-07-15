{{-- resources/views/auth/custom-login.blade.php --}}
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <title>Connexion Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --background-color: #1a1a1a;
      --default-color: rgba(255, 255, 255, 0.85);
      --heading-color: #ffffff;
      --accent-color: #ff114d;
      --surface-color: #2e2e2e;
    }

    body {
      background-color: var(--background-color);
      color: var(--default-color);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-box {
      background-color: var(--surface-color);
      padding: 3rem;
      border-radius: 1.5rem;
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.5);
      width: 100%;
      max-width: 430px;
      transition: transform 0.3s;
    }

    .login-box:hover {
      transform: scale(1.02);
    }

    .login-box h2 {
      color: var(--heading-color);
      margin-bottom: 1.5rem;
    }

    .form-label {
      color: var(--default-color);
    }

    .form-control {
      background-color: #121212;
      border: 1px solid #444;
      color: #fff;
    }

    .form-control::placeholder {
      color: rgba(255, 255, 255, 0.5);
    }

    .form-control:focus {
      border-color: var(--accent-color);
      box-shadow: 0 0 0 0.2rem rgba(255, 17, 77, 0.25);
    }

    .btn-primary {
      background-color: var(--accent-color);
      border: none;
      transition: background-color 0.3s;
    }

    .btn-primary:hover {
      background-color: #e0003f;
    }

    .alert-danger {
      color: #ff4d4d;
      background-color: rgba(255, 17, 77, 0.1);
      border: 1px solid var(--accent-color);
      margin-bottom: 1rem;
    }

    .btn-facebook {
      background-color: #1877f2 !important;
      color: white !important;
      border: 1px solid #166fe5 !important;
      transition: all 0.3s;
    }

    .btn-facebook:hover {
      background-color: #166fe5 !important;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
    }

    .bi-facebook {
      font-size: 1.2rem;
      margin-right: 8px;
    }
  </style>
</head>
<body>

<div class="login-box">
  <h2 class="text-center">
    <i class="bi bi-person-lock me-3"></i>Users connexion
  </h2>

  @if ($errors->any())
    <div class="alert alert-danger text-center">
      {{ $errors->first() }}
    </div>
  @endif

  @if (session('status'))
    <div class="alert alert-success text-center">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="mb-2">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="exemple@gmail.com" required autofocus>
    </div>

    <div class="mb-2">
      <label for="password" class="form-label">Mot de passe</label>
      <input type="password" class="form-control" id="password" name="password" placeholder="**********" required>
    </div>

    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" name="remember" id="remember">
      <label class="form-check-label" for="remember">
        Se souvenir de moi
      </label>
    </div>

    <button type="submit" class="btn btn-primary w-100 mt-3">
      <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
    </button>
  </form>

  <div class="text-center mt-3">
    <a href="#" class="btn btn-facebook d-flex align-items-center justify-content-center">
      <i class="bi bi-facebook"></i> Continuer avec Facebook
    </a>
  </div>

  <div class="text-center mt-3">
    <a href="{{ route('register') }}" class="text-primary text-decoration-none">Pas encore de compte ? Inscrivez-vous</a>
  </div>

  <div class="text-center mt-2">
    <a href="{{ url('/') }}" class="text-primary text-decoration-none">
      <i class="bi bi-arrow-left me-1"></i>Retour à l'accueil
    </a>
  </div>
</div>

</body>
</html>
