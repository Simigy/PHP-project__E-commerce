<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Language Switcher</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 40px;
            background-color: #f8f9fa;
        }
        .language-card {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            background-color: white;
        }
        .language-button {
            margin: 10px;
            padding: 15px 30px;
            font-size: 18px;
            border-radius: 6px;
        }
        .current-language {
            margin-top: 30px;
            padding: 20px;
            background-color: #f1f1f1;
            border-radius: 6px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="language-card">
            <h1 class="text-center mb-4">Language Switcher</h1>

            <p class="text-center">Select your preferred language:</p>

            <div class="d-flex justify-content-center flex-wrap">
                @foreach(config('languages.supported') as $locale => $language)
                    <a href="{{ route('language.switch', $locale) }}"
                       class="btn {{ app()->getLocale() == $locale ? 'btn-primary' : 'btn-outline-primary' }} language-button">
                        {{ $language['name'] }}
                    </a>
                @endforeach
            </div>

            <div class="current-language">
                <h3 class="text-center">Current Language</h3>
                <div class="text-center">
                    <p><strong>Locale:</strong> {{ app()->getLocale() }}</p>
                    <p><strong>Name:</strong> {{ config('languages.supported.' . app()->getLocale() . '.name') }}</p>
                    <p><strong>Flag Code:</strong> {{ config('languages.supported.' . app()->getLocale() . '.flag') }}</p>
                    <p><strong>Welcome Text:</strong> {{ __('message.welcome') }}</p>
                    <p><strong>Dashboard Text:</strong> {{ __('message.dashboard') }}</p>
                </div>
            </div>

            <div class="text-center mt-4">
                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Back to Admin Dashboard</a>
            </div>
        </div>
    </div>
</body>
</html>
