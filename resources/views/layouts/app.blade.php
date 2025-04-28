<!-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" @class(['dark' => ($appearance ?? 'system') == 'dark'])>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- Inline script to detect system dark mode preference and apply it immediately --}}
        <script>
            (function() {
                const appearance = '{{ $appearance ?? "system" }}';

                if (appearance === 'system') {
                    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

                    if (prefersDark) {
                        document.documentElement.classList.add('dark');
                    }
                }
            })();
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    
            {{-- Inline script to set the HTML background color based on our theme in app.css --}}

        {{-- Inline style to set the HTML background color based on our theme in app.css --}}
        <style>
            html {
                background-color: oklch(1 0 0);
                color: black;
            }

            html.dark {
                background-color: oklch(0.145 0 0);
                color: white;
            }
        </style>

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- Remove Inertia.js-specific lines --}}
        {{-- @routes --}}
        {{-- @viteReactRefresh --}}
        {{-- @vite(['resources/js/app.tsx', "resources/js/pages/{$page['component']}.tsx"]) --}}
    </head>
    <body class="font-sans antialiased">
        {{-- Replace @inertia with @yield('content') --}}
        @yield('content')


    </body>
</html> -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Tailwind CSS CDN with configuration --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        dark: '#1a1a1a',
                    }
                }
            }
        }
    </script>

    {{-- Theme Initialization Script --}}
    <script>
        // Initialize theme on page load
        (function() {
            function setTheme(theme) {
                if (theme === 'dark') {
                    document.documentElement.classList.add('dark');
                    document.documentElement.classList.remove('light');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.classList.add('light');
                }
                localStorage.setItem('theme', theme);
            }

            // Check for saved theme preference
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                setTheme(savedTheme);
            } else {
                // Check system preference
                const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                setTheme(prefersDark ? 'dark' : 'light');
            }
        })();
    </script>

    {{-- Alpine.js for enhanced interactivity --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    {{-- Custom Styles with Tailwind --}}
    <style type="text/tailwindcss">
        @layer base {
            :root {
                --bg-light: theme('colors.white');
                --text-light: theme('colors.gray.900');
                --bg-dark: theme('colors.dark');
                --text-dark: theme('colors.white');
            }

            html {
                @apply transition-colors duration-200;
            }

            html.light {
                @apply bg-white text-gray-900;
            }

            html.dark {
                @apply bg-dark text-white;
            }

            body {
                @apply bg-inherit text-inherit;
            }

            .theme-toggle {
                @apply fixed top-4 right-4 z-50 transition-transform duration-200 ease-in-out;
            }

            .theme-toggle:hover {
                @apply transform scale-110;
            }
        }
    </style>

    {{-- Additional Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
</head>
<body class="font-sans antialiased min-h-screen bg-white dark:bg-gray-900">
    {{-- Main Content --}}
    @yield('content')

    {{-- Theme Toggle Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggleBtn = document.getElementById('theme-toggle');
            const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
            const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

            function updateThemeIcon(isDark) {
                if (themeToggleDarkIcon && themeToggleLightIcon) {
                    themeToggleDarkIcon.classList.toggle('hidden', isDark);
                    themeToggleLightIcon.classList.toggle('hidden', !isDark);
                }
            }

            function toggleTheme() {
                const isDark = document.documentElement.classList.contains('dark');
                document.documentElement.classList.toggle('dark', !isDark);
                document.documentElement.classList.toggle('light', isDark);
                localStorage.setItem('theme', isDark ? 'light' : 'dark');
                updateThemeIcon(!isDark);
            }

            if (themeToggleBtn) {
                // Initial icon state
                updateThemeIcon(document.documentElement.classList.contains('dark'));

                // Click handler
                themeToggleBtn.addEventListener('click', toggleTheme);
            }

            // System theme change handler
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                if (!localStorage.getItem('theme')) {
                    const shouldBeDark = e.matches;
                    document.documentElement.classList.toggle('dark', shouldBeDark);
                    document.documentElement.classList.toggle('light', !shouldBeDark);
                    updateThemeIcon(shouldBeDark);
                }
            });
        });
    </script>

    {{-- Notifications --}}
    @if (session('success'))
        <script>
            Swal.fire({
                title: 'Success!',
                text: "{{ session('success') }}",
                icon: 'success',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                }
            });
        </script>
    @endif
</body>
</html>