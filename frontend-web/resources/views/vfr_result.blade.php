<!-- <h2>Your Virtual Fitting Result</h2>
<img src="data:image/png;base64,{{ $image }}" alt="Result"><br>
<a href="{{ url('/') }}">Try Another</a> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Virtual Fitting Room</title>
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f8fafc;
            --card-bg: #ffffff;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --radius: 16px;
        }

        body {
            margin: 0;
            padding: 2rem 1rem;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            background-color: var(--card-bg);
            max-width: 480px;
            width: 100%;
            padding: 2.5rem 2rem;
            border-radius: var(--radius);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
            text-align: center;
        }

        .subtitle {
            text-transform: uppercase;
            letter-spacing: 0.1em;
            font-size: 0.75rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        h2 {
            margin: 0 0 1.5rem 0;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
        }

        .image-wrapper {
            position: relative;
            border-radius: calc(var(--radius) - 4px);
            overflow: hidden;
            background-color: #f1f5f9;
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);
            margin-bottom: 2rem;
        }

        .image-wrapper img {
            width: 100%;
            height: auto;
            display: block;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .image-wrapper:hover img {
            transform: scale(1.02);
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.75rem;
            font-size: 0.95rem;
            font-weight: 600;
            color: #ffffff;
            background-color: var(--primary-color);
            border-radius: 9999px;
            text-decoration: none;
            transition: all 0.2s ease;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.25);
        }

        .btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(79, 70, 229, 0.35);
        }

        .btn:active {
            transform: translateY(0);
        }
    </style>
</head>