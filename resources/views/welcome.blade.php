<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Shipon Sarder — Mobile Application Developer with 5+ years of Android and Flutter experience.">
    <title>Shipon Sarder — Mobile Application Developer</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">

    <script>
        (function () {
            try {
                var stored = localStorage.getItem('theme');
                var theme = stored === 'dark' || stored === 'light'
                    ? stored
                    : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
                document.documentElement.dataset.theme = theme;
            } catch (e) {
                document.documentElement.dataset.theme = 'light';
            }
            if ('scrollRestoration' in history) {
                history.scrollRestoration = 'manual';
            }
            if (!window.location.hash) {
                window.scrollTo(0, 0);
            }
        })();
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Serif&family=Inter:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: ['selector', '[data-theme="dark"]'],
            theme: {
                extend: {
                    colors: {
                        base: 'var(--bg-base)',
                        surface: 'var(--bg-surface)',
                        border: 'var(--border)',
                        ink: {
                            primary: 'var(--ink-primary)',
                            secondary: 'var(--ink-secondary)',
                            muted: 'var(--ink-muted)',
                        },
                        accent: {
                            DEFAULT: 'var(--accent)',
                            soft: 'var(--accent-soft)',
                        },
                    },
                    fontFamily: {
                        serif: ['"Instrument Serif"', 'ui-serif', 'Georgia', 'serif'],
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'ui-monospace', 'monospace'],
                    },
                    maxWidth: { content: '72rem' },
                    boxShadow: { glow: '0 0 40px -8px rgb(228 176 97 / 0.35)' },
                },
            },
        };
    </script>

    <style>
        :root, [data-theme='light'] {
            --bg-base: #faf9f6;
            --bg-surface: #ffffff;
            --border: #e7e3da;
            --ink-primary: #14110f;
            --ink-secondary: #5b554e;
            --ink-muted: #8b8578;
            --accent: #b8862f;
            --accent-soft: #e4b061;
        }
        [data-theme='dark'] {
            --bg-base: #0e0c0a;
            --bg-surface: #14110f;
            --border: #2a241e;
            --ink-primary: #f2ede4;
            --ink-secondary: #b8b0a1;
            --ink-muted: #7a7368;
            --accent: #e4b061;
            --accent-soft: #b8862f;
        }
        html, body {
            background: var(--bg-base);
            color: var(--ink-primary);
        }
        body {
            font-family: 'Inter', system-ui, sans-serif;
            min-height: 100vh;
            transition: background-color 300ms ease, color 300ms ease;
        }
        :focus-visible {
            outline: 2px solid var(--accent);
            outline-offset: 2px;
            border-radius: 4px;
        }
        .display-serif {
            font-family: 'Instrument Serif', ui-serif, Georgia, serif;
            font-weight: 400;
            letter-spacing: -0.01em;
            line-height: 1.05;
        }
        .section-title {
            font-family: 'Instrument Serif', ui-serif, Georgia, serif;
            font-weight: 400;
            letter-spacing: -0.01em;
            font-size: clamp(2.5rem, 4vw, 3.5rem);
            line-height: 1.1;
            color: var(--ink-primary);
        }
        .label-mono {
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.75rem;
            font-weight: 500;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--ink-muted);
        }
        .link-underline { position: relative; display: inline-block; }
        .link-underline::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -2px;
            height: 1px;
            width: 0%;
            background: currentColor;
            transition: width 250ms ease;
        }
        .link-underline:hover::after,
        .link-underline:focus-visible::after { width: 100%; }
        .chip {
            display: inline-block;
            font-family: 'JetBrains Mono', ui-monospace, monospace;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 0.25rem 0.6rem;
            border: 1px solid var(--border);
            color: var(--ink-secondary);
            border-radius: 999px;
            transition: border-color 200ms ease, color 200ms ease;
        }
        .chip:hover { border-color: var(--accent); color: var(--ink-primary); }
        .reveal {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        html.js-loaded .reveal:not(.revealed) {
            opacity: 0;
            transform: translateY(0.5rem);
        }
        .reveal.revealed { opacity: 1; transform: translateY(0); }
        .reveal-child > * {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.5s ease-out, transform 0.5s ease-out;
        }
        html.js-loaded .reveal-child:not(.revealed) > * {
            opacity: 0;
            transform: translateY(0.5rem);
        }
        .reveal-child.revealed > * { opacity: 1; transform: translateY(0); }
        .reveal-child.revealed > *:nth-child(1) { transition-delay: 0ms; }
        .reveal-child.revealed > *:nth-child(2) { transition-delay: 100ms; }
        .reveal-child.revealed > *:nth-child(3) { transition-delay: 200ms; }
        .reveal-child.revealed > *:nth-child(4) { transition-delay: 300ms; }
        .reveal-child.revealed > *:nth-child(5) { transition-delay: 400ms; }
        .reveal-child.revealed > *:nth-child(6) { transition-delay: 500ms; }
        .pulse-dot { animation: pulse-dot 2s ease-in-out infinite; }
        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.3); }
        }
        .grayscale-fade { filter: grayscale(1); transition: filter 400ms ease; }
        .grayscale-fade:hover { filter: grayscale(0); }
        @media (prefers-reduced-motion: reduce) {
            .reveal, .reveal-child > * { opacity: 1; transform: none; transition: none; }
            .pulse-dot { animation: none; }
            html { scroll-behavior: auto; }
        }
    </style>
