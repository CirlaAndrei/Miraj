<!DOCTYPE html>
<html>
<head>
    <title>Mesaj nou de pe Miraj</title>
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
        .field {
            margin-bottom: 20px;
        }
        .field-label {
            font-weight: 600;
            color: #764ba2;
            margin-bottom: 5px;
        }
        .field-value {
            background: white;
            padding: 10px 15px;
            border-radius: 5px;
            border-left: 3px solid #764ba2;
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
        <p>Ai primit un mesaj nou de pe site</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="field-label">Nume:</div>
            <div class="field-value">{{ $data['name'] }}</div>
        </div>

        <div class="field">
            <div class="field-label">Email:</div>
            <div class="field-value">{{ $data['email'] }}</div>
        </div>

        @if($data['phone'])
        <div class="field">
            <div class="field-label">Telefon:</div>
            <div class="field-value">{{ $data['phone'] }}</div>
        </div>
        @endif

        <div class="field">
            <div class="field-label">Subiect:</div>
            <div class="field-value">
                @switch($data['subject'])
                    @case('info') Informații produse @break
                    @case('order') Problemă comandă @break
                    @case('return') Returnare produs @break
                    @case('partnership') Parteneriate @break
                    @default Altele
                @endswitch
            </div>
        </div>

        <div class="field">
            <div class="field-label">Mesaj:</div>
            <div class="field-value" style="white-space: pre-line;">{{ $data['message'] }}</div>
        </div>
    </div>

    <div class="footer">
        <p>Acest mesaj a fost trimis de pe formularul de contact Miraj.</p>
        <p>© {{ date('Y') }} Miraj. Toate drepturile rezervate.</p>
    </div>
</body>
</html>
