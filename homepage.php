<?php

/* Template Name: Homepage */

// Retrieve Page data
$data = ct_get_page_data();

get_header("test");
?>
<!-- Breadcrumbs -->
<div class="section-3">
    <div class="inner-section">
        <div class="breadcrumbs">
            Home / Who we are / <span class="current">Contact</span>
        </div>
    </div>
</div>

<!-- Page content -->
<div class="section-4">
    <div class="inner-section">
        <h1>Contact Us</h1>
        <p><?php echo $data["content"] ?></p>
    </div>
</div>

<!-- Contact Section -->
<div class="section-5">
    <div class="inner-section">
        <div class="col-left">
            <h1>Contact Us</h1>
            <hr />
            <?php echo do_shortcode('[contact-form-7 id="16a48b7" title="Home Contact"]') ?>
        </div>
        <div class="col-right">
            <h1>Reach Us</h1>
            <hr />
            <span class="t1"><?php echo $data['address'] ?></span>
            
            <p class="t3"
              >Phone: <?php echo $data["phone"] ?>
              <br />Fax: <?php echo $data["fax"] ?></p
            >
            <div class="social-icons">
                <a href="<?php echo $data["fb-url"] ?>">
                    <div class="social">
                        <img
                        src="<?php echo home_url() ?>/wp-content/uploads/2023/09/facebook-new-150x150-1.png"
                        alt="Facebook White Logo"
                        />
                    </div>
              </a>
              <a href="<?php echo $data["tw-url"] ?>">
                <div class="social">
                    <img
                    src="<?php echo home_url() ?>/wp-content/uploads/2023/09/twitter.png"
                    alt="Twitter White Logo"
                    />
                </div>
                </a>
            <a href="<?php echo $data["ln-url"] ?>">
                <div class="social">
                    <img
                    src="<?php echo home_url() ?>/wp-content/uploads/2023/09/linkedin.png"
                    alt="Linkedin White Logo"
                    />
                </div>
            </a>
            <a href="<?php echo $data["pin-url"] ?>">
              <div class="social">
                <img
                  src="<?php echo home_url() ?>/wp-content/uploads/2023/09/pinterest.png"
                  alt="Pinterest White Logo"
                />
              </div>
            </a>
            </div>
        </div>
    </div>
</div>
<?
get_footer();