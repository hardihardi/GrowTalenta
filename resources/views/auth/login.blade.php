<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <!-- icon -->
    <link rel="icon" type="image/png" href="https://iili.io/2rOi5VR.th.png" />

    <style>
        /* Google Fonts - Poppins */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .video-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            overflow: hidden;
        }

        .video-bg video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .container {
            position: absolute;
            z-index: 1;
            width: 100%;
            max-width: 430px;
            padding: 30px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            cursor: grab;
        }

        .container:active {
            cursor: grabbing;
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

        .field {
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
            border: 1px solid #CACACA;
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
            .container {
                padding: 20px 10px;
            }

        }
    </style>
</head>

<body>
    <div class="video-bg">
        <video src="/videos/grow.mp4" autoplay muted loop style="background-color: gray;"></video>
    </div>

    <section class="container forms" id="draggable">
        <div class="form login">
            <div class="form-content">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <img src={{ asset('admin/assets/img/logo/logo.png') }} alt="Logo" class="app-brand-logo" style="max-width: 100%; height: auto;">
                    <header>Login</header>
                    <div class="field input-field">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="field input-field">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
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

        togglePassword.addEventListener("click", function () {
            // Toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // Toggle the eye icon
            this.classList.toggle('bx-hide');
            this.classList.toggle('bx-show');
        });

        const draggable = document.getElementById('draggable');
        let isDragging = false;
        let offsetX, offsetY;

        draggable.addEventListener('mousedown', (e) => {
            if (e.button === 2) { // Left mouse button
                isDragging = true;
                offsetX = e.clientX - draggable.offsetLeft;
                offsetY = e.clientY - draggable.offsetTop;
                draggable.style.position = 'absolute';
            }
        });

        document.addEventListener('mousemove', (e) => {
            if (isDragging) {
                draggable.style.left = `${e.clientX - offsetX}px`;
                draggable.style.top = `${e.clientY - offsetY}px`;
            }
        });

        document.addEventListener('mouseup', () => {
            isDragging = false;
        });

        // Touch events for mobile
        draggable.addEventListener('touchstart', (e) => {
            if (e.touches.length === 1) {
                isDragging = true;
                const touch = e.touches[0];
                offsetX = touch.clientX - draggable.offsetLeft;
                offsetY = touch.clientY - draggable.offsetTop;
                draggable.style.position = 'absolute';
            }
        });

        document.addEventListener('touchmove', (e) => {
            if (isDragging && e.touches.length === 1) {
                const touch = e.touches[0];
                draggable.style.left = `${touch.clientX - offsetX}px`;
                draggable.style.top = `${touch.clientY - offsetY}px`;
            }
        });

        document.addEventListener('touchend', () => {
            isDragging = false;
        });

        // Prevent context menu on right click
        document.addEventListener('contextmenu', (e) => e.preventDefault());
    </script>

</body>

</html>
