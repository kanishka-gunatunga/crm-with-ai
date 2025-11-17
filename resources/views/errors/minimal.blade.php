<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <style>
        :root {
            --font-family: 'Nunito Sans', sans-serif;
            --primary-color: #4A58EC;
            --primary-text-color: #556476;
            --primary-border-color: #d9d9d9;
            --primary-border-radius: 10px;
            --primary-btn-border-radius: 5px;
            --primary-background-color: #FFFFFF;
            --blue-shading: #E7E9FD;
            --red-shading: #FFE9E5;
            --green-shading: #E7F7F2;
            --orange-shading: #FFF1E4;
            --black-color: #172635;
            --red-color: #ED2227;
            --green-color: #00C500;
            --orange-color: #FF932F;
            --default-gap: 20px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-family);
            background-color: #F6F6F8;
            color: var(--primary-text-color);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        .error-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background-color: var(--blue-shading);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .error-icon::before {
            content: '';
            position: absolute;
            width: 60px;
            height: 60px;
            border: 4px solid var(--primary-color);
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s linear infinite;
        }

        .error-icon::after {
            content: '!';
            font-size: 48px;
            font-weight: bold;
            color: var(--primary-color);
            position: relative;
            z-index: 1;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .error-code {
            font-size: 96px;
            font-weight: 700;
            color: var(--black-color);
            line-height: 1;
            margin-bottom: 20px;
            letter-spacing: -2px;
        }

        .error-divider {
            width: 60px;
            height: 4px;
            background-color: var(--primary-color);
            margin: 0 auto 30px;
            border-radius: 2px;
        }

        .error-message {
            font-size: 24px;
            font-weight: 600;
            color: var(--black-color);
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .error-description {
            font-size: 16px;
            color: var(--primary-text-color);
            line-height: 1.6;
            margin-bottom: 40px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .error-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 14px 32px;
            font-size: 16px;
            font-weight: 600;
            border-radius: var(--primary-btn-border-radius);
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-family: var(--font-family);
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--primary-background-color);
        }

        .btn-primary:hover {
            background-color: #3a48cc;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(74, 88, 236, 0.3);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--primary-text-color);
            border: 2px solid var(--primary-border-color);
        }

        .btn-secondary:hover {
            border-color: var(--primary-color);
            color: var(--primary-color);
        }

        .error-links {
            margin-top: 40px;
            padding-top: 30px;
            border-top: 1px solid var(--primary-border-color);
        }

        .error-links-title {
            font-size: 14px;
            color: var(--primary-text-color);
            margin-bottom: 15px;
            font-weight: 600;
        }

        .error-links-list {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .error-links-list a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .error-links-list a:hover {
            color: #3a48cc;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .error-code {
                font-size: 72px;
            }

            .error-message {
                font-size: 20px;
            }

            .error-description {
                font-size: 14px;
            }

            .error-icon {
                width: 100px;
                height: 100px;
            }

            .error-icon::after {
                font-size: 40px;
            }

            .btn {
                padding: 12px 24px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .error-code {
                font-size: 56px;
            }

            .error-message {
                font-size: 18px;
            }

            .error-actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
            }

            .error-links-list {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="error-container">
        <div class="error-icon"></div>

        <div class="error-code">
            @yield('code')
        </div>

        <div class="error-divider"></div>

        <div class="error-message">
            @yield('message')
        </div>

        <div class="error-description">
            Oops! The page you're looking for doesn't exist. It might have been moved or deleted.
        </div>

        <div class="error-actions">
            <a href="{{ url('/') }}" class="btn btn-primary">Go to Homepage</a>
            <a href="javascript:history.back()" class="btn btn-secondary">Go Back</a>
        </div>


    </div>
</body>

</html>
