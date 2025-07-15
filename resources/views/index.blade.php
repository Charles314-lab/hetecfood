@extends('layouts.master')

@section('content')

 @include('layouts.header')



  <main class="main">

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="hero section dark-background">
      <img src="assets/img/hero.webp" alt="" data-aos="fade-in">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 d-flex flex-column align-items-center align-items-lg-start">
            <h2 data-aos="fade-up" data-aos-delay="100">Welcome to <span>Montego's</span></h2>
            <p data-aos="fade-up" data-aos-delay="200">Your premier destination for an unforgettable dining experience.
            </p>
            <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
              <a href="#menu" class="cta-btn">Our Menu</a>
              <a href="#book-a-table" class="cta-btn">Book a Table</a>
            </div>
          </div>
          <div class="col-lg-4 d-flex align-items-center justify-content-center mt-5 mt-lg-0">
            <a href="https://www.youtube.com/watch?v=Y7f98aduVJ8" class="glightbox pulsating-play-btn"></a>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= About Section ======= -->
    <section id="about" class="about section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-6 order-1 order-lg-2">
            <img src="assets/img/about.webp" class="img-fluid about-img" alt="">
          </div>
          <div class="col-lg-6 order-2 order-lg-1 content">
            <h3><?php echo "Our Culinary Philosophy" ?></h3>
            <p class="fst-italic">Description of our values and culinary philosophy.</p>
            <ul>
              <li><i class="bi bi-check2-all"></i> <span>Fresh and high-quality ingredients</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Recipes combining tradition and creativity</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Warm welcome and elegant setting</span></li>
            </ul>
            <p>Golden Spoon is where every dish tells a story.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us section">
      <div class="container section-title" data-aos="fade-up">
        <h2>WHY US</h2>
        <p>Why Choose Our Restaurant</p>
      </div>
      <div class="container">
        <div class="row gy-4">
          <!-- Three reasons to choose the restaurant -->
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="card-item">
              <span>01</span>
              <h4><a href="" class="stretched-link">A Refined Culinary Experience</a></h4>
              <p>High-quality dishes designed to awaken your senses.</p>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card-item">
              <span>02</span>
              <h4><a href="" class="stretched-link">Elegant & Warm Atmosphere</a></h4>
              <p>An elegant and cozy setting for a relaxing meal.</p>
            </div>
          </div>
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="card-item">
              <span>03</span>
              <h4><a href="" class="stretched-link">Passionate and Dedicated Team</a></h4>
              <p>A devoted team passionate about service and hospitality.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- ======= Menu Section ======= -->
    <section id="menu" class="menu section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Menu</h2>
        <p>Check Our Tasty Menu</p>
      </div>

      <div class="container isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <!-- Dynamic filters based on categories -->
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul class="menu-filters isotope-filters">
              <li data-filter="*" class="filter-active">ALL</li>
              @foreach ($categories as $categorie )
                <li data-filter=".filter-{{$categorie->id}}">
                  {{$categorie->nom}}
                </li>
              @endforeach
            </ul>
          </div>
        </div>

       <!-- Dynamic dish display with categories -->
<div class="row isotope-container" data-aos="fade-up" data-aos-delay="200">
  @foreach ($plats as $plat)
    <div class="col-lg-6 menu-item isotope-item filter-{{ $plat->categorie_id }}">

     <!-- Image du plat -->
<a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $plat->id }}">
  <img
    src="{{ file_exists(public_path('assets/img/plats/' . $plat->image_url)) &&
    !empty($plat->image_url) ? asset('assets/img/plats/' . $plat->image_url) : asset('assets/img/plats/logo.jpg') }}"
    class="menu-img"
    alt="{{ $plat->nom }}">
</a>



    <!-- START Modal -->
