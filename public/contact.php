<?php
session_start();
// Config
$config_path_local = __DIR__ . '/config/database.php';
if (file_exists($config_path_local)) {
    require_once $config_path_local;
} else {
    require_once __DIR__ . '/../config/database.php';
}
?>
<?php include 'includes/header.php'; ?>

<div class="contact-page-wrapper" style="padding: 60px 0; background: #fff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center mb-5">
                <h1 class="page-title" style="font-weight: 700; color: #333;">Contact Us</h1>
                <p class="text-muted">We'd love to hear from you. Please fill out the form below or reach us via email
                    or phone.</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <div class="contact-form-box"
                    style="padding: 30px; border: 1px solid #eee; border-radius: 12px; background: #fdfdfd;">
                    <form action="contact_process.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" required placeholder="Your Name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required placeholder="your@email.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control" required placeholder="Inquiry">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" class="form-control" rows="5" required
                                placeholder="How can we help?"></textarea>
                        </div>
                        <button type="submit" class="btn btn--primary">Send Message</button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="contact-info-box" style="padding: 30px;">
                    <h3 class="mb-4">Get in Touch</h3>

                    <div class="info-item mb-4 d-flex align-items-start">
                        <div class="icon me-3" style="color: #6ea622; font-size: 24px;">📍</div>
                        <div>
                            <h5 style="margin-bottom: 5px;">Address</h5>
                            <p style="color: #666;">SOS. MIHAI BRAVU NR. 6, SECTOR 2, BUCURESTi</p>
                        </div>
                    </div>

                    <div class="info-item mb-4 d-flex align-items-start">
                        <div class="icon me-3" style="color: #6ea622; font-size: 24px;">📞</div>
                        <div>
                            <h5 style="margin-bottom: 5px;">Phone</h5>
                            <p style="color: #666;">+40 536 503 097</p>
                        </div>
                    </div>

                    <div class="info-item mb-4 d-flex align-items-start">
                        <div class="icon me-3" style="color: #6ea622; font-size: 24px;">✉️</div>
                        <div>
                            <h5 style="margin-bottom: 5px;">Email</h5>
                            <p style="color: #666;">shop@maharajasupermarket.ro</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>