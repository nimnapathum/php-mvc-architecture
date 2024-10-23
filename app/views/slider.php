<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HeyAstro</title>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/slider.css">
    <link rel="shortcut icon" href="<?php echo URLROOT; ?>/img/logo.png" type="image/png">
</head>

<body>
    <main>
        <header>
            <figure class="logo"><img src="<?php echo URLROOT; ?>/img/logo.png" alt=""></figure>
            <nav>
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14" />
                </svg>

            </nav>
        </header>

        <section class="slider">
            <div class="list">
                <div class="item active">
                    <div class="image" style="--url : url('<?php echo URLROOT; ?>/img/world1.jpg')"></div>
                    <div class="content">
                        <h2>Astro naut</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem delectus consequuntur voluptatibus, nisi eius earum consectetur quam at! Omnis velit excepturi soluta doloribus consequuntur aspernatur officia ex non minus quos?</p>
                        <p>Hey welcome to the astro-world</p>
                    </div>
                </div>
                <div class="item">
                    <div class="image" style="--url : url('<?php echo URLROOT; ?>/img/world2.jpg')"></div>
                    <div class="content">
                        <h2>Astro naut</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem delectus consequuntur voluptatibus, nisi eius earum consectetur quam at! Omnis velit excepturi soluta doloribus consequuntur aspernatur officia ex non minus quos?</p>
                        <p>Hey welcome to the astro-world</p>
                    </div>
                </div>
                <div class="item">
                    <div class="image" style="--url : url('<?php echo URLROOT; ?>/img/world3.jpg')"></div>
                    <div class="content">
                        <h2>Astro naut</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatem delectus consequuntur voluptatibus, nisi eius earum consectetur quam at! Omnis velit excepturi soluta doloribus consequuntur aspernatur officia ex non minus quos?</p>
                        <p>Hey welcome to the astro-world</p>
                    </div>
                </div>
            </div>

            <div class="arrows">
                <button id="prev" class="prev">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                </button>
                <button id="next" class="next">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </button>
            </div>
        </section>
    </main>

    <script src="<?php echo URLROOT; ?>/js/slider.js"></script>
</body>

</html>