require_once __DIR__ . '/../includes/init_lang.php';
require_once __DIR__ . '/../includes/db.php';
?>
<?php include 'includes/header.php'; ?>

<div class="contact-page-wrapper" style="padding: 60px 0; background: #fff;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 text-center mb-5">
                <h1 class="page-title" style="font-weight: 700; color: #333;"><?php echo $lang['contact_us']; ?></h1>
                <p class="text-muted"><?php echo $lang['contact_intro']; ?></p>
                
                <?php if (isset($_SESSION['success_message'])): ?>
                    <div class="alert alert-success mt-3">
                        <?php 
                        echo $_SESSION['success_message']; 
                        unset($_SESSION['success_message']);
                        ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error_message'])): ?>
                    <div class="alert alert-danger mt-3">
                        <?php 
                        echo $_SESSION['error_message']; 
                        unset($_SESSION['error_message']);
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6 mb-4">
                <div class="contact-form-box"
                    style="padding: 30px; border: 1px solid #eee; border-radius: 12px; background: #fdfdfd;">
                    <form action="contact_process.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label"><?php echo $lang['name']; ?></label>
                            <input type="text" name="name" class="form-control" required placeholder="<?php echo $lang['your_name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo $lang['email']; ?></label>
                            <input type="email" name="email" class="form-control" required placeholder="your@email.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo $lang['subject']; ?></label>
                            <input type="text" name="subject" class="form-control" required placeholder="<?php echo $lang['inquiry']; ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label"><?php echo $lang['message']; ?></label>
                            <textarea name="message" class="form-control" rows="5" required
                                placeholder="<?php echo $lang['how_can_we_help']; ?>"></textarea>
                        </div>
                        <button type="submit" class="btn btn--primary"><?php echo $lang['send_message']; ?></button>
                    </form>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="contact-info-box" style="padding: 30px;">
                    <h3 class="mb-4"><?php echo $lang['get_in_touch']; ?></h3>

                    <div class="info-item mb-4 d-flex align-items-start">
                        <div class="icon me-3" style="color: #6ea622; font-size: 24px;">📍</div>
                        <div>
                            <h5 style="margin-bottom: 5px;"><?php echo $lang['address']; ?></h5>
                            <p style="color: #666;">SOS. MIHAI BRAVU NR. 6, SECTOR 2, BUCURESTi</p>
                        </div>
                    </div>

                    <div class="info-item mb-4 d-flex align-items-start">
                        <div class="icon me-3" style="color: #6ea622; font-size: 24px;">📞</div>
                        <div>
                            <h5 style="margin-bottom: 5px;"><?php echo $lang['phone']; ?></h5>
                            <p style="color: #666;">+40 536 503 097</p>
                        </div>
                    </div>

                    <div class="info-item mb-4 d-flex align-items-start">
                        <div class="icon me-3" style="color: #6ea622; font-size: 24px;">✉️</div>
                        <div>
                            <h5 style="margin-bottom: 5px;"><?php echo $lang['email']; ?></h5>
                            <p style="color: #666;">shop@maharajasupermarket.ro</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>