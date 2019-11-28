<template>
    <!--        Contact Section      -->
    <section id="contact">
        <div class="container wow fadeInUp">
            <div class="section-header">
                <h3 class="section-title text-center" style="">Liên hệ chúng tôi</h3>
                <p class="section-description text-center">
                    Liên hệ với chúng tôi để phản hồi
                </p>
            </div>
        </div>
        <div id="map" style="margin-bottom: 50px;">
            <iframe
                class="w-100"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4543.2644211669385!2d105.80189020554523!3d21.039556852063093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135abfcdfc20d07%3A0x356906d987336d53!2zVHLGsOG7nW5nIFRp4buDdSBo4buNYyB2w6AgVEhDUyBGUFQ!5e1!3m2!1svi!2s!4v1574948000586!5m2!1svi!2s"
                width="1170"
                height="300"
                frameborder="0"
                style="border:0;"
                allowfullscreen=""
            ></iframe>
        </div>
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-lg-3 col-md-4">
                    <div class="info">
                        <div>
                            <i class="fa fa-map-marker"></i>
                            <p>
                                Tiểu học FPT Nghĩa Đô, Quan Hoa<br />Cầu Giấy,
                                Hà Nội
                            </p>
                        </div>
                        <div>
                            <i class="fa fa-envelope"></i>
                            <p>info@gofficervn.com</p>
                        </div>
                        <div>
                            <i class="fa fa-phone"></i>
                            <p>+1 113 115 119</p>
                        </div>
                    </div>
                    <div class="social-links">
                        <a
                            href="https://twitter.com"
                            target="_blank"
                            class="twitter"
                            ><i class="fab fa-twitter-square"></i
                        ></a>
                        <a
                            href="https://www.facebook.com"
                            target="_blank"
                            class="facebook"
                            ><i class="fab fa-facebook-square"></i
                        ></a>
                        <a
                            href="https://www.instagram.com"
                            target="_blank"
                            class="instagram"
                            ><i class="fab fa-instagram"></i
                        ></a>
                        <a
                            href="https://plus.google.com"
                            target="_blank"
                            class="google-plus"
                            ><i class="fab fa-google-plus-g"></i
                        ></a>
                        <a
                            href="https://www.linkedin.com"
                            target="_blank"
                            class="linkedin"
                            ><i class="fab fa-linkedin"></i
                        ></a>
                    </div>
                </div>

                <div class="col-lg-5 col-md-8">
                    <div class="form">
                        <form
                            action=""
                            method="post"
                            role="form"
                            class="contactForm"
                        >
                            <div class="form-group">
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control"
                                    id="name"
                                    placeholder="Your Name"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    type="email"
                                    class="form-control"
                                    name="email"
                                    id="email"
                                    placeholder="Your Email"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <input
                                    type="text"
                                    class="form-control"
                                    name="subject"
                                    id="subject"
                                    placeholder="Subject"
                                    required
                                />
                            </div>
                            <div class="form-group">
                                <textarea
                                    class="form-control"
                                    name="message"
                                    rows="5"
                                    placeholder="Message"
                                    required
                                ></textarea>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-success" type="submit">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- #contact -->
</template>
