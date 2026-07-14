<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 */
?>
<link href="<?php echo get_template_directory_uri() ?>/css/fonts.css"
      rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
      rel="stylesheet">
<style>
    body {
        margin: 0;
        font-family: 'Montserrat', sans-serif;
    }

    .not_found_container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        color: white;
        position: relative;
        background-position: center; /* Center the image */
        background-repeat: no-repeat; /* Do not repeat the image */
        background-size: cover;
    }

    .not_found_container:before {
        position: absolute;
        content: '';
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(31, 26, 81, 0.8);
    }

    .not_found_container .wrapper_content {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .not_found_container .wrapper_content h1,
    .not_found_container .wrapper_content h2 {
        margin: 10px;
        cursor: default;
    }

    .not_found_container .wrapper_content h1 .fade-in,
    .not_found_container .wrapper_content h2 .fade-in {
        animation: fadeIn 2s ease infinite;
    }

    .not_found_container .wrapper_content h1 {
        font-size: 12rem;
        line-height: 1.2;
        transition: font-size 200ms ease-in-out;
    }

    @media (max-width: 767px) {

        .not_found_container .wrapper_content h1 {
            font-size: 8rem;
        }

    }
    @media (max-width: 380px) {

        .not_found_container .wrapper_content h1 {
            font-size: 5rem;
        }

    }

    .not_found_container .wrapper_content h1 span#digit1 {
        animation-delay: 200ms;
    }

    .not_found_container .wrapper_content h1 span#digit2 {
        animation-delay: 300ms;
    }

    .not_found_container .wrapper_content h1 span#digit3 {
        animation-delay: 400ms;
    }

    .not_found_container .wrapper_content .button {
        font-family: 'Segoe UI', sans-serif;
        display: inline-block;
        border: 1px solid white;
        background: transparent;
        outline: none;
        border-radius: 24px;
        padding: 10px 20px;
        font-size: 1.1rem;
        font-weight: bold;
        color: white;
        text-transform: uppercase;
        transition: background-color 200ms ease-in;
        margin: 20px 0;
        text-decoration: none;
    }

    .not_found_container .wrapper_content .button:hover {
        background-color: white;
        color: #555;
        cursor: pointer;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }
</style>

<div class="not_found_container"
     style="background-image: url(https://uni-munich.de/wp-content/uploads/2024/10/MUDT-Campus-banner-image-min-1640x740.webp)">
    <div class="wrapper_content">
        <h1>
            <span class="fade-in" id="digit1">4</span>
            <span class="fade-in" id="digit2">0</span>
            <span class="fade-in" id="digit3">4</span>
        </h1>
        <h2 class="fadeIn"><?php echo _e('PAGE NOT FOUND', 'MUDT'); ?> </h2>
        <a class="button" href="<?php echo get_home_url() ?>"><?php echo _e('Return To Home', 'MUDT'); ?> </a>
    </div>
</div>

<?php ?>