</head>
<body class="antialiased">

<a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:top-2 focus:left-2 focus:z-50 focus:bg-accent focus:text-base focus:px-3 focus:py-2 focus:rounded">Skip to content</a>

@php
    $nav = [
        ['id' => 'work', 'label' => 'Work', 'num' => '01'],
        ['id' => 'journey', 'label' => 'Journey', 'num' => '02'],
        ['id' => 'skills', 'label' => 'Skills', 'num' => '03'],
        ['id' => 'about', 'label' => 'About', 'num' => '04'],
        ['id' => 'credentials', 'label' => 'Credentials', 'num' => '05'],
        ['id' => 'contact', 'label' => 'Contact', 'num' => '06'],
    ];
    $featured = [
        [
            'name' => 'MoveOn Global',
            'tagline' => 'Cross-border eCommerce app that reached 100K+ installs in 3 months.',
            'tech' => ['Flutter', 'BLoC', 'Clean Architecture', 'CI/CD', 'Sentry'],
            'link' => 'https://play.google.com/store/apps/details?id=com.moveon.global',
            'linkLabel' => 'Play Store',
        ],
        [
            'name' => 'EduTune',
            'tagline' => 'E-learning platform with live streaming classes, LMS, and an online book reader.',
            'tech' => ['Java', 'Zoom SDK', 'Firebase', 'OneSignal'],
            'link' => 'https://play.google.com/store/apps/details?id=com.aitl.edutune',
            'linkLabel' => 'Play Store',
        ],
        [
            'name' => 'Mojaru',
            'tagline' => 'School management app streamlining tasks for staff, teachers, and students.',
            'tech' => ['Kotlin', 'Firebase Realtime DB', 'OneSignal'],
            'link' => 'https://play.google.com/store/apps/details?id=com.aitl.mojaru',
            'linkLabel' => 'Play Store',
        ],
    ];
    $experience = [
        [
            'company' => 'Envobyte Ltd',
            'role' => 'Senior Software Engineer',
            'location' => 'Khulna, Bangladesh',
            'period' => 'Jan 2026 — Present',
            'current' => true,
            'bullets' => [
                'Team Lead — managing and guiding a cross-functional team of 9 members.',
                'Working with Cloud Vision, ML Kit, and image processing technologies.',
            ],
        ],
        [
            'company' => 'Moveon Technologies Ltd.',
            'role' => 'Senior Software Engineer',
            'location' => 'Dhaka, Bangladesh',
            'period' => 'Dec 2023 — Dec 2025',
            'current' => false,
            'bullets' => [
                'Developed a cross-border eCommerce app that reached 100K+ installs within 3 months of launch.',
                'Focused on maximum device support for iOS and Android, delivering top performance and user experience.',
                'Mentored juniors, conducted code reviews, improved productivity, and enforced proper doc comments.',
                'Applied Clean Architecture with BLoC to separate UI and business logic for scalable, maintainable code.',
                'Implemented CI/CD pipelines to automate app publishing to Play Store and App Store, with error notifications via Discord and Sentry.',
            ],
        ],
        [
            'company' => 'Amreen Info Tech Ltd.',
            'role' => 'Software Engineer',
            'location' => 'Khulna, Bangladesh',
            'period' => 'Mar 2021 — Nov 2023',
            'current' => false,
            'bullets' => [
                'Developed an e-learning mobile app in Java, featuring live streaming classes, an LMS system, and an online book reader.',
                'Built a school management app in Kotlin, streamlining school tasks for better organization and efficiency.',
                'Integrated Zoom SDK customization for live classes.',
                'Implemented Firebase Realtime Database for real-time messaging and push notifications using Firebase and OneSignal.',
            ],
        ],
        [
            'company' => 'Ali2BD',
            'role' => 'Junior Software Engineer',
            'location' => 'Dhaka, Bangladesh',
            'period' => 'Mar 2019 — Dec 2020',
            'current' => false,
            'bullets' => [
                'Developed and maintained the Ali2BD app using Java and XML, providing a seamless shopping experience.',
                'Utilized Jsoup for web scraping to fetch and display real-time product data.',
                'Optimized app performance and UI for a smooth user experience.',
            ],
        ],
    ];
    $skills = [
        ['group' => 'Languages', 'items' => ['Java', 'Kotlin', 'Dart', 'C', 'C++']],
        ['group' => 'Mobile & UI', 'items' => ['Flutter', 'Jetpack Compose', 'XML', 'Firebase']],
        ['group' => 'Architecture', 'items' => ['MVVM', 'MVP', 'Clean Architecture', 'BLoC', 'Provider', 'Riverpod']],
        ['group' => 'Other', 'items' => ['RESTful APIs', 'CI/CD', 'Problem Solving', 'Competitive Programming']],
    ];
    $education = [
        ['school' => 'Daffodil International University', 'location' => 'Dhaka', 'degree' => 'BSc in Computer Science & Engineering', 'period' => 'Dec 2015 — Dec 2019'],
        ['school' => 'Govt. MM City College', 'location' => 'Khulna', 'degree' => 'Higher Secondary Certificate (HSC)', 'period' => 'Jan 2011 — Jan 2013'],
        ['school' => 'Bajua Union High School', 'location' => 'Khulna', 'degree' => 'Secondary School Certificate (SSC)', 'period' => 'Jan 2006 — Jan 2011'],
    ];
    $certifications = [
        ['name' => 'Android Application Development', 'issuer' => 'BITM (Bangladesh Institute of Management)', 'type' => 'Professional Certification'],
    ];
    $stats = [
        ['value' => '5+', 'label' => 'Years'],
        ['value' => '100K+', 'label' => 'Installs'],
        ['value' => '4', 'label' => 'Companies'],
        ['value' => '9', 'label' => 'Team Led'],
    ];
