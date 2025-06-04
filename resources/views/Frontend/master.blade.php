<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Vie EMSI - Association des Étudiants</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-scholar.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>

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

        .mission-card {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 30px;
            border-left: 5px solid #43d34f;
        }

        .mission-card h4 {
            color: #43d34f;
            margin-bottom: 20px;
        }

        .objectives-list {
            list-style: none;
            padding: 0;
        }

        .objectives-list li {
            padding: 10px 0;
            padding-left: 30px;
            position: relative;
        }

        .objectives-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #43d34f;
            font-weight: bold;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a class="logo">
                            <h1>Vie EMSI</h1>
                        </a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#about">À Propos de Nous</a></li>
                            <li class="scroll-to-section"><a href="#activities">Nos Activités</a></li>
                            <li class="scroll-to-section"><a href="{{ route('register') }}">Register</a></li>
                        </ul>   
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <!-- ***** Main Banner Start ***** -->
    <div class="main-banner" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-banner">
                        <div class="item item-1">
                            <div class="header-text">
                                <span class="category">Notre Association</span>
                                <h2>Bienvenue sur le portail de l'Association des Étudiants EMSI</h2>
                                <p>Découvrez nos événements, projets, opportunités et activités pour les étudiants.</p>
                                <div class="buttons">
                                    <div class="main-button">
                                        <a href="#about">En savoir plus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner End ***** -->

    <!-- ***** About Us Section Start ***** -->
    <div class="section about-us" id="about" style="padding: 100px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>À Propos de Nous</h6>
                        <h2>Association des Étudiants EMSI</h2>
                        <p style="max-width: 600px; margin: 0 auto 60px; color: #666; font-size: 1.1rem;">
                            Une communauté dynamique dédiée à l'épanouissement académique, personnel et professionnel de tous les étudiants EMSI.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-6">
                    <div class="mission-card">
                        <h4>Notre Mission</h4>
                        <p style="line-height: 1.8; color: #555;">
                            L'Association des Étudiants de l'EMSI a pour mission de créer un environnement dynamique et enrichissant pour tous les étudiants. Nous organisons des événements, des ateliers, et des activités qui favorisent le développement personnel et professionnel de nos membres.
                        </p>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="mission-card">
                        <h4>Nos Objectifs</h4>
                        <ul class="objectives-list">
                            <li>Promouvoir l'excellence académique</li>
                            <li>Faciliter l'intégration des nouveaux étudiants</li>
                            <li>Organiser des événements culturels et sportifs</li>
                            <li>Créer des opportunités de networking</li>
                            <li>Soutenir les projets étudiants innovants</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** About Us Section End ***** -->

    <!-- ***** Activities Section Start ***** -->
    <div class="section activities" id="activities" style="padding: 100px 0; background: #f8f9fa;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="section-heading">
                        <h6>Nos Activités</h6>
                        <h2>Découvrez Nos Programmes</h2>
                        <p style="max-width: 600px; margin: 0 auto 60px; color: #666; font-size: 1.1rem;">
                            Nous proposons une large gamme d'activités tout au long de l'année académique pour enrichir votre expérience étudiante.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item" style="margin-bottom: 20px; border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background: #fff; border: none; padding: 25px; font-weight: 600;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 50px; height: 50px; background: #43d34f; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; color: white; font-size: 1.2rem;">
                                            🎓
                                        </div>
                                        <div>
                                            <strong style="font-size: 1.2rem;">Événements Académiques</strong>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 30px; background: #fff; color: #555; line-height: 1.8;">
                                    Conférences, séminaires, ateliers de formation, et sessions de tutorat pour soutenir la réussite académique de tous les étudiants. Nous organisons également des rencontres avec des professionnels du secteur pour vous aider à construire votre avenir professionnel.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="margin-bottom: 20px; border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="background: #fff; border: none; padding: 25px; font-weight: 600;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 50px; height: 50px; background: #43d34f; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; color: white; font-size: 1.2rem;">
                                            🎨
                                        </div>
                                        <div>
                                            <strong style="font-size: 1.2rem;">Activités Culturelles</strong>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 30px; background: #fff; color: #555; line-height: 1.8;">
                                    Festivals, spectacles, expositions d'art, et célébrations des traditions culturelles diverses de notre communauté étudiante. Ces événements permettent de découvrir et célébrer la richesse culturelle de notre campus.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="margin-bottom: 20px; border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree" style="background: #fff; border: none; padding: 25px; font-weight: 600;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 50px; height: 50px; background: #43d34f; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; color: white; font-size: 1.2rem;">
                                            ⚽
                                        </div>
                                        <div>
                                            <strong style="font-size: 1.2rem;">Sports et Loisirs</strong>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 30px; background: #fff; color: #555; line-height: 1.8;">
                                    Tournois sportifs, activités de plein air, clubs de fitness, et événements de bien-être pour maintenir un équilibre vie-études. Le sport est essentiel pour votre santé physique et mentale.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item" style="margin-bottom: 20px; border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                            <h2 class="accordion-header" id="headingFour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour" style="background: #fff; border: none; padding: 25px; font-weight: 600;">
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 50px; height: 50px; background: #43d34f; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 20px; color: white; font-size: 1.2rem;">
                                            💚
                                        </div>
                                        <div>
                                            <strong style="font-size: 1.2rem;">Projets Communautaires</strong>
                                        </div>
                                    </div>
                                </button>
                            </h2>
                            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                <div class="accordion-body" style="padding: 30px; background: #fff; color: #555; line-height: 1.8;">
                                    Initiatives de bénévolat, projets de service communautaire, et actions de sensibilisation pour avoir un impact positif sur la société. Ensemble, nous contribuons au développement de notre communauté.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Activities Section End ***** -->

    <!-- Scripts -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/custom.js"></script>

    <script>
        window.addEventListener("load", function () {
            const preloader = document.getElementById("js-preloader");
            if (preloader) {
                preloader.style.opacity = '0';
                preloader.style.transition = 'opacity 0.5s ease';
                setTimeout(() => preloader.style.display = 'none', 500);
            }
        });
    </script>

</body>
</html>