<?php ?>

<section class="py-5 bg-light border-bottom">
    <div class="container px-5color-ck-dark">
        <div class="rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-gradient text-white rounded-3 mb-3">
                       
                        <h1 class="fw-bolder color-ck-dark mx-2">Get in touch</h1>
                    
                </div>
                
                <p class="lead fw-normal text-muted mb-0">We'd love to hear from you</p>
            </div>
            <div class="row gx-5 justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <form id="contactForm" action="https://formspree.io/f/xknkyyjj" method="POST">
                        <div class="form-floating mb-3">
                            <input class="form-control" id="name" type="text" name="name" placeholder="Enter your name..." required />
                            <label for="name">Full name</label>
                            <div class="invalid-feedback">A name is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="email" type="email" name="email" placeholder="name@example.com" required />
                            <label for="email">Email address</label>
                            <div class="invalid-feedback">An email is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <input class="form-control" id="phone" type="tel" name="phone" placeholder="(123) 456-7890" required />
                            <label for="phone">Phone number</label>
                            <div class="invalid-feedback">A phone number is required.</div>
                        </div>
                        <div class="form-floating mb-3">
                            <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 10rem" required></textarea>
                            <label for="message">Message</label>
                            <div class="invalid-feedback">A message is required.</div>
                        </div>
                        <div class="d-grid">
                            <button class="btn bg-ck color-ck btn-lg" id="submitButton" type="submit">Send Message</button>
                        </div>
                    </form>

                    <div id="formResponse" class="mt-3"></div>
                </div>
            </div>
            
        </div>
    </div>
</section>