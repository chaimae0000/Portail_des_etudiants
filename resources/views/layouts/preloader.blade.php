<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Preloader</title>
</head>
<body>
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            
          
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

   

    <style> 
        .js-preloader {
            position: fixed;
            background: #fff;
            z-index: 9999;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .preloader-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .preloader-inner .dot {
            width: 20px;
            height: 20px;
            background: #43d34f;
            border-radius: 50%;
            animation: pulse 0.8s infinite ease-in-out;
        }

        .dots {
            display: flex;
            align-items: center;
        }

        .dots span {
            display: inline-block;
            width: 10px;
            height: 10px;
            background: #43d34f;
            margin: 0 5px;
            border-radius: 50%;
            animation: bounce 1.2s infinite ease-in-out;
        }

        .dots span:nth-child(1) { animation-delay: 0s; }
        .dots span:nth-child(2) { animation-delay: 0.2s; }
        .dots span:nth-child(3) { animation-delay: 0.4s; }

        @keyframes pulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.3); }
        }

        @keyframes bounce {
            0%, 100% { 
                transform: translateY(0);
                opacity: 0.6;
            }
            50% { 
                transform: translateY(-12px);
                opacity: 1;
            }
        }
    </style>

    <script>
        window.addEventListener("load", function () {
            const preloader = document.getElementById("js-preloader");
            if (preloader) {
                preloader.style.opacity = '0';
                preloader.style.transition = 'opacity 0.5s ease';
                setTimeout(() => preloader.style.display = 'none', 500);
            }
        });

        // Demo timer for testing
        setTimeout(() => {
            const preloader = document.getElementById("js-preloader");
            if (preloader && preloader.style.display !== 'none') {
                preloader.style.opacity = '0';
                preloader.style.transition = 'opacity 0.5s ease';
                setTimeout(() => preloader.style.display = 'none', 500);
            }
        }, 3000);
    </script>
</body>
</html>