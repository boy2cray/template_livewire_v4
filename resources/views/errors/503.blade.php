<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeliharaan Sistem - Koperasi</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #2563eb;
            --bg-gradient: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            --text-main: #1e293b;
            --text-muted: #64748b;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background: var(--bg-gradient);
            color: var(--text-main);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            text-align: center;
            padding: 20px;
            width: 100%;
            max-width: 480px;
        }

        .card {
            background: #ffffff;
            padding: 40px;
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            animation: fadeIn 0.8s ease-out;
        }

        /* Animasi Muncul */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .icon-wrapper {
            background: #eff6ff;
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 24px;
        }

        .icon-wrapper svg {
            width: 40px;
            height: 40px;
            color: var(--primary-color);
        }

        h1 {
            font-size: 24px;
            font-weight: 700;
            margin: 0 0 12px 0;
            color: #0f172a;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            color: var(--text-muted);
            margin-bottom: 30px;
        }

        /* Loading Bar yang lebih elegan daripada spinner biasa */
        .progress-container {
            width: 100%;
            background-color: #f1f5f9;
            border-radius: 10px;
            height: 8px;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .progress-bar {
            width: 40%;
            height: 100%;
            background-color: var(--primary-color);
            border-radius: 10px;
            animation: loading 2s infinite ease-in-out;
        }

        @keyframes loading {
            0% { transform: translateX(-100%); }
            100% { transform: translateX(250%); }
        }

        .contact-btn {
            display: inline-block;
            background-color: var(--primary-color);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.3s ease;
        }

        .contact-btn:hover {
            background-color: #1d4ed8;
        }

        .footer {
            margin-top: 32px;
            font-size: 13px;
            color: var(--text-muted);
        }

        .status-badge {
            display: inline-block;
            padding: 6px 12px;
            background: #fef3c7;
            color: #92400e;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card">
        <div class="status-badge">Sedang Diperbarui</div>
        
        <div class="icon-wrapper">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
        </div>

        <h1>Peningkatan Sistem</h1>
        <p>Kami sedang melakukan pemeliharaan rutin untuk memberikan layanan yang lebih baik dan lebih aman bagi Anda.</p>

        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>

        <a href="mailto:support@koperasianda.com" class="contact-btn">Hubungi Dukungan</a>

        <div class="footer">
            &copy; {{ date('Y') }} TLV-4 By:Eko_teknik • Tim IT. EL.
        </div>
    </div>
</div>

</body>
</html>