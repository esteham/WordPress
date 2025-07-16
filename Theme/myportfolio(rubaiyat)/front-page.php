<?php get_header(); ?>

<div class="modern-container">
    <!-- Hero Section with full-width image background -->
    <section class="modern-hero">
        <!-- Full-width hero image -->
        <div class="hero-image-wrapper">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/hero-image.jpg" alt="Workspace" class="hero-image">
            <div class="hero-overlay"></div>
        </div>
        
        <!-- Hero content centered over the image -->
        <div class="hero-content">
            <h1 class="hero-title">Hi, It's Sheehab! <span class="text-highlight">I'm a Web Developer</span></h1>
            <p class="hero-subtitle">I craft elegant solutions and intuitive digital experiences</p>
            <div class="hero-cta">
                <a href="#portfolio" class="btn btn-primary btn-lg">View My Work</a>
                <a href="#contact" class="btn btn-outline btn-lg">Contact Me</a>
            </div>
        </div>
    </section>

    <!-- About Section with potential profile image -->
    <section id="about" class="modern-section">
        <div class="about-grid">
            <div class="about-content">
                <h2 class="section-title">About Me</h2>
                <p class="lead-text">I'm a passionate developer with expertise in modern web technologies including WordPress, React, and advanced CSS techniques.</p>
                <p>With over 5 years of experience, I specialize in creating performant, accessible websites that deliver results.</p>
                <div class="skills-container">
                    <span class="skill-tag">WordPress</span>
                    <span class="skill-tag">PHP</span>
                    <span class="skill-tag">JavaScript</span>
                    <span class="skill-tag">CSS3</span>
                    <span class="skill-tag">React</span>
                    <span class="skill-tag">Accessibility</span>
                </div>
                <a href="#" class="btn btn-secondary">Download Resume</a>
            </div>
            <!-- Placeholder for profile image -->
            <div class="about-image">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/profile.jpg" alt="Profile Picture" class="profile-img">
                <div class="image-placeholder"></div>
            </div>
        </div>
    </section>

    <!-- Portfolio Section -->
    <section id="portfolio" class="modern-section bg-light">
        <div class="section-header">
            <h2 class="section-title">Featured Work</h2>
            <p class="section-subtitle">A selection of my recent projects</p>
        </div>
        <div class="portfolio-grid">
            <?php
            $args = array(
                'category_name' => 'portfolio', 
                'posts_per_page' => 6,
                'meta_key' => '_thumbnail_id' // Only show posts with featured images
            );
            $portfolio = new WP_Query($args);
            
            if ($portfolio->have_posts()):
                while ($portfolio->have_posts()): $portfolio->the_post(); ?>
                    <article class="portfolio-card">
                        <a href="<?php the_permalink(); ?>" class="card-link">
                            <?php if (has_post_thumbnail()): ?>
                                <div class="card-image">
                                    <?php the_post_thumbnail('large', [
                                        'class' => 'portfolio-thumbnail',
                                        'loading' => 'lazy'
                                    ]); ?>
                                    <div class="card-overlay">
                                        <span class="view-btn">View Project</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="card-content">
                                <h3 class="card-title"><?php the_title(); ?></h3>
                                <div class="card-excerpt"><?php the_excerpt(); ?></div>
                                <div class="card-meta">
                                    <?php 
                                    $categories = get_the_category();
                                    if (!empty($categories)) {
                                        echo '<span class="project-category">' . esc_html($categories[0]->name) . '</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </a>
                    </article>
                <?php endwhile;
                wp_reset_postdata();
            else: ?>
                <div class="no-projects">
                    <p>No projects found. Please add some portfolio items in the WordPress admin.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Testimonials Section - Optional -->
    <section class="modern-section bg-dark text-light">
        <div class="section-header">
            <h2 class="section-title">Client Testimonials</h2>
            <p class="section-subtitle">What people say about my work</p>
        </div>
        <div class="testimonials-grid">
            <!-- You could add client photos here -->
            <div class="testimonial-card">
                <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client1.jpg" alt="Client" class="client-photo"> -->
                <blockquote>
                    "Exceptional work! Delivered on time and exceeded our expectations."
                </blockquote>
                <cite>- Sarah Johnson, Marketing Director</cite>
            </div>
            <div class="testimonial-card">
                <!-- <img src="<?php echo get_template_directory_uri(); ?>/assets/images/client2.jpg" alt="Client" class="client-photo"> -->
                <blockquote>
                    "Transformed our outdated website into a modern conversion machine."
                </blockquote>
                <cite>- Michael Chen, Startup Founder</cite>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="modern-section">
        <div class="contact-grid">
            <div class="contact-content">
                <h2 class="section-title">Get In Touch</h2>
                <p class="lead-text">Have a project in mind or want to discuss potential opportunities?</p>
                <p>I'm currently available for freelance work and select full-time positions.</p>
                <div class="contact-info">
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span>hello@yourdomain.com</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <span>(123) 456-7890</span>
                    </div>
                </div>
            </div>
            <div class="contact-form">
                <?php echo do_shortcode('[contact-form-7 id="123" title="Contact form 1"]'); ?>
                <!-- Consider replacing with a custom form for better styling control -->
            </div>
        </div>
    </section>
</div>

<?php get_footer(); ?>

<style>
/* Updated Hero Section Styles */
.modern-hero {
    position: relative;
    min-height: 90vh;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    overflow: hidden;
}

.hero-image-wrapper {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
}

.hero-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
}

.hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(
        to right,
        rgba(0, 0, 0, 0.8) 0%,
        rgba(0, 0, 0, 0.5) 50%,
        rgba(0, 0, 0, 0.3) 100%
    );
    z-index: 2;
}

.hero-content {
    position: relative;
    z-index: 3;
    max-width: 1200px;
    width: 100%;
    padding: 0 20px;
    text-align: left;
}

.hero-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
    color: white;
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
}

.text-highlight {
    color: var(--accent);
    position: relative;
    display: inline-block;
}

.text-highlight::after {
    content: '';
    position: absolute;
    bottom: 5px;
    left: 0;
    width: 100%;
    height: 15px;
    background-color: rgba(76, 201, 240, 0.3);
    z-index: -1;
}

.hero-subtitle {
    font-size: clamp(1.2rem, 2vw, 1.8rem);
    margin-bottom: 2.5rem;
    max-width: 600px;
    color: rgba(255,255,255,0.9);
    text-shadow: 0 1px 2px rgba(0,0,0,0.2);
}

/* Update button styles for hero section */
.hero-cta .btn-primary {
    background-color: var(--accent);
    border-color: var(--accent);
}

.hero-cta .btn-primary:hover {
    background-color: rgba(60, 209, 255, 0.3);
    border-color: white;
}

.hero-cta .btn-outline {
    border-color: white;
    color: white;
    background: transparent;
}

.hero-cta .btn-outline:hover {
    background-color: rgba(255,255,255,0.7);
    color: black;
}



/* Font Awesome for icons (you can enqueue this in functions.php) */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
</style>