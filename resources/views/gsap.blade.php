<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        html {
            height: 100vh;
        }

        body {
            height: 5000px;
            background: #000;
        }

        canvas {
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            max-width: 100vw;
            max-height: 100vh;
        }
    </style>
</head>

<body>

    <canvas id="hero-lightpass" />

    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Flip.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Observer.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollToPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/Draggable.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/MotionPathPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/EaselPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/PixiPlugin.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/TextPlugin.min.js"></script>
    <script>
        // use a script tag or an external JS file
        document.addEventListener("DOMContentLoaded", (event) => {
            gsap.registerPlugin(Flip, ScrollTrigger, Observer, ScrollToPlugin, Draggable, MotionPathPlugin,
                EaselPlugin, PixiPlugin, TextPlugin)
            // =>START<=
            console.clear();

            const canvas = document.getElementById("hero-lightpass");
            const context = canvas.getContext("2d");

            canvas.width = 1158;
            canvas.height = 770;

            const frameCount = 147;
            const currentFrame = index => (
                `https://www.apple.com/105/media/us/airpods-pro/2019/1299e2f5_9206_4470_b28e_08307a42f19b/anim/sequence/large/01-hero-lightpass/${(index + 1).toString().padStart(4, '0')}.jpg`
            );

            const images = []
            const airpods = {
                frame: 0
            };

            for (let i = 0; i < frameCount; i++) {
                const img = new Image();
                img.src = currentFrame(i);
                images.push(img);
            }

            gsap.to(airpods, {
                frame: frameCount - 1,
                snap: "frame",
                ease: "none",
                scrollTrigger: {
                    scrub: 0.5
                },
                onUpdate: render // use animation onUpdate instead of scrollTrigger's onUpdate
            });

            images[0].onload = render;

            function render() {
                context.clearRect(0, 0, canvas.width, canvas.height);
                context.drawImage(images[airpods.frame], 0, 0);
            }

            // =>END<=
            gsap.to('.box', {
                scrollTrigger: '.box', // start the animation when ".box" enters the viewport (once)
                x: 500
            });
        });
    </script>
</body>

</html>
