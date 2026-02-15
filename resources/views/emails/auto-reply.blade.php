<!DOCTYPE html>
<html>
<head>
    <title>Am primit mesajul tău - Miraj</title>
    <style>
        body {
            font-family: 'Poppins', Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f9f9f9;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            text-decoration: none;
            border-radius: 25px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>✨ Miraj</h1>
        <p>Mulțumim că ne-ai contactat!</p>
    </div>

    <div class="content">
        <h2>Bună {{ $name }},</h2>

        <p>Am primit mesajul tău și îți mulțumim că ai ales să ne contactezi.</p>

        <p>Echipa noastră va analiza mesajul tău și îți va răspunde în cel mai scurt timp posibil, de obicei în maxim 24-48 de ore.</p>

        <div style="text-align: center;">
            <a href="{{ route('home') }}" class="button">Continuă cumpărăturile</a>
        </div>

        <p>Până atunci, te invităm să descoperi cele mai noi produse din colecția noastră.</p>

        <p>Cu drag,<br>Echipa Miraj</p>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} Miraj. Toate drepturile rezervate.</p>
        <p>Strada Exemplu, Nr. 123, București</p>
    </div>
</body>
</html>
