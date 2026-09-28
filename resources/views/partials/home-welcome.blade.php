<script>

    document.documentElement.classList.add('home-welcome-active');
    (function () {
        try {
            var welcomeWasShown = sessionStorage.getItem('cravecourt_home_welcome') === '1';

            if (welcomeWasShown) {
                document.documentElement.classList.add('home-welcome-seen');
                return;
            }
        } catch (error) {}

        document.documentElement.classList.add('home-welcome-active');
    })();
</script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600&family=Cormorant+Garamond:ital,wght@1,400&family=Jost:wght@400;500&display=swap" rel="stylesheet">

<style>
    html.home-welcome-active,
    html.home-welcome-active body { overflow: hidden; }

    html.home-welcome-seen #home-welcome { display: none; }
    html.home-welcome-active .app { visibility: hidden; opacity: 0; transform: translateY(16px) scale(.99); transition: opacity .75s ease, transform .8s cubic-bezier(.16,1,.3,1); }

    #home-welcome {
        --welcome-gold: #e9c877;
        position: fixed;
        inset: 0;
        z-index: 9999;
        display: grid;
        place-items: center;
        overflow: hidden;
        color: #fdf6f1;
        background: #5c0a0e;
        clip-path: circle(150vmax at 50% 50%);
        transition: clip-path 1.35s cubic-bezier(.76, 0, .24, 1), opacity .95s ease .2s;
        will-change: clip-path, opacity;
    }

    #home-welcome .welcome-backdrop {
        position: absolute;
        inset: -3%;
        background: url('{{ asset('assets/images/splash-bg.jpg') }}') center / cover no-repeat;
        animation: home-backdrop-drift 16s ease-in-out infinite alternate;
    }

    #home-welcome .welcome-veil {
        position: absolute;
        inset: 0;
        background: radial-gradient(ellipse 50% 60% at 50% 45%, rgba(92, 10, 14, .36), rgba(63, 5, 10, .83)), linear-gradient(110deg, rgba(75, 5, 12, .3), rgba(92, 10, 14, .76));
    }

    #home-welcome .welcome-stage {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: clamp(22px, 5vw, 68px);
        width: min(92vw, 900px);
        padding: 28px;
        text-align: center;
    }

    #home-welcome .welcome-mascot {
        position: relative;
        flex: 0 0 auto;
        width: clamp(132px, 19vw, 220px);
        aspect-ratio: 3 / 8;
        animation: home-mascot-enter 1.05s .2s cubic-bezier(.22,1,.36,1) both;
    }

    #home-welcome .welcome-mascot-motion { position: absolute; inset: 0; transform-origin: 50% 95%; animation: home-mascot-sway 5.2s 1.65s ease-in-out infinite; will-change: transform; }
    #home-welcome .welcome-mascot-pose { position: absolute; inset: 0; display: block; width: 100%; height: 100%; object-fit: contain; opacity: 0; will-change: opacity; }
    #home-welcome .welcome-mascot-pose { transform-origin: 50% 88%; }
    #home-welcome .welcome-mascot-pose.pose-one { animation: home-mascot-pose-one 6.6s ease-in-out infinite; }
    #home-welcome .welcome-mascot-pose.pose-two { animation: home-mascot-pose-two 6.6s ease-in-out infinite; }
    #home-welcome .welcome-mascot-pose.pose-three { animation: home-mascot-pose-three 6.6s ease-in-out infinite; }

    #home-welcome .welcome-copy { width: min(100%, 410px); }

    #home-welcome .welcome-medallion {
        display: grid;
        place-items: center;
        width: clamp(76px, 9vw, 104px);
        aspect-ratio: 1;
        margin: 0 auto 17px;
        border: 2px solid var(--welcome-gold);
        border-radius: 50%;
        background: radial-gradient(circle at 35% 25%, rgba(255,255,255,.25), rgba(233,200,119,.14) 45%, rgba(48,5,9,.45));
        box-shadow: inset 0 0 0 5px rgba(92,10,14,.38), 0 8px 25px rgba(0,0,0,.3);
        animation: home-medallion-drop .95s 1.3s cubic-bezier(.22,1,.36,1) both, home-medallion-sway 4.2s 2.35s ease-in-out infinite;
        transform-origin: 50% 0;
        will-change: transform, opacity;
    }

    #home-welcome .welcome-medallion img { display: block; width: 72%; height: auto; }

    #home-logo-travel {
        position: fixed;
        left: 0;
        top: 0;
        z-index: 12000;
        display: grid;
        place-items: center;
        border-radius: 50%;
        background: radial-gradient(circle at 35% 25%, rgba(255,255,255,.34), rgba(233,200,119,.18) 42%, rgba(48,5,9,.45));
        border: 2px solid rgba(233,200,119,.7);
        box-shadow: inset 0 0 0 4px rgba(92,10,14,.38), 0 10px 26px rgba(0,0,0,.26);
        pointer-events: none;
        opacity: 0;
        transform: translate3d(0, 0, 0) scale(1);
        transition: transform 1.05s cubic-bezier(.22,1,.36,1), opacity .4s ease, filter .4s ease;
        filter: drop-shadow(0 10px 18px rgba(0,0,0,.22));
        will-change: transform, opacity;
    }

    #home-logo-travel img {
        width: 72%;
        height: auto;
        display: block;
    }
    #home-welcome .welcome-kicker { margin: 0 0 8px; color: #f3d894; font: 500 11px/1.4 'Jost', sans-serif; letter-spacing: .24em; text-transform: uppercase; animation: home-rise .7s 2.12s both; }
    #home-welcome .welcome-title { margin: 0; color: #fff8ea; font: 600 clamp(31px, 5vw, 56px)/1.08 'Playfair Display', Georgia, serif; letter-spacing: 0; animation: home-rise .8s 2.26s both; text-wrap: balance; }
    #home-welcome .welcome-tagline { margin: 9px 0 0; color: #f5d9d1; font: italic 400 clamp(17px, 2.3vw, 23px)/1.2 'Cormorant Garamond', Georgia, serif; animation: home-rise .8s 2.42s both; }
    #home-welcome .welcome-rule { width: 120px; height: 1px; margin: 16px auto 0; background: linear-gradient(90deg, transparent, var(--welcome-gold), transparent); transform-origin: center; animation: home-rule .9s 2.52s both; }
    #home-welcome .welcome-note { margin: 13px 0 0; color: rgba(253,246,241,.82); font: 400 12px/1.65 'Jost', sans-serif; animation: home-rise .8s 2.64s both; }

    #home-welcome .welcome-progress { width: min(100%, 270px); height: 4px; margin: 22px auto 0; overflow: hidden; border-radius: 9px; background: rgba(253,246,241,.2); animation: home-rise .7s 2.78s both; }
    #home-welcome .welcome-progress span { display: block; width: 0; height: 100%; border-radius: inherit; background: linear-gradient(90deg, #c94f5f, #f2a6a5, var(--welcome-gold)); animation: home-progress 4.2s 1.5s cubic-bezier(.45,.05,.55,.95) forwards; }
    #home-welcome .welcome-button { margin-top: 17px; padding: 8px 16px; border: 1px solid rgba(233,200,119,.42); border-radius: 999px; background: rgba(255,255,255,.06); color: rgba(253,246,241,.78); font: 500 10px 'Jost', sans-serif; letter-spacing: .15em; text-transform: uppercase; cursor: pointer; animation: home-rise .7s 2.9s both; transition: background .2s ease, color .2s ease; }
    #home-welcome .welcome-button:hover { background: rgba(255,255,255,.16); color: #fff8ea; }

    #home-welcome .welcome-sparkle { position: absolute; color: var(--welcome-gold); opacity: 0; animation: home-sparkle 3s ease-in-out infinite; }
    #home-welcome .sparkle-a { top: 22%; left: 24%; animation-delay: 1.7s; }
    #home-welcome .sparkle-b { top: 28%; right: 23%; font-size: 12px; animation-delay: 2.3s; }
    #home-welcome .sparkle-c { bottom: 22%; left: 30%; font-size: 13px; animation-delay: 2.7s; }
    #home-welcome .sparkle-d { right: 29%; bottom: 25%; font-size: 11px; animation-delay: 2s; }

    #home-welcome.is-leaving { clip-path: circle(0 at calc(50% + var(--welcome-target-x, 0px)) calc(50% + var(--welcome-target-y, 0px))); opacity: 0; pointer-events: none; }
    #home-welcome.is-leaving .welcome-mascot { animation: home-mascot-exit 1s cubic-bezier(.4,0,.2,1) forwards; }
    #home-welcome.is-leaving .welcome-kicker,
    #home-welcome.is-leaving .welcome-title,
    #home-welcome.is-leaving .welcome-tagline,
    #home-welcome.is-leaving .welcome-rule,
    #home-welcome.is-leaving .welcome-note,
    #home-welcome.is-leaving .welcome-progress,
    #home-welcome.is-leaving .welcome-button { opacity: 0; transform: translateY(-8px); transition: opacity .35s ease, transform .45s ease; }
    html.home-welcome-exiting .app { visibility: visible; opacity: 1; transform: none; transition: opacity .8s .38s ease, transform .8s .38s cubic-bezier(.16,1,.3,1); }
    html.home-welcome-exiting .logo-badge { box-shadow: 0 0 0 4px rgba(233,200,119,.5), 0 0 24px rgba(233,200,119,.75); transition: box-shadow .8s ease; }

    @keyframes home-backdrop-drift { from { transform: scale(1.03) translate3d(-.5%,0,0); } to { transform: scale(1.1) translate3d(.5%,-.5%,0); } }
    @keyframes home-mascot-enter { 0% { opacity: 0; transform: translateY(76px) scale(.94); } 78% { opacity: 1; transform: translateY(-4px) scale(1.01); } 100% { opacity: 1; transform: translateY(0) scale(1); } }
    @keyframes home-mascot-sway { 0%,100% { transform: translate3d(0,0,0) rotate(0); } 50% { transform: translate3d(0,-3px,0) rotate(.45deg); } }
    @keyframes home-mascot-exit { to { opacity: 0; transform: translateY(76px) scale(.94); } }
    @keyframes home-mascot-pose-one {
        0% { opacity: 1; transform: translate3d(0, 0, 0) rotate(0) scale(1); }
        24% { opacity: 1; transform: translate3d(-2px, -3px, 0) rotate(-.5deg) scale(1.01); }
        36% { opacity: 0; transform: translate3d(5px, -6px, 0) rotate(1deg) scale(1.02); }
        94% { opacity: 0; transform: translate3d(-3px, 6px, 0) rotate(-1deg) scale(.98); }
        100% { opacity: 1; transform: translate3d(0, 0, 0) rotate(0) scale(1); }
    }
    @keyframes home-mascot-pose-two {
        0%, 26% { opacity: 0; transform: translate3d(-5px, 8px, 0) rotate(-1.5deg) scale(.98); }
        38% { opacity: 1; transform: translate3d(0, 0, 0) rotate(0) scale(1); }
        58% { opacity: 1; transform: translate3d(2px, -3px, 0) rotate(.5deg) scale(1.01); }
        71% { opacity: 0; transform: translate3d(5px, -5px, 0) rotate(1deg) scale(1.02); }
        100% { opacity: 0; transform: translate3d(-5px, 8px, 0) rotate(-1.5deg) scale(.98); }
    }
    @keyframes home-mascot-pose-three {
        0%, 61% { opacity: 0; transform: translate3d(5px, 8px, 0) rotate(1.5deg) scale(.98); }
        73% { opacity: 1; transform: translate3d(0, 0, 0) rotate(0) scale(1); }
        92% { opacity: 1; transform: translate3d(-2px, -3px, 0) rotate(-.5deg) scale(1.01); }
        100% { opacity: 0; transform: translate3d(-5px, -5px, 0) rotate(-1deg) scale(1.02); }
    }
    @keyframes home-medallion-drop { 0% { opacity: 0; transform: translateY(-70px) rotate(-10deg) scale(.9); } 72% { opacity: 1; transform: translateY(4px) rotate(2deg) scale(1.015); } 88% { transform: translateY(-2px) rotate(-.8deg) scale(.995); } 100% { opacity: 1; transform: translateY(0) rotate(0) scale(1); } }
    @keyframes home-medallion-sway { 0%,100% { rotate: 0deg; } 50% { rotate: 1.8deg; } }
    @keyframes home-rise { from { opacity: 0; transform: translateY(12px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes home-rule { from { opacity: 0; transform: scaleX(0); } to { opacity: 1; transform: scaleX(1); } }
    @keyframes home-progress { to { width: 100%; } }
    @keyframes home-sparkle { 0%,100% { opacity: 0; transform: scale(.7) rotate(0); } 45% { opacity: .9; transform: scale(1.1) rotate(16deg); } 70% { opacity: .25; transform: scale(.9) rotate(8deg); } }

    @media (max-width: 680px) {
        #home-welcome .welcome-stage { flex-direction: column; gap: 5px; padding: 20px 24px; }
        #home-welcome .welcome-mascot { width: clamp(112px, 33vw, 150px); order: 2; }
        #home-welcome .welcome-copy { order: 1; }
        #home-welcome .welcome-medallion { width: 72px; margin-bottom: 12px; }
        #home-welcome .welcome-note { margin-top: 9px; }
        #home-welcome .welcome-progress { margin-top: 16px; }
    }

    @media (prefers-reduced-motion: reduce) {
        #home-welcome, #home-welcome *, .app { animation: none !important; transition: none !important; }
        #home-welcome .welcome-mascot-pose { opacity: 0; }
        #home-welcome .welcome-mascot-pose.pose-one { opacity: 1; }
        #home-welcome .welcome-progress span { width: 100%; }
    }
</style>

<section id="home-welcome" aria-labelledby="home-welcome-title">
    <div class="welcome-backdrop" aria-hidden="true"></div>
    <div class="welcome-veil" aria-hidden="true"></div>
    <span class="welcome-sparkle sparkle-a" aria-hidden="true">&#10022;</span>
    <span class="welcome-sparkle sparkle-b" aria-hidden="true">&#10022;</span>
    <span class="welcome-sparkle sparkle-c" aria-hidden="true">&#10022;</span>
    <span class="welcome-sparkle sparkle-d" aria-hidden="true">&#10022;</span>

    <div class="welcome-stage">
        <div class="welcome-mascot" aria-hidden="true">
            <div class="welcome-mascot-motion">
                <img class="welcome-mascot-pose pose-one" src="{{ asset('assets/images/mascot-pose-1.png') }}" alt="">
                <img class="welcome-mascot-pose pose-two" src="{{ asset('assets/images/mascot-pose-2.png') }}" alt="">
                <img class="welcome-mascot-pose pose-three" src="{{ asset('assets/images/mascot-pose-3.png') }}" alt="">
            </div>
        </div>
        <div class="welcome-copy">
            <div class="welcome-medallion">
                <img src="{{ asset('assets/images/logo-mark.png') }}" alt="Cravecourt">
            </div>
            <p class="welcome-kicker">Cravecourt</p>
            <h1 class="welcome-title" id="home-welcome-title">Halo, selamat datang!</h1>
            <p class="welcome-tagline">Good Food, Good Mood</p>
            <div class="welcome-rule" aria-hidden="true"></div>
            <p class="welcome-note">Makanan enak, suasana baik,<br>selalu jadi pilihan terbaikmu!</p>
            <div class="welcome-progress" aria-hidden="true"><span></span></div>
            <button class="welcome-button" id="home-welcome-continue" type="button">Lanjut ke beranda</button>
        </div>
    </div>
</section>

<script>
    (function () {
        var intro = document.getElementById('home-welcome');
        if (!intro || document.documentElement.classList.contains('home-welcome-seen')) return;

        var finished = false;
        var timer = window.setTimeout(closeIntro, 6500);

        function closeIntro() {
            if (finished) return;
            finished = true;
            window.clearTimeout(timer);

            var logo = document.querySelector('.logo-badge');
            var medallion = intro.querySelector('.welcome-medallion');
            if (logo) {
                var targetRect = logo.getBoundingClientRect();
                var targetX = targetRect.left + targetRect.width / 2;
                var targetY = targetRect.top + targetRect.height / 2;
                intro.style.setProperty('--welcome-target-x', (targetX - window.innerWidth / 2) + 'px');
                intro.style.setProperty('--welcome-target-y', (targetY - window.innerHeight / 2) + 'px');

                if (medallion && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
                    var medallionRect = medallion.getBoundingClientRect();
                    var deltaX = targetX - (medallionRect.left + medallionRect.width / 2);
                    var deltaY = targetY - (medallionRect.top + medallionRect.height / 2);
                    var scaleX = targetRect.width / medallionRect.width;
                    var scaleY = targetRect.height / medallionRect.height;

                    medallion.getAnimations().forEach(function (animation) { animation.cancel(); });
                    medallion.style.animation = 'none';
                    medallion.animate([
                        { transform: 'translate(0, 0) scale(1)', opacity: 1 },
                        { transform: 'translate(' + deltaX + 'px, ' + deltaY + 'px) scale(' + scaleX + ', ' + scaleY + ')', opacity: 1 }
                    ], {
                        duration: 1050,
                        easing: 'cubic-bezier(.22,1,.36,1)',
                        fill: 'forwards'
                    });
                }

            if (logo && medallion) {
                var rect = logo.getBoundingClientRect();
                var targetX = rect.left + rect.width / 2;
                var targetY = rect.top + rect.height / 2;
                intro.style.setProperty('--welcome-target-x', (targetX - window.innerWidth / 2) + 'px');
                intro.style.setProperty('--welcome-target-y', (targetY - window.innerHeight / 2) + 'px');

                var medallionRect = medallion.getBoundingClientRect();
                intro.style.setProperty('--welcome-medallion-x', (targetX - medallionRect.left - medallionRect.width / 2) + 'px');
                intro.style.setProperty('--welcome-medallion-y', (targetY - medallionRect.top - medallionRect.height / 2) + 'px');

                var travel = document.createElement('div');
                travel.id = 'home-logo-travel';
                travel.innerHTML = '<img src="{{ asset('assets/images/logo-mark.png') }}" alt="Cravecourt" />';
                travel.style.width = medallionRect.width + 'px';
                travel.style.height = medallionRect.height + 'px';
                travel.style.left = medallionRect.left + 'px';
                travel.style.top = medallionRect.top + 'px';
                document.body.appendChild(travel);

                requestAnimationFrame(function () {
                    var deltaX = rect.left + rect.width / 2 - (medallionRect.left + medallionRect.width / 2);
                    var deltaY = rect.top + rect.height / 2 - (medallionRect.top + medallionRect.height / 2);
                    travel.style.opacity = '1';
                    travel.style.transform = 'translate3d(' + deltaX + 'px, ' + deltaY + 'px, 0) scale(.38)';
                    travel.style.filter = 'blur(.25px)';
                });

                window.setTimeout(function () {
                    travel.remove();
                }, 1050);
            }

            document.documentElement.classList.add('home-welcome-exiting');
            document.documentElement.classList.remove('home-welcome-active');
            intro.classList.add('is-leaving');
            window.setTimeout(function () {
                intro.remove();
                document.documentElement.classList.remove('home-welcome-exiting');
            }, 1450);
        }

        document.getElementById('home-welcome-continue').addEventListener('click', closeIntro);
    }
    })();
</script>