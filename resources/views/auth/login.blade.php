<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /* Google Fonts - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        .container {
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #4070f4;
            column-gap: 30px;
        }

        .form {
            position: absolute;
            max-width: 430px;
            width: 100%;
            padding: 30px;
            border-radius: 6px;
            background: #FFF;
        }

        .form.signup {
            opacity: 0;
            pointer-events: none;
        }

        .forms.show-signup .form.signup {
            opacity: 1;
            pointer-events: auto;
        }

        .forms.show-signup .form.login {
            opacity: 0;
            pointer-events: none;
        }

        header {
            font-size: 28px;
            font-weight: 600;
            color: #232836;
            text-align: center;
        }

        form {
            margin-top: 30px;
        }

        .form .field {
            position: relative;
            height: 50px;
            width: 100%;
            margin-top: 20px;
            border-radius: 6px;
        }

        .field input,
        .field button {
            height: 100%;
            width: 100%;
            border: none;
            font-size: 16px;
            font-weight: 400;
            border-radius: 6px;
        }

        .field input {
            outline: none;
            padding: 0 15px;
            border: 1px solid#CACACA;
        }

        .field input:focus {
            border-bottom-width: 2px;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #8b8b8b;
            cursor: pointer;
            padding: 5px;
        }

        .field button {
            color: #fff;
            background-color: #0171d3;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .field button:hover {
            background-color: #016dcb;
        }

        .form-link {
            text-align: center;
            margin-top: 10px;
        }

        .form-link span,
        .form-link a {
            font-size: 14px;
            font-weight: 400;
            color: #232836;
        }

        .form a {
            color: #0171d3;
            text-decoration: none;
        }

        .form-content a:hover {
            text-decoration: underline;
        }

        .line {
            position: relative;
            height: 1px;
            width: 100%;
            margin: 36px 0;
            background-color: #d4d4d4;
        }

        .line::before {
            content: 'Or';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #FFF;
            color: #8b8b8b;
            padding: 0 15px;
        }

        .media-options a {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        img.google-img {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
        }

        img.google-img {
            height: 20px;
            width: 20px;
            object-fit: cover;
        }

        a.google {
            border: 1px solid #CACACA;
        }

        a.google span {
            font-weight: 500;
            opacity: 0.6;
            color: #232836;
        }

        @media screen and (max-width: 400px) {
            .form {
                padding: 20px 10px;
            }

        }
    </style>
</head>

<body>
    <section class="container forms">
        <div class="form login">
            <div class="form-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <header>Login</header>
                    <form action="#">
                        <div class="field input-field">
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="field input-field">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <i class='bx bx-hide eye-icon' id="togglePassword"></i>
                        </div>

                        <div class="field button-field">
                            <button type="submit">Login</button>
                        </div>
                    </form>
                </form>
            </div>

            <div class="line"></div>
            <div class="media-options">
                <a href="{{ route('redirect') }}" class="field google">
                    <img src="{{ asset('admin/assets/img/google.png') }}" alt="" class="google-img">
                    <span>Login with Google</span>
                </a>
            </div>

        </div>
    </section>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // Toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Toggle the eye icon
            this.classList.toggle('bx-hide');
            this.classList.toggle('bx-show');
        });
    </script>

</body>

</html>
