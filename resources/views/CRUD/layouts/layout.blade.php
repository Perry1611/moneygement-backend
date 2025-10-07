<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/dashboard.css">
    {{-- trix-editor --}}
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
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

        trix-toolbar [data-trix-button-group="file-tools"] {
            display: none;
        }

    </style>
</head>
<body class="font-sans leading-normal tracking-normal">
    @include('CRUD.layouts.navbar')
    @yield('content')
    @include('CRUD.layouts.footer')
    <script>
        document.getElementById('income-form').addEventListener('submit', function(event) {
            var amountInput = document.getElementById('cost');
            if (!/^\d+$/.test(amountInput.value)) {
                event.preventDefault();
                alert('Please enter a valid number for the income amount.');
            }
        });

        document.addEventListener('trix-file-accept', function(event) {
            event.preventDefault();
        });
    </script>
</body>
</html>
