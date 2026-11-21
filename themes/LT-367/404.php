<style>
    .error-container {
        position: relative;
        text-align: center;
        z-index: 2;
        padding: 100px 0;
    }

    .title {
        font-size: 80px;
        font-weight: 700;
        color: #4d7031;
        animation: fadeInDown 1s ease-out;
    }

    .subtitle {
        font-size: 22px;
        margin: 20px 0;
        color: #53682d;
        animation: fadeInUp 1.5s ease-out;
    }

    .home-button {
        display: inline-block;
        padding: 12px 30px;
        background-color: #53682d;
        color: white;
        font-size: 18px;
        text-decoration: none;
        border-radius: 30px;
        margin-top: 20px;
        transition: background 0.3s;
        animation: fadeInUp 2s ease-out;
    }

    .home-button:hover {
        background-color: #6f8a3a;
    }

    .bubble-animation::before,
    .bubble-animation::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background-color: rgba(173, 216, 230, 0.3);
        animation: rise 8s infinite ease-in;
    }

    .bubble-animation::before {
        width: 100px;
        height: 100px;
        left: 10%;
        bottom: -150px;
        animation-delay: 1s;
    }

    .bubble-animation::after {
        width: 70px;
        height: 70px;
        left: 80%;
        bottom: -100px;
        animation-delay: 3s;
    }

    /* Animations */
    @keyframes float {

        0%,
        100% {
            transform: translateY(0px);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-40px);
        }

        to {
            opacity: 1;
            transform: translateY(0px);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }

        to {
            opacity: 1;
            transform: translateY(0px);
        }
    }

    @keyframes rise {
        0% {
            transform: translateY(0) scale(1);
            opacity: 0.5;
        }

        100% {
            transform: translateY(-800px) scale(1.5);
            opacity: 0;
        }
    }
    
</style>
<div class="error-container">
    <div class="bubble-animation"></div>
    <div class="error-content">
        <h1 class="title">Oops! 404</h1>
        <p class="subtitle">Looks like you took a wrong step!</p>
        <a href="<?= systemVariable('SITE_HOME') ?>" class="home-button">Back to Home</a>
    </div>
</div>