@extends("layout")

    @section("title")
        About
    @endsection

    @section("content")

        <!-- About 1 - Bootstrap Brain Component -->
<section class="py-3 py-md-5">
    <div class="container">
      <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
        <div class="col-12 col-lg-6 col-xl-5">
          <img class="img-fluid rounded" loading="lazy" src="/img/weather-about-us.PNG" alt="About 1">
        </div>
        <div class="col-12 col-lg-6 col-xl-7">
          <div class="row justify-content-xl-center">
            <div class="col-12 col-xl-11">
            <h3>About Us</h3>
            <hr>
            <h4>Who Are We?</h4>
              <p class="lead fs-4 text-secondary mb-3">We are a weather forecasting website dedicated to providing accurate and reliable weather information to our users.</p>
              <p class="mb-5">Our team is passionate about meteorology and technology, and we combine our expertise in both fields to deliver forecasts that you can trust. We understand the importance of weather information in your daily life, whether it's planning outdoor activities or making informed decisions about travel and safety</p>
              <div class="row gy-4 gy-md-0 gx-xxl-5X">
                <div class="col-12 col-md-6">
                  <div class="d-flex">
                    <div class="me-4 text-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
                      </svg>
                    </div>
                    <div>
                      <h2 class="h4 mb-3">Versatile Brand</h2>
                      <p class="text-secondary mb-0">We are committed to providing you with a seamless weather experience across all platforms and devices.</p>
                    </div>
                  </div>
                </div>
                <div class="col-12 col-md-6">
                  <div class="d-flex">
                    <div class="me-4 text-primary">
                      <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-fire" viewBox="0 0 16 16">
                        <path d="M8 16c3.314 0 6-2 6-5.5 0-1.5-.5-4-2.5-6 .25 1.5-1.25 2-1.25 2C11 4 9 .5 6 0c.357 2 .5 4-2 6-1.25 1-2 2.729-2 4.5C2 14 4.686 16 8 16Zm0-1c-1.657 0-3-1-3-2.75 0-.75.25-2 1.25-3C6.125 10 7 10.5 7 10.5c-.375-1.25.5-3.25 2-3.5-.179 1-.25 2 1 3 .625.5 1 1.364 1 2.25C11 14 9.657 15 8 15Z" />
                      </svg>
                    </div>
                    <div>
                      <h2 class="h4 mb-3">Digital Agency</h2>
                      <p class="text-secondary mb-0">We are constantly innovating and leveraging cutting-edge technologies to enhance your weather experience.</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

    @endsection