@endphp

<header class="fixed top-0 inset-x-0 z-40 backdrop-blur-md" style="background-color: color-mix(in srgb, var(--bg-base) 80%, transparent); border-bottom: 1px solid color-mix(in srgb, var(--border) 60%, transparent);">
    <nav class="max-w-content mx-auto px-6 h-16 flex items-center justify-between" aria-label="Primary">
        <a href="#top" class="flex items-center gap-3" aria-label="Shipon Sarder — home">
            <img src="/avatar.jpg" alt="" width="32" height="32" class="w-8 h-8 rounded-full object-cover border border-border">
            <span class="hidden sm:inline font-sans text-sm font-medium tracking-wide text-ink-primary">Shipon Sarder</span>
        </a>
        <div class="hidden md:flex items-center gap-7">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="nav-link text-sm text-ink-secondary hover:text-ink-primary transition-colors">{{ $item['label'] }}</a>
            @endforeach
            <button type="button" class="p-2 text-ink-secondary hover:text-accent transition-colors" data-theme-toggle aria-label="Switch theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/></svg>
            </button>
        </div>
        <button type="button" class="md:hidden text-ink-primary" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu" data-menu-toggle>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/></svg>
        </button>
    </nav>
    <div id="mobile-menu" class="md:hidden hidden bg-base border-t border-border" data-mobile-menu>
        <div class="px-6 py-4">
            @foreach ($nav as $item)
                <a href="#{{ $item['id'] }}" class="block py-3 border-b border-border text-ink-secondary" data-mobile-link>{{ $item['label'] }}</a>
            @endforeach
            <div class="mt-4 flex items-center justify-between">
                <a href="/Shipon_Sarder_CV.pdf" download class="inline-flex items-center gap-2 font-mono text-xs text-ink-primary border border-border rounded px-3 py-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                    <span>Download CV</span>
                </a>
                <button type="button" class="p-2 text-ink-secondary" data-theme-toggle aria-label="Switch theme">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/></svg>
                </button>
            </div>
        </div>
    </div>
