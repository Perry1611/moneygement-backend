<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
    <style>
        /* Menghilangkan spinner di Chrome, Safari, Edge, dan Opera */
        input[type='number']::-webkit-outer-spin-button,
        input[type='number']::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Menghilangkan spinner di Firefox */
        input[type='number'] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="bg-gray-200 font-sans leading-normal tracking-normal">
    @include('dashboard.layouts.navbar')
    @yield('content')
    @include('dashboard.layouts.footer')
    <script>
        document.getElementById('income-form').addEventListener('submit', function(event) {
            var amountInput = document.getElementById('income');
            if (!/^\d+$/.test(amountInput.value)) {
                event.preventDefault();
                alert('Please enter a valid number for the income amount.');
            }
        });
    </script>
</body>
</html>
