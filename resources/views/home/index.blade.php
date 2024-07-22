<!doctype html>
<!--
 Author by FreeHTML5.co
 Twitter: https://twitter.com/fh5co
 Facebook: https://fb.com/fh5co
 URL: https://freehtml5.co
-->
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="home/css/style.css">
    <link rel="stylesheet" href="home/css/slick.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <title>Author</title>
    {{-- sweetalert --}}
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins') }}/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist') }}/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        /* typing */
        .typing-container {
            display: flex;
            align-items: center;
        }

        .cursor {
            display: inline-block;
            background-color: white;
            animation: blink 0.7s steps(1) infinite;
            margin-left: 1px;
        }
    </style>
</head>

<body>

    <!-- Navigation -->
    <nav class="site-navigation">
        <div class="site-navigation-inner site-container">
            <img src="home/images/site-logo.png" alt="site logo">
            <div class="main-navigation">
                <ul class="main-navigation__ul">
                    <li><a href="#">Homepage</a></li>
                    <li><a href="#">Page 1</a></li>
                    <li><a href="#">Page 2</a></li>
                    <li><a href="#">Page 3</a></li>
                    <li><a href="#">Page 4</a></li>
                </ul>
            </div>
            <div id="myBtn" class="burger-container" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
            <script>
                function myFunction(x) {
                    x.classList.toggle("change");
                }
            </script>

        </div>
    </nav>
    <!-- Navigation end -->

    <!-- Top banner -->
    <section class="fh5co-top-banner">
        <div class="top-banner__inner site-container">
            <div class="top-banner__image">
                <img src="home/images/top-banner-author.jpg" width="600px" class="img-fluid" alt="author image">
            </div>
            <div class="top-banner__text">
                <div class="typing-container ">
                    <div id="text-data" class="top-banner__text-up"
                        data-texts='[
                            @if (Auth::check()) "Hallo {{ Auth::user()->name }}",
                            @else
                            "Yuk Daftar", @endif
                            "Record Aplication"]'
                        style="display: none;">
                    </div>
                    <div class="top-banner__text-up">
                        <span id="typing-text" class="fs-2 text-light fw-bold"></span>
                        <h1 class="cursor text-light">i
                        </h1>
                    </div>

                </div>
                @if (Auth::check())
                    <a href="#history" class="btn btn-outline-success">Lihat History</a>
                @else
                    <a href="login" class="btn btn-outline-secondary">login </a>
                @endif
            </div>
        </div>
    </section>
    <!-- Top banner end -->

    <!-- Books and CD -->
    <section class="fh5co-books">
        <div class="site-container">
            <h2 class="universal-h2 universal-h2-bckg">History</h2>
            <div class="container">
                <div class="books-brand-button pb-3">
                    @if (Auth::check())
                    <h4>id checkin : {{ Auth::user()->id }}</h4>
                        <button type="button" class="brand-button" data-bs-toggle="modal"
                            data-bs-target="#tambahdata">Tambahkan
                            Record
                        </button>
                    @else
                        <button type="button" class="brand-button notlogin">Tambahkan
                            Record
                        </button>
                    @endif
                </div>
                <div class="card" id="history">
                    <div class="card-header">
                        <div class="row d-flex align-items-center">
                            <h3 class="col-4 card-title">Record Perjalanan Mu Bulan ini</h3>
                            <form class="col-4" action="{{ url('sortir') }}" method="post">
                                @csrf
                                <div class="row">
                                    <input  type="number" class="col-3 form-control" name="bulan" placeholder="0"
                                        min="1" max="12" value="{{ $bulan }}">
                                    <button class="btn btn-primary col-2 ml-2"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>waktu</th>
                                    <th>Lokasi</th>
                                    <th style="width: 40px">Suhu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Auth::check())
                                    @foreach ($history as $index => $historys)
                                        <tr>
                                            <td>{{ $index + 1 }}.</td>
                                            <td>{{ $historys->tanggal }} - {{ $historys->waktu }}</td>
                                            <td>{{ $historys->lokasi }}</td>
                                            <td><span class="badge {{ $historys->suhubg }}">{{ $historys->suhu }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center" colspan="4">Silahkan login terlebih dahulu</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>
        </div>

    </section>
    <!-- Books and CD end -->

    <!-- Counter -->
    <div class="fh5co-counter counters">
        <div class="counter-inner site-container">
            <div class="single-count">
                <span class="count" data-count="50">0</span>
                <div class="single-count__text">
                    <img src="home/images/counter-1.png" alt="counter icon">
                    <p>Books</p>
                </div>
            </div>
            <div class="single-count">
                <span class="count" data-count="600">0</span>
                <div class="single-count__text">
                    <img src="home/images/counter-2.png" alt="counter icon">
                    <p>Pages</p>
                </div>
            </div>
            <div class="single-count">
                <span class="count" data-count="2000">0</span>
                <div class="single-count__text">
                    <img src="home/images/counter-3.png" alt="counter icon">
                    <p>Sales</p>
                </div>
            </div>
            <div class="single-count">
                <span class="count" data-count="125">0</span>
                <div class="single-count__text">
                    <img src="home/images/counter-4.png" alt="counter icon">
                    <p>Awards</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Counter -->

    <!-- Blog -->
    <section class="fh5co-blog">
        <div class="site-container">
            <h2 class="universal-h2 universal-h2-bckg">My Blog</h2>
            <div class="blog-slider blog-inner">
                <div class="single-blog">
                    <div class="single-blog__img">
                        <img src="home/images/blog1.jpg" alt="blog image">
                    </div>
                    <div class="single-blog__text">
                        <h4>The Journey Under the Waves</h4>
                        <span>On August 28, 2015</span>
                        <p>Quisque vel sapi nec lacus adipis cing bibendum nullam porta lites laoreet aliquam.velitest,
                            tempus a ullamcorper et, lacinia mattis mi. Cras arcu nulla, blandit id cursus et, ultricies
                            eu leo.</p>
                    </div>
                </div>
                <div class="single-blog">
                    <div class="single-blog__img">
                        <img src="home/images/blog2.jpg" alt="blog image">
                    </div>
                    <div class="single-blog__text">
                        <h4>The Journey Under the Waves</h4>
                        <span>On August 28, 2015</span>
                        <p>Quisque vel sapi nec lacus adipis cing bibendum nullam porta lites laoreet aliquam.velitest,
                            tempus a ullamcorper et, lacinia mattis mi. Cras arcu nulla, blandit id cursus et, ultricies
                            eu leo.</p>
                    </div>
                </div>
                <div class="single-blog">
                    <div class="single-blog__img">
                        <img src="home/images/blog2.jpg" alt="blog image">
                    </div>
                    <div class="single-blog__text">
                        <h4>The Journey Under the Waves</h4>
                        <span>On August 28, 2015</span>
                        <p>Quisque vel sapi nec lacus adipis cing bibendum nullam porta lites laoreet aliquam.velitest,
                            tempus a ullamcorper et, lacinia mattis mi. Cras arcu nulla, blandit id cursus et, ultricies
                            eu leo.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog end -->

    <!-- Quotes -->
    <section class="fh5co-quotes">
        <div class="site-container">
            <div class="about-me-slider">
                <div>
                    <h2 class="universal-h2 universal-h2-bckg">What People Are Saying</h2>
                    <p>“Pudding croissant cake candy canes fruitcake sweet roll pastry gummies sugar plum. Tart pastry
                        danish soufflé donut bear claw chocolate cake marshmallow chupa chups. Jelly danish gummi bears
                        cake donut powder chocolate cake. Bonbon soufflé lollipop biscuit dragée jelly-o. Wafer pastry
                        pudding tiramisu chocolate bar croissant cake. Pie caramels gummies danish.”</p>
                    <img src="home/images/quotes.svg" alt="quotes svg">
                    <h4>David Dixon</h4>
                    <p>Reader</p>
                </div>
                <div>
                    <h2 class="universal-h2 universal-h2-bckg">What People Are Saying 2</h2>
                    <p>“Pudding croissant cake candy canes fruitcake sweet roll pastry gummies sugar plum. Tart pastry
                        danish soufflé donut bear claw chocolate cake marshmallow chupa chups. Jelly danish gummi bears
                        cake donut powder chocolate cake. Bonbon soufflé lollipop biscuit dragée jelly-o. Wafer pastry
                        pudding tiramisu chocolate bar croissant cake. Pie caramels gummies danish.”</p>
                    <img src="home/images/quotes.svg" alt="quotes svg">
                    <h4>David Dixon</h4>
                    <p>Reader</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Quotes end -->

    <!-- Social -->
    <section class="fh5co-social">
        <div class="site-container">
            <div class="social">
                <h5>Follow me!!</h5>
                <div class="social-icons">
                    <a href="#" target="_blank"><img src="home/images/social-twitter.png"
                            alt="social icon"></a>
                    <a href="#" target="_blank"><img src="home/images/social-pinterest.png"
                            alt="social icon"></a>
                    <a href="#" target="_blank"><img src="home/images/social-youtube.png"
                            alt="social icon"></a>
                    <a href="#" target="_blank"><img src="home/images/social-twitter.png"
                            alt="social icon"></a>
                </div>
                <h5>Share it!</h5>
            </div>
        </div>
    </section>
    <!-- Social -->

    <!-- Footer -->
    <footer class="site-footer">
        <div class="site-container">
            <div class="footer-inner">
                <div class="footer-info">
                    <div class="footer-info__left">
                        <img src="home/images/footer-img.jpg" alt="about me image">
                        <p>Read more about me</p>
                    </div>
                    <div class="footer-info__right">
                        <h5>Get In Touch</h5>
                        <p class="footer-phone">Phone: +958734902847</p>
                        <p>Email : Jhone@Example.com</p>
                        <div class="social-icons">
                            <a href="#" target="_blank"><img src="home/images/social-twitter.png"
                                    alt="social icon"></a>
                            <a href="#" target="_blank"><img src="home/images/social-pinterest.png"
                                    alt="social icon"></a>
                            <a href="#" target="_blank"><img src="home/images/social-youtube.png"
                                    alt="social icon"></a>
                            <a href="#" target="_blank"><img src="home/images/social-twitter.png"
                                    alt="social icon"></a>
                        </div>
                    </div>
                </div>
                <div class="footer-contact-form">
                    <h5>Contact Form</h5>
                    <form class="contact-form">
                        <div class="contact-form__input">
                            <input type="text" name="name" placeholder="Name">
                            <input type="email" name="email" placeholder="Email">
                        </div>
                        <textarea></textarea>
                        <input type="submit" name="submit" value="Submit" class="submit-button">
                    </form>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="site-container footer-bottom-inner">
                <p>© 2019 Author | Design by <a href="https://freehtml5.co/" target="_blank">freehtml5.co</a> | All
                    rights Reserved.</p>
                <div class="footer-bottom__img">
                    <img src="home/images/footer-mastercard.png" alt="footer image">
                    <img src="home/images/footer-paypal.png" alt="footer image">
                    <img src="home/images/footer-visa.png" alt="footer image">
                    <img src="home/images/footer-fedex.png" alt="footer image">
                    <img src="home/images/footer-dhl.png" alt="footer image">
                </div>
            </div>
        </div>
    </footer>

    @include('home.modal')
    <!-- Footer end -->


    <script src="../../dist/js/adminlte.min.js"></script>
    <!-- Scripts -->
    <script src="home/js/jquery.min.js"></script>
    <script src="home/js/slick.min.js"></script>
    <script src="home/js/main.js"></script>
    <!-- SweetAlert2 -->
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>


    {{-- notifikasi --}}
    @if ($message = Session::get('success'))
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "{{ $message }}",
                icon: "success"
            });
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            Swal.fire({
                title: "Errors!",
                text: "{{ $message }}",
                icon: "error"
            });
        </script>
    @endif
    <script>
        $('.notlogin').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                title: 'Kamu belum login!',
                text: `Silahkan login terlebih dahulu untuk mengakses fitur`,
                icon: 'warning',
                confirmButtonText: 'OK',
                focusConfirm: false
            })
        });
    </script>


    {{-- typing text --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const textDataElement = document.getElementById("text-data");
            const texts = JSON.parse(textDataElement.getAttribute("data-texts"));

            let currentTextIndex = 0;
            let charIndex = 0;
            const typingSpeed = 150;
            const erasingSpeed = 100;
            const newTextDelay = 2000; // Delay between current and next text

            const typingTextSpan = document.getElementById("typing-text");

            function type() {
                if (charIndex < texts[currentTextIndex].length) {
                    typingTextSpan.textContent += texts[currentTextIndex].charAt(charIndex);
                    charIndex++;
                    setTimeout(type, typingSpeed);
                } else {
                    setTimeout(erase, newTextDelay);
                }
            }

            function erase() {
                if (charIndex > 0) {
                    typingTextSpan.textContent = texts[currentTextIndex].substring(0, charIndex - 1);
                    charIndex--;
                    setTimeout(erase, erasingSpeed);
                } else {
                    currentTextIndex = (currentTextIndex + 1) % texts.length;
                    setTimeout(type, typingSpeed + 1100);
                }
            }

            setTimeout(type, newTextDelay);
        });
    </script>
</body>

</html>
