<style>
    @import url('https://fonts.googleapis.com/css?family=Nunito:400,600,700');
    /* @nunito-font: 'Nunito', sans-serif; */
    /* mixins */
    
    @mixin breakpoint($point) {
        @if $point==mobile {
            @media (max-width: 480px) and (min-width: 320px) {
                @content ;
            }
        }
    }
    /* keyrames */
    
    @keyframes floating {
        from {
            transform: translateY(0px);
        }
        65% {
            transform: translateY(15px);
        }
        to {
            transform: translateY(-0px);
        }
    }
    
    html {
        height: 100%;
    }
    
    body {
        background-image: url('404/star.svg'), linear-gradient(to bottom, #05007A, #4D007D);
        height: 100%;
        margin: 0;
        background-attachment: fixed;
        overflow: hidden;
    }
    
    .mars {
        left: 0;
        right: 0;
        bottom: 0;
        position: absolute;
        height: 27vmin;
        background: url('404/mars.svg') no-repeat bottom center;
        background-size: cover;
    }
    
    .logo-404 {
        position: absolute;
        margin-left: auto;
        margin-right: auto;
        left: 0;
        right: 0;
        top: 16vmin;
        width: 30vmin;
        @include breakpoint(mobile) {
            top: 45vmin;
        }
    }
    
    .meteor {
        position: absolute;
        right: 2vmin;
        top: 16vmin;
    }
    
    .title {
        color: white;
        font-family: 'Nunito', sans-serif;
        font-weight: 600;
        text-align: center;
        font-size: 5vmin;
        margin-top: 31vmin;
        @include breakpoint(mobile) {
            margin-top: 65vmin;
        }
    }
    
    .subtitle {
        color: white;
        font-family: 'Nunito', sans-serif;
        font-weight: 400;
        text-align: center;
        font-size: 3.5vmin;
        margin-top: -1vmin;
        margin-bottom: 9vmin;
    }
    
    .btn-back {
        border: 1px solid white;
        color: white;
        height: 5vmin;
        padding: 12px;
        font-family: 'Nunito', sans-serif;
        text-decoration: none;
        border-radius: 5px;
    }
    
    a:hover {
        background-color: white;
        color: #4D007D;
    }
    
    @include breakpoint(mobile) {
        font-size: 3.5vmin;
    }
    
    .astronaut {
        position: absolute;
        top: 18vmin;
        left: 10vmin;
        height: 30vmin;
        animation: floating 3s infinite ease-in-out;
        @include breakpoint(mobile) {
            top: 2vmin;
        }
    }
    
    .spaceship {
        position: absolute;
        bottom: 15vmin;
        right: 24vmin;
        @include breakpoint(mobile) {
            width: 45vmin;
            bottom: 18vmin;
        }
    }
</style>
<div class="mars"></div>
<img src="404/404.svg" class="logo-404" />
<img src="404/meteor.svg" class="meteor" />
<p class="title">Oh no!!</p>
<p class="subtitle">
    You&#39re either misspelling the URL <br /> or requesting a page that's no longer here.
</p>
<div align=center>
    <a class="btn-back" href="<?php if(isset($_SERVER['HTTP_REFERER'])){ echo $_SERVER['HTTP_REFERER'];}else{ echo "home";} ?>">Back to previous page</a>
</div>
<img src="404/astronaut.svg" class="astronaut" />
<img src="404/spaceship.svg" class="spaceship" />