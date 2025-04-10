<!DOCTYPE html>
<html>
<head>
    <title>Asset Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .info { margin: 10px 0; padding: 10px; border: 1px solid #ddd; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Asset Test Results</h1>
    
    <div class="info">
        <h3>Style.css File:</h3>
        <p>Path: {{ $stylePath }}</p>
        <p>Exists: <span class="{{ $styleExists ? 'success' : 'error' }}">{{ $styleExists ? 'Yes' : 'No' }}</span></p>
        <p>Size: {{ $styleSize }} bytes</p>
    </div>

    <div class="info">
        <h3>Public Path:</h3>
        <p>{{ $publicPath }}</p>
    </div>

    <div class="info">
        <h3>Asset URLs:</h3>
        <p>Asset Helper: {{ $assetPath }}</p>
        <p>URL Helper: {{ $urlPath }}</p>
    </div>

    <div class="info">
        <h3>Direct Asset Test:</h3>
        <link rel="stylesheet" href="{{ asset('Admin/assets/css/style.css') }}">
        <p>If you see styling applied to this page, the asset is loading correctly.</p>
    </div>
</body>
</html> 