<div class="modal fade" id="exampleModal{{ $plat->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">Commander : {{ $plat->nom }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- Colonne gauche : image + infos -->
          <div class="col-md-5">
            <div class="text-center mb-3">
              <img src="{{ asset('assets/img/plats/' . $plat->image_url) }}"
                   class="img-fluid rounded"
                   style="max-height: 300px; width: auto;"
                   alt="{{ $plat->nom }}">
            </div>

            <div class="plat-infos bg-light p-3 rounded">
              <p class="mb-1"><strong>Prix :</strong> {{ $plat->prix }} FCFA</p>
              <p class="mb-1"><strong>Origine :</strong> {{ $plat->origine ?? 'N/A' }}</p>
              <p class="mb-1"><strong>Préparation :</strong> {{ $plat->tps_cuisson ?? 'N/A' }}</p>
              <p class="mb-0"><strong>Ingrédients :</strong></p>
              <p class="small">
                {{ isset($ingredientsParPlat[$plat->id]) ? implode(', ', $ingredientsParPlat[$plat->id]) : 'Non spécifiés' }}
              </p>
            </div>
          </div>

          <!-- Colonne droite : formulaire -->
          <div class="col-md-7">
            <h5 class="mb-4">Informations de livraison</h5>
            <form class="commande-form" method="post" action="{{ route('commande.submit') }}">
              @csrf
              <input type="hidden" name="plat_id" value="{{ $plat->id }}">

              <div class="row g-3">
                <div class="col-md-6">
                  <label class="form-label">Nom</label>
                  <input type="text" name="nom" class="form-control" placeholder="Votre nom" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Prénom</label>
                  <input type="text" name="prenom" class="form-control" placeholder="Votre prénom" required>
                </div>
                <div class="col-12">
                  <label class="form-label">Adresse</label>
                  <input name="adr" class="form-control" placeholder="Votre adresse" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Téléphone</label>
                  <input type="text" name="tel" class="form-control" placeholder="XX-XX-XX-XX" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Quantité</label>
                  <input type="number" name="quantite" min="1" class="form-control" required>
                </div>
                <div class="col-12 mt-4">
                  <button type="submit" class="btn btn-primary w-100 py-2">
                    <i class="bi bi-check-circle me-2"></i>Valider la commande
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END Modal -->



      <!-- Contenu -->
      <div class="menu-content">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $plat->id }}">
            {{ $plat->nom }}
        </a>
        <span>{{ $plat->prix }} FCFA</span>
      </div>

      <!-- Ingrédients dynamiques -->
      <div class="menu-ingredients">
        @php
          $idPlat = $plat->id;
          $listeIngrédients = $ingredientsParPlat[$idPlat] ?? [];
        @endphp

        <span class="text-white">
          {{ count($listeIngrédients) > 0 ? implode(', ', $listeIngrédients) : 'Ingrédient non connu' }}
        </span><br>

        <span class="text-white">
          Origine : {{ $plat->origine ?? 'N/A' }} | Temps de cuisson : {{ $plat->tps_cuisson ?? 'N/A' }}
        </span>
      </div>
    </div>
  @endforeach
