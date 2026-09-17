<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cravecourt</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #fbf4ed;
        }


        /* =====================================================
           SPLASH SCREEN
        ===================================================== */

        .splash {
            position: fixed;
            inset: 0;

            width: 100%;
            height: 100%;

            z-index: 99999;

            display: flex;
            align-items: center;
            justify-content: center;

            overflow: hidden;

            background:
                radial-gradient(
                    circle at center,
                    #fffaf6 0%,
                    #fcf5ef 55%,
                    #faeee8 100%
                );

            opacity: 1;

            transition:
                opacity 1.2s ease,
                transform 1.2s ease;
        }


        /* =====================================================
           SAAT SPLASH KELUAR
        ===================================================== */

        .splash.leaving {
            opacity: 0;

            transform: scale(1.015);

            pointer-events: none;
        }


        /* =====================================================
           GELEMBUNG
        ===================================================== */

        .bubble {
            position: absolute;

            border-radius: 50%;

            pointer-events: none;

            background:
                radial-gradient(
                    circle at 30% 25%,
                    rgba(255,255,255,0.70) 0%,
                    rgba(255,220,210,0.42) 22%,
                    rgba(231,139,130,0.17) 60%,
                    rgba(231,139,130,0.07) 100%
                );

            border: 2px solid rgba(218,126,117,0.10);

            box-shadow:
                inset 8px 8px 20px rgba(255,255,255,0.35),
                inset -10px -10px 25px rgba(219,125,116,0.06);

            opacity: 0;

            animation:
                bubbleIn 1.3s ease forwards,
                bubbleMove 7s ease-in-out infinite;
        }


        .bubble::before {
            content: "";

            position: absolute;

            width: 24%;
            height: 15%;

            top: 18%;
            left: 18%;

            border-radius: 50%;

            background: rgba(255,255,255,0.75);

            transform: rotate(-35deg);

            filter: blur(2px);
        }


        .bubble::after {
            content: "";

            position: absolute;

            width: 10%;
            height: 7%;

            top: 32%;
            left: 30%;

            border-radius: 50%;

            background: rgba(255,255,255,0.50);

            filter: blur(1px);
        }


        /* KIRI ATAS */

        .bubble-1 {
            width: 330px;
            height: 330px;

            top: -145px;
            left: -100px;

            animation-delay: 0.1s, 1.4s;
        }


        /* KIRI ATAS KECIL */

        .bubble-2 {
            width: 105px;
            height: 105px;

            top: 20%;
            left: 15%;

            animation-delay: 0.25s, 1.8s;
        }


        /* KIRI BAWAH */

        .bubble-3 {
            width: 75px;
            height: 75px;

            bottom: 10%;
            left: 7%;

            animation-delay: 0.4s, 2.1s;
        }


        /* BAWAH */

        .bubble-4 {
            width: 180px;
            height: 180px;

            bottom: -90px;
            left: 22%;

            animation-delay: 0.5s, 2.5s;
        }


        /* KANAN ATAS */

        .bubble-5 {
            width: 62px;
            height: 62px;

            top: 17%;
            right: 8%;

            animation-delay: 0.2s, 1.6s;
        }


        /* KANAN TENGAH */

        .bubble-6 {
            width: 120px;
            height: 120px;

            top: 45%;
            right: 7%;

            animation-delay: 0.35s, 2s;
        }


        /* KANAN BAWAH BESAR */

        .bubble-7 {
            width: 390px;
            height: 390px;

            right: -170px;
            bottom: -185px;

            animation-delay: 0.55s, 2.3s;
        }


        /* BUBBLE KECIL */

        .bubble-8 {
            width: 38px;
            height: 38px;

            right: 27%;
            bottom: 17%;

            animation-delay: 0.7s, 2.6s;
        }


        .bubble-9 {
            width: 45px;
            height: 45px;

            left: 27%;
            top: 10%;

            animation-delay: 0.8s, 2.8s;
        }


        .bubble-10 {
            width: 55px;
            height: 55px;

            right: 25%;
            bottom: 7%;

            animation-delay: 0.9s, 3s;
        }


        /* =====================================================
           CONTENT
        ===================================================== */

        .splash-content {
            position: relative;

            z-index: 20;

            display: flex;

            flex-direction: column;

            align-items: center;

            text-align: center;
        }


        /* =====================================================
           LOGO AREA
        ===================================================== */

        .logo-area {
            position: relative;

            width: 215px;
            height: 215px;

            display: flex;

            align-items: center;

            justify-content: center;

            opacity: 0;

            transform: scale(0.08);

            animation:
                logoEntrance 1.7s
                cubic-bezier(0.16, 1, 0.3, 1)
                0.15s forwards;
        }


        /* =====================================================
           GLOW
        ===================================================== */

        .logo-glow {
            position: absolute;

            width: 150px;
            height: 150px;

            border-radius: 50%;

            background: rgba(190,69,79,0.10);

            filter: blur(22px);

            opacity: 0;

            animation:
                glowIn 1.2s ease 0.7s forwards,
                glowPulse 3s ease-in-out 2s infinite;
        }


        /* =====================================================
           RING
        ===================================================== */

        .logo-ring {
            position: absolute;

            width: 175px;
            height: 175px;

            border-radius: 50%;

            border: 2px solid rgba(139,30,40,0.10);

            opacity: 0;

            animation:
                ringIn 1s ease 0.65s forwards,
                ringPulse 3s ease-out 1.8s infinite;
        }


        .logo-ring-2 {
            position: absolute;

            width: 210px;
            height: 210px;

            border-radius: 50%;

            border: 1px solid rgba(139,30,40,0.06);

            opacity: 0;

            animation:
                ringIn 1s ease 0.85s forwards,
                ringPulseTwo 3.5s ease-out 2s infinite;
        }


        /* =====================================================
           KOTAK LOGO
        ===================================================== */

        .logo-box {
            position: relative;

            z-index: 5;

            width: 112px;
            height: 112px;

            border-radius: 29px;

            background: white;

            display: flex;

            align-items: center;

            justify-content: center;

            box-shadow:
                0 20px 55px rgba(139,30,40,0.13);

            opacity: 0;

            transform: scale(0.25);

            animation:
                logoBoxEntrance 1.25s
                cubic-bezier(0.16, 1, 0.3, 1)
                0.4s forwards;
        }


        .logo-box img {
            width: 87px;
            height: 87px;

            object-fit: contain;

            opacity: 0;

            transform: scale(0.45);

            animation:
                logoImageEntrance 1s
                cubic-bezier(0.16, 1, 0.3, 1)
                0.75s forwards;
        }


        /* =====================================================
           NAMA
        ===================================================== */

        .brand-name {
            margin-top: 4px;

            color: #8b1e28;

            font-size: 40px;

            font-weight: 800;

            letter-spacing: -1.5px;

            opacity: 0;

            transform: translateY(20px);

            animation:
                brandEntrance 0.9s
                cubic-bezier(0.16, 1, 0.3, 1)
                1.35s forwards;
        }


        /* =====================================================
           TAGLINE
        ===================================================== */

        .tagline {
            margin-top: 8px;

            color: #8a6c66;

            font-size: 15px;

            opacity: 0;

            transform: translateY(12px);

            animation:
                taglineEntrance 0.8s ease 1.6s forwards;
        }


        /* =====================================================
           LOADING
        ===================================================== */

        .loading {
            margin-top: 30px;

            display: flex;

            flex-direction: column;

            align-items: center;

            opacity: 0;

            transform: translateY(10px);

            animation:
                loadingEntrance 0.8s ease 1.8s forwards;
        }


        .loading-track {
            width: 105px;

            height: 5px;

            border-radius: 999px;

            background: rgba(139,30,40,0.10);

            overflow: hidden;
        }


        .loading-bar {
            width: 0;

            height: 100%;

            border-radius: 999px;

            background: #9d3039;

            animation:
                loadingProgress 3.2s
                cubic-bezier(0.65,0,0.35,1)
                1.7s forwards;
        }


        .loading-text {
            margin-top: 10px;

            color: #a58780;

            font-size: 10px;

            letter-spacing: 3px;
        }


        /* =====================================================
           ANIMASI
        ===================================================== */

        @keyframes bubbleIn {

            0% {
                opacity: 0;
                transform: scale(0.75);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        @keyframes bubbleMove {

            0%,
            100% {
                margin-top: 0;
            }

            50% {
                margin-top: -14px;
            }
        }


        @keyframes logoEntrance {

            0% {
                opacity: 0;
                transform: scale(0.08);
            }

            45% {
                opacity: 1;
                transform: scale(1.12);
            }

            62% {
                transform: scale(0.94);
            }

            78% {
                transform: scale(1.04);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        @keyframes logoBoxEntrance {

            0% {
                opacity: 0;
                transform: scale(0.25) rotate(-8deg);
            }

            55% {
                opacity: 1;
                transform: scale(1.10) rotate(2deg);
            }

            75% {
                transform: scale(0.96) rotate(-1deg);
            }

            100% {
                opacity: 1;
                transform: scale(1) rotate(0deg);
            }
        }


        @keyframes logoImageEntrance {

            0% {
                opacity: 0;
                transform: scale(0.45);
            }

            60% {
                opacity: 1;
                transform: scale(1.08);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        @keyframes glowIn {

            0% {
                opacity: 0;
                transform: scale(0.4);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        @keyframes glowPulse {

            0%,
            100% {
                opacity: 0.45;
                transform: scale(0.92);
            }

            50% {
                opacity: 0.75;
                transform: scale(1.08);
            }
        }


        @keyframes ringIn {

            0% {
                opacity: 0;
                transform: scale(0.5);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }


        @keyframes ringPulse {

            0% {
                opacity: 0.45;
                transform: scale(0.88);
            }

            75% {
                opacity: 0;
                transform: scale(1.15);
            }

            100% {
                opacity: 0;
                transform: scale(1.15);
            }
        }


        @keyframes ringPulseTwo {

            0% {
                opacity: 0.30;
                transform: scale(0.88);
            }

            80% {
                opacity: 0;
                transform: scale(1.17);
            }

            100% {
                opacity: 0;
                transform: scale(1.17);
            }
        }


        @keyframes brandEntrance {

            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


        @keyframes taglineEntrance {

            0% {
                opacity: 0;
                transform: translateY(12px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


        @keyframes loadingEntrance {

            0% {
                opacity: 0;
                transform: translateY(10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }


        @keyframes loadingProgress {

            0% {
                width: 0;
            }

            100% {
                width: 100%;
            }
        }


        /* =====================================================
           MOBILE
        ===================================================== */

        @media (max-width: 600px) {

            .logo-area {
                width: 180px;
                height: 180px;
            }

            .logo-ring {
                width: 150px;
                height: 150px;
            }

            .logo-ring-2 {
                width: 180px;
                height: 180px;
            }

            .logo-box {
                width: 98px;
                height: 98px;
            }

            .logo-box img {
                width: 76px;
                height: 76px;
            }

            .brand-name {
                font-size: 32px;
            }

            .tagline {
                font-size: 12px;
            }

            .bubble-1 {
                width: 230px;
                height: 230px;
            }

            .bubble-7 {
                width: 260px;
                height: 260px;
            }
        }
    </style>
</head>


<body>

    <!-- =====================================================
         SPLASH
    ====================================================== -->

    <div class="splash" id="splash">


        <!-- =================================================
             GELEMBUNG
        ================================================== -->

        <div class="bubble bubble-1"></div>

        <div class="bubble bubble-2"></div>

        <div class="bubble bubble-3"></div>

        <div class="bubble bubble-4"></div>

        <div class="bubble bubble-5"></div>

        <div class="bubble bubble-6"></div>

        <div class="bubble bubble-7"></div>

        <div class="bubble bubble-8"></div>

        <div class="bubble bubble-9"></div>

        <div class="bubble bubble-10"></div>


        <!-- =================================================
             CONTENT
        ================================================== -->

        <div class="splash-content">


            <!-- LOGO -->

            <div class="logo-area">

                <div class="logo-glow"></div>

                <div class="logo-ring"></div>

                <div class="logo-ring-2"></div>


                <div class="logo-box">

                    <img
                        src="{{ asset('assets/images/LOGO CRAVECOURT.png') }}"
                        alt="Logo Cravecourt"
                    >

                </div>

            </div>


            <!-- NAMA -->

            <div class="brand-name">
                Cravecourt
            </div>


            <!-- TAGLINE -->

            <div class="tagline">
                Pesan mudah, bayar cepat, nikmati tanpa antre.
            </div>


            <!-- LOADING -->

            <div class="loading">

                <div class="loading-track">

                    <div class="loading-bar"></div>

                </div>

                <div class="loading-text">
                    MEMUAT...
                </div>

            </div>

        </div>

    </div>


    <!-- =====================================================
         PINDAH KE LOGIN
    ====================================================== -->

    <script>

        setTimeout(function () {

            const splash = document.getElementById('splash');

            /*
             * Mulai fade out.
             */
            splash.classList.add('leaving');


            /*
             * Tunggu fade selesai,
             * baru pindah ke login.
             */
            setTimeout(function () {

                window.location.href = "{{ route('userkita.login') }}";

            }, 1200);

        }, 5000);

    </script>

</body>
</html>