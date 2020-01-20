<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <!-- Styles -->
        <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
        <script src="{{ asset('js/app.js') }}" defer></script>
   
    </head>
    <body>
    <header>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand header-logo" href="#">
            <img src="/storage/images/logo1.png" class="d-inline-block align-top header-img" alt="Logo">
                Travel Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mr-lg-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-title" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-title" href="#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-title" href="#posts">Posts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-title" href="#contact">Contacts</a>
                    </li>
                </ul>
                <ul class="navbar-nav mt-2 mt-lg-0">
                    @if (Route::has('login'))
                    <li class="ml-auto nav-item">
                        @auth
                        <a class="nav-link nav-title" href="{{ url('/dashboard') }}">Dashboard</a>
                    </li>
                    @else
                    <li class="nav-item">
                        <a class="nav-link nav-title" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-title" href="{{ route('register') }}">Register</a>
                        @endauth    
                    </li>
                    @endif    
                </ul>
            </div>
        </nav>
    </header>

        <div class="content">
            <div class="section-slider">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="/storage/carusel/slide1.jpg" class="d-block slider-image" alt="Travelers">
                            <div class="carousel-caption">
                                <h2 class="slider-title">Discover the world together</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carusel/slide2.jpg" class="d-block slider-image" alt="City">
                            <div class="carousel-caption">
                                <h2 class="slider-title rounded">Feel the rhythm of the cities</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carusel/slide3.jpg" class="d-block slider-image" alt="Fishers">
                            <div class="carousel-caption">
                                <h2 class="slider-title rounded">Dive into the authentic culture</h2>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="/storage/carusel/slide4.jpg" class="d-block slider-image" alt="Yacht">
                            <div class="carousel-caption">
                                <h2 class="slider-title rounded">Impress the uniqueness of nature</h2>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="section" id="about">
                <blockquote class="blockquote m-0">
                    <p>"The world is a book, and those who do not travel, read only a page"</p>
                    <footer class="blockquote-footer">Augustine, St.</footer>
                </blockquote>
                <h2 class="text-center section-title my-4">About us</h2>
                <div class="card-deck">
                    <div class="card">
                        <img class="img-about" src="/storage/images/story.jpg" alt="Story">
                        <div class="card-body">
                            <h5 class="card-title">Story</h5>
                            <p class="card-text">Travel Blog was founded by like-minded group of travellers from Ukraine in 2019. Together, they shared a deep conviction in the importance of travel and storytelling for opening our eyes and hearts to the beauty of other places and other peoples.</p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="img-about" src="/storage/images/mission.jpg" alt="Mission">
                        <div class="card-body">
                            <h5 class="card-title">Mission</h5>
                            <p class="card-text">We aim to provide a platform for those who document and capture the world around us, bringing them together to create a lasting record of life on Earth; so that people everywhere can experience the cultural and natural wonders of our planet.</p>
                        </div>
                    </div>
                    <div class="card">
                        <img class="img-about" src="/storage/images/team.jpg" alt="Team">
                        <div class="card-body">
                            <h5 class="card-title">Team</h5>
                            <p class="card-text">Travel Blog is a collaborative project with a diverse group of photographers, writers and adventurers. Together we bring readers a world of inspiring stories.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="posts">
                <blockquote class="blockquote m-0">
                    <p>"Because In The End, You Won’t Remember The Time You Spent Working In An Office Or Mowing Your Lawn. Climb That Damn Mountain"</p>
                    <footer class="blockquote-footer">Jack Kerouac</footer>
                </blockquote>
                <h2 class="text-center section-title my-4">Posts</h2>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-3 d-flex-column submenu border rounded p-3">
                        <div class="blog-categories mb-5">
                           <h4 class="submenu-title rounded p-2">Categories</h4>
                           <ol class="ol-catagories">
                                <li><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i>Adventure</span> <span>(3)</span></a></li>
                                <li><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i>Wild Nature</span> <span>(5)</span></a></li>
                                <li><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i>Culture and Traditions</span> <span>(9)</span></a></li>
                                <li><a href="#"><span><i class="fa fa-angle-double-right" aria-hidden="true"></i>Cities</span> <span>(3)</span></a></li>
                            </ol>
                        </div> 
                        <div class="blog-archives mb-5">
                            <h4 class="submenu-title rounded p-2">Archives</h4>
                            <ol class="ol-archives">
                                <li><a href="#">February 2019</a></li>
                                <li><a href="#">June 2019</a></li>
                                <li><a href="#">March 2019</a></li>
                                <li><a href="#">November 2019</a></li>
                            </ol>
                        </div>
                        <div class="blog-authors mb-5">
                            <h4 class="submenu-title rounded p-2">Authors</h4>
                            <ol class="ol-archives">
                                <li><a href="#">admin</a></li>
                                <li><a href="#">user</a></li>
                                <li><a href="#">user</a></li>
                            </ol>
                        </div>
                    </div>
                    <div class="col-12 col-md-9">
                        <div class="blog-posts">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <div class="single-blog-post">
                                        <div class="post-thumbnail">
                                            <a href="#"><img class="img-post" src="/storage/posts/parrot.jpg" alt="Parrot"></a>
                                        </div>
                                        <div class="post-content">
                                            <p class="post-date">MAY 10, 2018 / life</p>
                                            <a href="#" class="post-title">
                                                <h4>Travel Tuesday: Answering Your Most Frequent International Transportation Questions</h4>
                                            </a>
                                            <p class="post-excerpt">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="single-blog-post">
                                        <div class="post-thumbnail">
                                            <a href="#"><img class="img-post" src="/storage/posts/parrot.jpg" alt="Parrot"></a>
                                        </div>
                                        <div class="post-content">
                                            <p class="post-date">MAY 10, 2018 / life</p>
                                            <a href="#" class="post-title">
                                                <h4>Travel Tuesday: Answering Your Most Frequent International Transportation Questions</h4>
                                            </a>
                                            <p class="post-excerpt">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="single-blog-post">
                                        <div class="post-thumbnail">
                                            <a href="#"><img class="img-post" src="/storage/posts/parrot.jpg" alt="Parrot"></a>
                                        </div>
                                        <div class="post-content">
                                            <p class="post-date">MAY 10, 2018 / life</p>
                                            <a href="#" class="post-title">
                                                <h4>Travel Tuesday: Answering Your Most Frequent International Transportation Questions</h4>
                                            </a>
                                            <p class="post-excerpt">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="single-blog-post">
                                        <div class="post-thumbnail">
                                            <a href="#"><img class="img-post" src="/storage/posts/parrot.jpg" alt="Parrot"></a>
                                        </div>
                                        <div class="post-content">
                                            <p class="post-date">MAY 10, 2018 / life</p>
                                            <a href="#" class="post-title">
                                                <h4>Travel Tuesday: Answering Your Most Frequent International Transportation Questions</h4>
                                            </a>
                                            <p class="post-excerpt">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-5 text-center">
                                    <a href="">Show more</a>
                                </div>
                                <!-- <div class="col-12 mt-5">
                                    <nav aria-label="Page navigation example">
                                        <ul class="pagination justify-content-center">
                                            <li class="page-item disabled"><a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                            </li>
                                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                                        </ul>
                                    </nav> 
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="section" id="contact">
                <blockquote class="blockquote m-0">
                    <p>"Travel Is The Only Thing You Buy That Makes You Richer"</p>
                    <footer class="blockquote-footer">Anonymous</footer>
                </blockquote>
                <h2 class="text-center section-title my-4">Contact</h2>
                    <div class="col-12">
                        <iframe class="contact-iframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2175.2720789611085!2d28.396813356808664!3d49.2272189692915!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x472d5c45ae0ac501%3A0x2b88e678e1e6dd4e!2sMykoly%20Vaschuka%20St%2C%2020%2C%20Vinnytsia%2C%20Vinnyts&#39;ka%20oblast%2C%2021000!5e0!3m2!1sen!2sua!4v1577284899860!5m2!1sen!2sua" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                    </div>
                    <div class="col-12 d-flex flex-column flex-md-row justify-content-around my-4">
                        <div class="d-flex">
                            <img class="mr-3 img-contact" src="/storage/images/place.png" alt="Location"> 
                            <div class="d-flex align-items-center">
                                <p class="p-contact m-0">Vashchuka str. 20, Vinnytsia, 21029, Ukraine</p> 
                            </div>
                        </div>
                        <div class="d-flex">
                            <img class="mr-3 img-contact" src="/storage/images/mail.png" alt="Message">
                            <div class="d-flex align-items-center">
                                <p class="p-contact m-0">admin@gmail.com</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <img class="mr-3 img-contact" src="/storage/images/phone.png" alt="Phone">
                            <div class="d-flex align-items-center">
                                <p class="p-contact m-0">+38(067)431-74-24</p>
                            </div>
                        </div>
                    </div>
            </div>
            <footer class="footer bg-dark text-right">
                <p class="mb-0 mr-3">
                    Copyright © 2019 Travel Blog
                </p>
            </footer>
        </div>
    </body>
</html>