</div>
</div>
</section><!-- /Menu Section -->
<!-- Validation du Modal -->
@if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
@endif
<!-- End Validation du Modal -->


    <!-- Specials Section -->
    <section id="specials" class="specials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Specials</h2>
        <p>Check Our Specials</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row">
          <div class="col-lg-3">
            <ul class="nav nav-tabs flex-column">
              <li class="nav-item">
                <a class="nav-link active show" data-bs-toggle="tab" href="#specials-tab-1">Rice Salad with Fresh Vegetables</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-2">Tropical Fruit Salad</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-3">Spaghetti with Meat and Leafy Sauce</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-4">Cheese with Red Fruits and Greens</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#specials-tab-5">Fruit Medley on Leafy Greens</a>
              </li>
            </ul>
          </div>
          <div class="col-lg-9 mt-4 mt-lg-0">
            <div class="tab-content">
              <div class="tab-pane active show" id="specials-tab-1">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Rice Salad with Fresh Vegetables</h3>
                    <p class="fst-italic">A fresh and satisfying option for light eaters.</p>
                    <p>A refreshing and vibrant dish featuring perfectly cooked rice, crisp cucumber, ripe tomatoes, and a medley of fresh salad greens, all tossed together in a light, tangy dressing. This dish is a delightful combination of flavors and textures, perfect as a light meal or a side.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-1.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="specials-tab-2">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Tropical Fruit Salad</h3>
                    <p class="fst-italic">A colorful and juicy burst of tropical freshness.</p>
                    <p>A refreshing and exotic fruit mix including juicy orange slices, sweet pineapple chunks, crunchy peanuts, and fresh cherries, all beautifully complemented by a unique leafy herb garnish. This tropical medley offers a burst of fresh flavors and is perfect for those who enjoy light, fruity bites.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-2.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="specials-tab-3">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Spaghetti with Meat and Leafy Sauce</h3>
                    <p class="fst-italic">Hearty, flavorful, and comforting.</p>
                    <p>Delicious spaghetti served with a tender piece of meat, all covered in a rich and flavorful sauce. The dish is topped with fresh green leaves, adding a hint of earthiness and freshness to balance the savory sauce, making it a hearty and satisfying option for pasta lovers.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-3.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="specials-tab-4">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Cheese with Red Fruits and Greens</h3>
                    <p class="fst-italic">A delicate fusion of creamy and sweet.</p>
                    <p>A delicate plate of creamy cheese paired with small, sweet red berries and complemented by fresh green leaves. The combination of textures and flavors—rich, creamy cheese with the tangy sweetness of the fruit—makes for a beautifully balanced appetizer or light dish.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-4.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>

              <div class="tab-pane" id="specials-tab-5">
                <div class="row">
                  <div class="col-lg-8 details order-2 order-lg-1">
                    <h3>Fruit Medley on Leafy Greens</h3>
                    <p class="fst-italic">A sweet and refreshing tropical delight.</p>
                    <p>A vibrant and colorful combination of fresh cherries, ripe banana slices, and either papaya or mango, served on a bed of crisp leafy greens. The natural sweetness of the fruit combined with the fresh greens offers a refreshing, healthy treat, ideal for a light dessert or a rejuvenating snack.</p>
                  </div>
                  <div class="col-lg-4 text-center order-1 order-lg-2">
                    <img src="assets/img/specials-5.png" alt="" class="img-fluid">
                  </div>
                </div>
              </div>
            </div>
          </div>


    </section><!-- /Specials Section -->

    <!-- Events Section -->
    <section id="events" class="events section">

      <img class="slider-bg" src="assets/img/events-bg.jpg" alt="" data-aos="fade-in">

      <div class="container">

        <div class="swiper init-swiper" data-aos="fade-up" data-aos-delay="100">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>

          <div class="swiper-wrapper">

            <!-- Birthday Parties -->
            <div class="swiper-slide">
              <div class="row gy-4 event-item">
                <div class="col-lg-6">
                  <img src="assets/img/events-slider/events-slider-1.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Birthday Parties</h3>
                  <div class="price">
                    <p><span>$189</span></p>
                  </div>
                  <p class="fst-italic">
                    Celebrate unforgettable birthdays with fun-filled packages tailored for all ages.
                  </p>
                  <ul>
                    <li><i class="bi bi-check2-circle"></i> <span>Custom cake and decoration options.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Entertainment for kids and adults.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Flexible indoor and outdoor setups.</span></li>
                  </ul>
                  <p>
                    Make memories that last a lifetime with our all-inclusive birthday party services.
                  </p>
                </div>
              </div>
            </div><!-- End Slider item -->

            <!-- Private Parties -->
            <div class="swiper-slide">
              <div class="row gy-4 event-item">
                <div class="col-lg-6">
                  <img src="assets/img/events-slider/events-slider-2.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Private Parties</h3>
                  <div class="price">
                    <p><span>$290</span></p>
                  </div>
                  <p class="fst-italic">
                    Host your private gathering in style and total privacy.
                  </p>
                  <ul>
                    <li><i class="bi bi-check2-circle"></i> <span>Exclusive venue access for your guests.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Bar and catering packages available.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Personal event coordinator included.</span></li>
                  </ul>
                  <p>
                    Whether it's a family reunion or a celebration among friends, enjoy a space that’s yours for the night.
                  </p>
                </div>
              </div>
            </div><!-- End Slider item -->

            <!-- Custom Parties -->
            <div class="swiper-slide">
              <div class="row gy-4 event-item">
                <div class="col-lg-6">
                  <img src="assets/img/events-slider/events-slider-3.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Custom Parties</h3>
                  <div class="price">
                    <p><span>$99</span></p>
                  </div>
                  <p class="fst-italic">
                    Your party, your rules — fully customizable from A to Z.
                  </p>
                  <ul>
                    <li><i class="bi bi-check2-circle"></i> <span>Themes, lights, music — all up to you.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Work with our creative planners.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Budget-friendly options available.</span></li>
                  </ul>
                  <p>
                    We provide the canvas — you paint the perfect event.
                  </p>
                </div>
              </div>
            </div><!-- End Slider item -->

            <!-- Corporate Meetings -->
            <div class="swiper-slide">
              <div class="row gy-4 event-item">
                <div class="col-lg-6">
                  <img src="assets/img/events-slider/events-slider-4.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Corporate Meetings</h3>
                  <div class="price">
                    <p><span>$350</span></p>
                  </div>
                  <p class="fst-italic">
                    Professional atmosphere and services tailored for corporate gatherings and business meetings.
                  </p>
                  <ul>
                    <li><i class="bi bi-check2-circle"></i> <span>Fully equipped with projectors and fast Wi-Fi.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Catering services available on demand.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Flexible time slots and space arrangements.</span></li>
                  </ul>
                  <p>
                    Enhance your business experience with our fully customizable corporate meeting solutions.
                  </p>
                </div>
              </div>
            </div><!-- End Slider item -->

            <!-- Engagement Ceremonies -->
            <div class="swiper-slide">
              <div class="row gy-4 event-item">
                <div class="col-lg-6">
                  <img src="assets/img/events-slider/events-slider-5.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Engagement Ceremonies</h3>
                  <div class="price">
                    <p><span>$450</span></p>
                  </div>
                  <p class="fst-italic">
                    Celebrate love and commitment in a romantic and elegant setting.
                  </p>
                  <ul>
                    <li><i class="bi bi-check2-circle"></i> <span>Beautiful decorations tailored to your theme.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Live music and DJ options available.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Customized menus and dessert tables.</span></li>
                  </ul>
                  <p>
                    Make your engagement day truly memorable with our dedicated staff and personalized celebration packages.
                  </p>
                </div>
              </div>
            </div><!-- End Slider item -->

            <!-- Workshops & Seminars -->
            <div class="swiper-slide">
              <div class="row gy-4 event-item">
                <div class="col-lg-6">
                  <img src="assets/img/events-slider/events-slider-6.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 content">
                  <h3>Workshops & Seminars</h3>
                  <div class="price">
                    <p><span>$220</span></p>
                  </div>
                  <p class="fst-italic">
                    A space designed to inspire learning, sharing and collaboration.
                  </p>
                  <ul>
                    <li><i class="bi bi-check2-circle"></i> <span>Interactive setup with seating arrangements.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Includes sound system and microphones.</span></li>
                    <li><i class="bi bi-check2-circle"></i> <span>Refreshment options available during breaks.</span></li>
                  </ul>
                  <p>
                    Ideal for educators, trainers, and coaches looking to host impactful sessions in a fully equipped environment.
                  </p>
                </div>
              </div>
            </div><!-- End Slider item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Events Section -->


    <!-- Book A Table Section -->
    <section id="book-a-table" class="book-a-table section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>RESERVATION</h2>
        <p>Book a Table</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="forms/book-a-table.php" method="post" role="form" class="php-email-form">
          <div class="row gy-4">
            <div class="col-lg-4 col-md-6">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="date" name="date" class="form-control" id="date" placeholder="Date" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="time" class="form-control" name="time" id="time" placeholder="Time" required="">
            </div>
            <div class="col-lg-4 col-md-6">
              <input type="number" class="form-control" name="people" id="people" placeholder="# of people" required="">
            </div>
          </div>

          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
          </div>

          <div class="text-center mt-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your booking request was sent. We will call back or send an Email to confirm your reservation. Thank you!</div>
            <button type="submit">Book a Table</button>
          </div>
        </form><!-- End Reservation Form -->

      </div>

    </section><!-- /Book A Table Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Testimonials</h2>
        <p>What they're saying about us</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper" data-speed="600" data-delay="5000" data-breakpoints="{ &quot;320&quot;: { &quot;slidesPerView&quot;: 1, &quot;spaceBetween&quot;: 40 }, &quot;1200&quot;: { &quot;slidesPerView&quot;: 3, &quot;spaceBetween&quot;: 40 } }">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 20
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item" >
            <p>
              <i class=" bi bi-quote quote-icon-left"></i>
                <span>Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus. Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at semper.</span>
                <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                <h3>Saul Goodman</h3>
                <h4>Ceo &amp; Founder</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                <h3>Sara Wilsson</h3>
                <h4>Designer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam duis minim tempor labore quem eram duis noster aute amet eram fore quis sint minim.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                <h3>Jena Karlis</h3>
                <h4>Store Owner</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore illum veniam.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img" alt="">
                <h3>Matt Brandon</h3>
                <h4>Freelancer</h4>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <p>
                  <i class="bi bi-quote quote-icon-left"></i>
                  <span>Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster veniam sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore nisi cillum quid.</span>
                  <i class="bi bi-quote quote-icon-right"></i>
                </p>
                <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img" alt="">
                <h3>John Larson</h3>
                <h4>Entrepreneur</h4>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Gallery Section -->
    <section id="gallery" class="gallery section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Gallery</h2>
        <p>Some photos from Our Restaurant</p>
      </div><!-- End Section Title -->

      <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-0">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallerie-2.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/gallerie-2.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/Plat_6.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/Plat_6.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallerie-3.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/gallerie-3.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallerie-13.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/gallerie-13.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/Plat_4.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/Plat_4.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallerie-15.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/gallerie-15.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallerie-11.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/gallerie-11.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallerie-9.jpeg" class="glightbox" data-gallery="images-gallery">
                <img src="assets/img/gallery/gallerie-9.jpeg" alt="" class="img-fluid">
              </a>
            </div>
          </div><!-- End Gallery Item -->

        </div>

      </div>

    </section><!-- /Gallery Section -->

    <!-- Chefs Section -->
    <section id="chefs" class="chefs section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>Necessitatibus eius consequatur</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <img src="assets/img/chefs/chefs-1.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Walter White</h4>
                  <span>Master Chef</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="member">
              <img src="assets/img/chefs/chefs-2.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>Sarah Jhonson</h4>
                  <span>Patissier</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="member">
              <img src="assets/img/chefs/chefs-3.jpg" class="img-fluid" alt="">
              <div class="member-info">
                <div class="member-info-content">
                  <h4>William Anderson</h4>
                  <span>Cook</span>
                </div>
                <div class="social">
                  <a href=""><i class="bi bi-twitter-x"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->

        </div>

      </div>

    </section><!-- /Chefs Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div><!-- End Section Title -->

      <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 400px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Location</h3>
                <p>A108 Adam Street, New York, NY 535022</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Open Hours</h3>
                <p>Monday-Friday:<br>09:00 AM - 23:00 PM</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+22374130084</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>mbandicharles38@gmail.com</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form action="index.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">

                  <button type="submit">Send Message</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>


  @include('layouts.footer')


  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

   <!-- confirmation Modals -->
  <div class="modal fade" id="confirmationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0">
        <div class="modal-body text-center p-5">
          <div class="confirmation-circle mx-auto mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="#28a745" viewBox="0 0 16 16">
              <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg>
          </div>
          <h4 class="text-success mb-3">Envoyé avec succès</h4>
          <p class="mb-0">Merci. Nous vous contacterons sous peu.</p>
        </div>
      </div>
    </div>
  </div>

@endsection
