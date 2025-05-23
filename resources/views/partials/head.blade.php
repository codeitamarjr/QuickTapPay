<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" type="image/png" href="{{ asset('/favicon/favicon-96x96.png') }}" sizes="96x96" />
<link rel="icon" href="{{ asset('/favicon/favicon.ico') }}" sizes="any">
<link rel="icon"type="image/svg+xml" href="{{ asset('/favicon/favicon.svg') }}" type="image/svg+xml">
<link rel="apple-touch-icon" href="{{ asset('/favicon/apple-touch-icon.png') }}" sizes="180x180">
<link rel="manifest" href="{{ asset('/favicon/site.webmanifest') }}">

@vite(['resources/css/app.css', 'resources/js/app.js'])
@fluxAppearance