</header>
<div id="top"></div>

<main id="main">

    {{-- Hero --}}
    <section id="hero" class="relative min-h-screen flex items-center pt-32 pb-20 md:pt-40">
        <div class="max-w-content mx-auto px-6 w-full grid md:grid-cols-3 gap-12 items-center">
            <div class="md:col-span-2">
                <p class="label-mono">Mobile Application Developer</p>
                <h1 class="display-serif mt-6 text-ink-primary" style="font-size: clamp(3.5rem, 9vw, 6.5rem);">
                    Shipon Sarder.
                </h1>
                <p class="mt-6 max-w-2xl text-lg md:text-xl text-ink-secondary leading-relaxed">
                    5+ years shipping Android and Flutter apps. 100K+ installs. Team lead of 9.
                </p>
                <div class="mt-10 flex flex-wrap items-center gap-6">
                    <a href="#work" class="inline-flex items-center gap-2 text-sm border border-accent text-accent hover:bg-accent hover:text-base transition-colors rounded-full px-6 py-3 font-medium">
                        View Work
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M12 5v14"/><path d="M19 12l-7 7-7-7"/></svg>
                    </a>
                    <a href="/Shipon_Sarder_CV.pdf" download class="link-underline inline-flex items-center gap-2 text-sm text-ink-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><path d="M7 10l5 5 5-5"/><path d="M12 15V3"/></svg>
                        <span>Download CV</span>
                    </a>
                </div>
            </div>
            <aside class="hidden md:block pl-8 border-l border-border">
                <div class="space-y-6">
                    <div>
                        <p class="label-mono">Location</p>
                        <p class="mt-2 text-ink-primary">Dhaka, Bangladesh</p>
                    </div>
                    <div>
                        <p class="label-mono">Currently</p>
                        <p class="mt-2 text-ink-primary">Senior Software Engineer @ Envobyte</p>
                    </div>
                    <div>
                        <p class="label-mono">Status</p>
                        <p class="mt-2 text-ink-primary inline-flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-accent pulse-dot" aria-hidden="true"></span>
                            Open to opportunities
                        </p>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    {{-- Featured Work --}}
    <section id="work" class="py-24 md:py-32">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl">
                <p class="label-mono">01 — Featured Work</p>
                <h2 class="mt-4 section-title">Apps I've shipped.</h2>
                <p class="mt-6 text-lg text-ink-secondary">Selected mobile apps I've led or built from the ground up. Each one is live, or was.</p>
            </div>
            <div class="mt-16">
                @foreach ($featured as $i => $p)
                    @php $num = str_pad($i + 1, 2, '0', STR_PAD_LEFT); $alignRight = $i % 2 === 1; @endphp
                    <article class="relative grid md:grid-cols-12 gap-6 items-start py-16 border-t border-border reveal {{ $alignRight ? 'md:text-right' : '' }}">
                        <div class="md:col-span-3 {{ $alignRight ? 'md:order-2' : '' }}">
                            <p class="display-serif text-6xl md:text-8xl text-ink-muted leading-none select-none">{{ $num }}</p>
                        </div>
                        <div class="md:col-span-9 {{ $alignRight ? 'md:order-1' : '' }}">
                            <h3 class="display-serif text-4xl md:text-5xl text-ink-primary">{{ $p['name'] }}</h3>
                            <p class="mt-4 max-w-2xl {{ $alignRight ? 'md:ml-auto' : '' }} text-lg text-ink-secondary leading-relaxed">{{ $p['tagline'] }}</p>
                            <ul class="mt-6 flex flex-wrap gap-2 {{ $alignRight ? 'md:justify-end' : '' }}">
                                @foreach ($p['tech'] as $t)
                                    <li class="chip">{{ $t }}</li>
                                @endforeach
                            </ul>
                            <div class="mt-6">
                                <a href="{{ $p['link'] }}" target="_blank" rel="noopener noreferrer" class="link-underline inline-flex items-center gap-2 text-accent">
                                    <span>{{ $p['linkLabel'] }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4" aria-hidden="true"><path d="M18 13v6a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2h6"/><path d="M15 3h6v6"/><path d="M10 14L21 3"/></svg>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Journey --}}
    <section id="journey" class="py-24 md:py-32 bg-surface">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl">
                <p class="label-mono">02 — Journey</p>
                <h2 class="mt-4 section-title">Five years of shipping.</h2>
            </div>
            <div class="mt-16 max-w-3xl">
                @foreach ($experience as $e)
                    <article class="relative pl-10 pb-14 border-l border-border last:pb-0 reveal">
                        <span class="absolute -left-[7px] top-1 w-3.5 h-3.5 rounded-full {{ $e['current'] ? 'bg-accent pulse-dot' : 'bg-accent-soft' }}" aria-hidden="true"></span>
                        <p class="label-mono">{{ $e['period'] }}</p>
                        <h3 class="mt-2 display-serif text-3xl text-ink-primary">{{ $e['company'] }}</h3>
                        <p class="mt-1 text-ink-secondary">{{ $e['role'] }} · {{ $e['location'] }}</p>
                        <ul class="mt-5 space-y-3 text-ink-secondary leading-relaxed max-w-2xl">
                            @foreach ($e['bullets'] as $b)
                                <li class="flex gap-3"><span class="text-accent mt-2 flex-shrink-0" aria-hidden="true">—</span><span>{{ $b }}</span></li>
                            @endforeach
                        </ul>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Skills --}}
    <section id="skills" class="py-24 md:py-32">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl">
                <p class="label-mono">03 — Skills</p>
                <h2 class="mt-4 section-title">What I work with.</h2>
            </div>
            <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-10">
                @foreach ($skills as $g)
                    <div class="reveal">
                        <p class="label-mono">{{ $g['group'] }}</p>
                        <ul class="mt-4 flex flex-wrap gap-2">
                            @foreach ($g['items'] as $item)
                                <li class="chip">{{ $item }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="py-24 md:py-32 bg-surface">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl">
                <p class="label-mono">04 — About</p>
                <h2 class="mt-4 section-title">Who I am.</h2>
            </div>
            <div class="mt-16 grid md:grid-cols-5 gap-12 items-start">
                <div class="md:col-span-2 reveal">
                    <img src="/avatar.jpg" alt="Shipon Sarder" width="240" height="240" class="w-60 h-60 rounded-full object-cover grayscale-fade border border-border mx-auto md:mx-0">
                </div>
                <div class="md:col-span-3 reveal">
                    <div class="space-y-5">
                        <p class="text-ink-secondary leading-relaxed text-lg">I build mobile applications that people use every day. Over the last five years I have shipped native Android and cross-platform Flutter apps for eCommerce, education, and productivity — with a focus on performance, clean architecture, and code that other engineers can maintain.</p>
                        <p class="text-ink-secondary leading-relaxed text-lg">Most recently I lead a cross-functional team of nine at Envobyte, working with Cloud Vision and ML Kit. Before that, I helped grow a cross-border eCommerce app to 100K+ installs in its first three months. I care about mentoring, code reviews, and CI/CD that catches problems before users do.</p>
                    </div>
                    <div class="mt-10 grid grid-cols-2 sm:grid-cols-4 gap-8 pt-10 border-t border-border">
                        @foreach ($stats as $s)
                            <div>
                                <p class="display-serif text-5xl text-ink-primary">{{ $s['value'] }}</p>
                                <p class="mt-1 label-mono">{{ $s['label'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Credentials --}}
    <section id="credentials" class="py-24 md:py-32">
        <div class="max-w-content mx-auto px-6">
            <div class="reveal max-w-2xl">
                <p class="label-mono">05 — Credentials</p>
                <h2 class="mt-4 section-title">Education & certifications.</h2>
            </div>
            <div class="mt-16 grid md:grid-cols-2 gap-16">
                <div>
                    <p class="label-mono mb-4">Education</p>
                    <div class="space-y-8">
                        @foreach ($education as $ed)
                            <article class="reveal border-t border-border pt-6">
                                <p class="label-mono">{{ $ed['period'] }}</p>
                                <h3 class="mt-2 display-serif text-2xl text-ink-primary">{{ $ed['school'] }}</h3>
                                <p class="mt-1 text-ink-secondary">{{ $ed['degree'] }}</p>
                                <p class="mt-1 text-sm text-ink-muted">{{ $ed['location'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
                <div>
                    <p class="label-mono mb-4">Certifications</p>
                    <div class="space-y-8">
                        @foreach ($certifications as $c)
                            <article class="reveal border-t border-border pt-6">
                                <p class="label-mono">{{ $c['type'] }}</p>
                                <h3 class="mt-2 display-serif text-2xl text-ink-primary">{{ $c['name'] }}</h3>
                                <p class="mt-1 text-ink-secondary">{{ $c['issuer'] }}</p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact" class="py-24 md:py-32 bg-surface">
        <div class="max-w-content mx-auto px-6">
            <div class="max-w-3xl reveal">
                <p class="label-mono">06 — Contact</p>
                <h2 class="mt-4 display-serif text-5xl md:text-7xl text-ink-primary" style="line-height: 1.05;">Let's build something.</h2>
                <p class="mt-8 text-lg text-ink-secondary leading-relaxed max-w-2xl">Open to remote and Dhaka-based mobile engineering roles. Email is the fastest way to reach me — I usually reply within a day.</p>
                <a href="mailto:shipon0142@gmail.com" class="link-underline mt-10 inline-flex display-serif text-3xl md:text-4xl text-accent">shipon0142@gmail.com</a>
                <div class="mt-14 flex items-center gap-6 text-ink-secondary">
                    <a href="https://github.com/shipon0142" target="_blank" rel="noopener noreferrer" aria-label="GitHub" class="hover:text-accent transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true"><path d="M12 .5C5.65.5.5 5.65.5 12c0 5.09 3.29 9.4 7.86 10.93.58.11.79-.25.79-.55 0-.27-.01-1.16-.02-2.11-3.19.69-3.87-1.36-3.87-1.36-.52-1.33-1.28-1.69-1.28-1.69-1.05-.71.08-.7.08-.7 1.16.08 1.77 1.19 1.77 1.19 1.03 1.77 2.7 1.26 3.36.96.1-.74.4-1.26.72-1.55-2.55-.29-5.23-1.28-5.23-5.68 0-1.25.45-2.28 1.19-3.09-.12-.29-.52-1.46.11-3.05 0 0 .97-.31 3.18 1.18a11.1 11.1 0 0 1 2.9-.39c.98 0 1.97.13 2.9.39 2.21-1.49 3.18-1.18 3.18-1.18.63 1.59.23 2.76.11 3.05.74.81 1.19 1.84 1.19 3.09 0 4.41-2.69 5.38-5.25 5.66.41.36.78 1.06.78 2.14 0 1.54-.01 2.79-.01 3.16 0 .3.21.67.8.55C20.21 21.4 23.5 17.09 23.5 12 23.5 5.65 18.35.5 12 .5z"/></svg>
                    </a>
                    <a href="https://linkedin.com/in/shipon-sarder-900727102" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn" class="hover:text-accent transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-5 h-5" aria-hidden="true"><path d="M20.5 2h-17A1.5 1.5 0 002 3.5v17A1.5 1.5 0 003.5 22h17a1.5 1.5 0 001.5-1.5v-17A1.5 1.5 0 0020.5 2zM8 19H5v-9h3zM6.5 8.25a1.75 1.75 0 110-3.5 1.75 1.75 0 010 3.5zM19 19h-3v-4.74c0-1.13-.02-2.58-1.57-2.58-1.57 0-1.81 1.23-1.81 2.5V19h-3v-9h2.88v1.23h.04a3.16 3.16 0 012.85-1.56c3.05 0 3.61 2 3.61 4.61z"/></svg>
                    </a>
                    <a href="tel:+8801925727000" aria-label="Phone" class="hover:text-accent transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07 19.5 19.5 0 01-6-6 19.79 19.79 0 01-3.07-8.67A2 2 0 014.11 2h3a2 2 0 012 1.72c.13.96.37 1.9.72 2.81a2 2 0 01-.45 2.11L8.09 9.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.91.35 1.85.59 2.81.72A2 2 0 0122 16.92z"/></svg>
                    </a>
                    <a href="mailto:shipon0142@gmail.com" aria-label="Email" class="hover:text-accent transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6l-10 7L2 6"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<footer class="border-t border-border py-10">
    <div class="max-w-content mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <p class="font-mono text-xs text-ink-muted">© {{ date('Y') }} Shipon Sarder · Dhaka, Bangladesh</p>
        <p class="font-mono text-xs text-ink-muted">Built with Laravel &amp; Tailwind.</p>
        <div class="flex items-center gap-4">
            <button type="button" class="p-2 text-ink-secondary hover:text-accent transition-colors" data-theme-toggle aria-label="Switch theme">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/></svg>
            </button>
            <a href="#top" class="p-2 text-ink-secondary hover:text-accent transition-colors" aria-label="Back to top">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><path d="M12 19V5"/><path d="M5 12l7-7 7 7"/></svg>
            </a>
        </div>
    </div>
</footer>

<script>
    // Theme toggle
    (function () {
        var SUN = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2"/><path d="M12 20v2"/><path d="M4.93 4.93l1.41 1.41"/><path d="M17.66 17.66l1.41 1.41"/><path d="M2 12h2"/><path d="M20 12h2"/><path d="M6.34 17.66l-1.41 1.41"/><path d="M19.07 4.93l-1.41 1.41"/></svg>';
        var MOON = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"/></svg>';

        function currentTheme() {
            return document.documentElement.dataset.theme
                || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
        }
        function refreshIcons() {
            var t = currentTheme();
            var iconHtml = t === 'dark' ? SUN : MOON;
            document.querySelectorAll('[data-theme-toggle]').forEach(function (btn) {
                btn.innerHTML = iconHtml;
                var next = t === 'dark' ? 'light' : 'dark';
                btn.setAttribute('aria-label', 'Switch to ' + next + ' theme');
            });
        }
        refreshIcons();
        new MutationObserver(refreshIcons).observe(document.documentElement, { attributes: true, attributeFilter: ['data-theme'] });

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function (e) {
            try { if (localStorage.getItem('theme')) return; } catch (err) { /* ignore */ }
            document.documentElement.dataset.theme = e.matches ? 'dark' : 'light';
        });

        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-theme-toggle]');
            if (!btn) return;
            var next = currentTheme() === 'dark' ? 'light' : 'dark';
            document.documentElement.dataset.theme = next;
            try { localStorage.setItem('theme', next); } catch (err) { /* ignore */ }
        });
    })();

    // Mobile menu
    (function () {
        var btn = document.querySelector('[data-menu-toggle]');
        var menu = document.querySelector('[data-mobile-menu]');
        if (!btn || !menu) return;
        function setOpen(open) {
            menu.classList.toggle('hidden', !open);
            btn.setAttribute('aria-expanded', String(open));
            btn.setAttribute('aria-label', open ? 'Close menu' : 'Open menu');
        }
        btn.addEventListener('click', function () { setOpen(menu.classList.contains('hidden')); });
        document.querySelectorAll('[data-mobile-link]').forEach(function (link) {
            link.addEventListener('click', function () { setOpen(false); });
        });
    })();

    // Reveal on scroll
    (function () {
        var els = document.querySelectorAll('.reveal, .reveal-child');
        var reduced = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        if (reduced || !('IntersectionObserver' in window)) {
            els.forEach(function (el) { el.classList.add('revealed'); });
            return;
        }
        // Reveal in-viewport elements first, then mark js-loaded (which hides remaining offscreen elements ready to animate)
        var vh = window.innerHeight;
        els.forEach(function (el) {
            var rect = el.getBoundingClientRect();
            if (rect.top < vh) el.classList.add('revealed');
        });
        document.documentElement.classList.add('js-loaded');
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('revealed');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        els.forEach(function (el) {
            if (!el.classList.contains('revealed')) io.observe(el);
        });
        // Safety net: if for any reason an element stays hidden after 2s, reveal it
        setTimeout(function () {
            document.querySelectorAll('.reveal:not(.revealed), .reveal-child:not(.revealed)').forEach(function (el) {
                el.classList.add('revealed');
            });
        }, 2000);
    })();

    // Scroll spy
    (function () {
        var links = document.querySelectorAll('header nav a[href^="#"]');
        var sections = document.querySelectorAll('main > section[id]');
        if (!links.length || !sections.length || !('IntersectionObserver' in window)) return;
        var linkById = new Map();
        links.forEach(function (l) {
            var id = (l.getAttribute('href') || '').replace('#', '');
            if (id) linkById.set(id, l);
        });
        function setActive(id) {
            links.forEach(function (l) { l.classList.remove('text-accent'); l.removeAttribute('aria-current'); });
            var a = linkById.get(id);
            if (a) { a.classList.add('text-accent'); a.setAttribute('aria-current', 'true'); }
        }
        var io = new IntersectionObserver(function (entries) {
            var visible = entries.filter(function (e) { return e.isIntersecting; })
                .sort(function (a, b) { return b.intersectionRatio - a.intersectionRatio; });
            if (visible[0]) setActive(visible[0].target.id);
        }, { threshold: [0.25, 0.5, 0.75], rootMargin: '-80px 0px -40% 0px' });
        sections.forEach(function (s) { io.observe(s); });
    })();
</script>

</body>
</html>
