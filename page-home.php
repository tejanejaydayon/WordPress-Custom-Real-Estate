<?php
/**
 * Template Name: Home Page Template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Aussie_Home_Haven
 */

 get_header();

 ?>
 
<!-- Home Page -->
<div class="home-page-container">
<?php
$bg_img = ""; 
$background_image = get_field( 'background_image' ); ?>
    <?php if ( $background_image ) { ?>
        <?php $bg_img = esc_url( $background_image['url'] ); ?>
<?php } ?>
    <section id="hero-section" class="hero-section section m-lg-auto" style="background: linear-gradient(0deg, rgba(16, 14, 15, 0.35), rgba(16,14,15,0.35)) ,url(<?php echo $bg_img; ?>);">
        <div class="search-form-container">
            <h1 class="hero-heading text-white text-center mb-4">Find Your Dream Properties</h1>
             <div class="search-form bg-white">
                <h3>Search your Properties</h3>
                <div class="separator"></div>
                    <form action="<?php echo home_url(); ?>/property" method="get">
                       <div class="row">
                            <div class="col-md-3">
                            <div class="form-group">
                                <label for="property_type">Looking For</label>
                                <select name="property_type" id="property_type" class="form-select">
                                    <?php
                                        $property_types = get_terms( array(
                                            'taxonomy'   => 'property_type',
                                            'hide_empty' => false,
                                        ) ); 
                                        foreach($property_types as $property_type){
                                        ?>
                                            <option value="<?php echo $property_type->slug; ?>"><?php echo $property_type->name; ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="property_size">Property Size</label>
                                <select name="property_type" id="property_size" class="form-select">
                                <?php
                                    // Arguments
                                    $args = array(
                                        'post_type' => 'property',
                                        'post_status' => 'publish'
                                    );
                                    // The Query.
                                    $the_query = new WP_Query( $args );

                                    // The Loop.
                                    if ( $the_query->have_posts() ) {
                                        echo '<ul>';
                                        while ( $the_query->have_posts() ) {
                                            $the_query->the_post();
                                            $id = get_the_ID();
                                    ?>
                                            <option value="<?php the_field('property_size', get_the_ID()); ?>"><?php the_field('property_size', $id); ?> mq2</option>
                                        <?php }
                                    
                                    } else {
                                        esc_html_e( 'Sorry, no posts matched your criteria.' );
                                    }
                                    // Restore original Post Data.
                                    wp_reset_postdata();
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                <label for="property_location">Location</label>
                                <select name="property_type" id="property_location" class="form-select">
                                    <?php
                                        $locations = get_terms( array(
                                            'taxonomy'   => 'location',
                                            'hide_empty' => false,
                                        ) );
                                        foreach($locations as $location) {
                                        ?>
                                        <option value="<?php echo $location->slug; ?>"><?php echo $location->name; ?></option>
                                        <?php 
                                        }
                                    ?>
                                </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="submit" style="visibility: hidden;">Submit</label>
                                    <input type="submit" class="btn btn-success form-control" value="SEARCH">
                                </div>
                            </div>
                       </div>
                    </form>
                </div>
             </div>
    </section>
    <!-- Hero Section End Here -->
    <!-- Featured Property  Section Starts -->
    <?php echo featured_properties(); ?>
    <!-- Featured Property  Section Ends -->

    <section class="email-signup-section" id="email-signup-section" style="background-image:url('<?php echo img_dir_url() ?>/sign-up-bg.png')">
        <div class="bg-overlay-email-signup-section section">
          <div class="container">
            <div class="row">
                    <div class="col-md-6">
                        <h2 class="text-left">Subscribe Our Email Address
                            For Future Lettest News & Updates
                        </h2>
                    </div>
                    <div class="col-md-6 text-white text-center">
                        <h2 class="section-heading">Contact Form 7</h2>
                    </div>    
                </div>
          </div>
        </div>
    </section>
    <!-- Recommend Property Section Starts -->
       <section class="section recommend-p-section" id="recommend-p-section">
          <div class="container top-container">
             <div class="row">
                <div class="col-lg-6">
                    <h2 class="sec-heading text-left item-space">
                    <?php the_field( 'recommended_section_heading', 'option' ); ?>
                    </h2>
                    <p class="section-description">
                    <?php the_field( 'recommended_section_description', 'option' ); ?>
                    </p>
                </div>
                <div class="col-lg-6 text-right my-auto">
                <?php $button_for_recommended_property = get_field( 'button_for_recommended_property', 'option' ); ?>
                <?php if ( $button_for_recommended_property ) : ?>
                    <a href="<?php echo esc_url( $button_for_recommended_property['url'] ); ?>" class="btn-global my-auto" target="<?php echo esc_attr( $button_for_recommended_property['target'] ); ?>"><?php echo esc_html( $button_for_recommended_property['title'] ); ?></a>
                <?php endif; ?>
                </div>
             </div>
          </div>
          <div class="container-fluid bottom-container r-p-section section item-space" style="background-image: url('<?php echo img_dir_url(); ?>/slider-bg.png');">
            <?php $select_recommended_properties = get_field( 'select_recommended_properties', 'option' ); ?>
                <?php if ( $select_recommended_properties ) : ?>
                <div class="container">
                    <div class="r-p-slider-container">
                    <?php foreach ( $select_recommended_properties as $post ) :  ?>
                        <?php setup_postdata( $post );
                          $id = $post->ID;
                         ?>
                            <div>
                            <div class="row">
                               <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                                 <div class="r-p-slider-content">
                                            <h2 class="item-space">
                                                <?php echo get_the_title($id); ?>
                                            </h2>
                                            <p class="item-space">
                                                <?php echo wp_trim_words( get_the_excerpt($id), 25, '......'); ?>
                                            </p>
                                            <div class="f-p-details d-flex justify-content-start item-space">
                                                <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/mapW.png'  ?>" />
                                                <span class="f-p-item"><?php the_field('address', get_the_ID()); ?></span>
                                            </div>
                                            <hr>
                                            <div class="d-flex justify-content-between flex-wrap flex-row item-space">
                                                <div class="f-p-details">
                                                    <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/bedW.png'  ?>" />
                                                    <span class="f-p-item"><?php the_field('bedrooms', get_the_ID()); ?>Bedrooms</span>
                                                </div>
                                                <div class="f-p-details">
                                                    <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/bathW.png'  ?>" />
                                                    <span class="f-p-item"><?php the_field('bath', get_the_ID()); ?>Bath</span>
                                                </div>
                                                <div class="f-p-details">
                                                    <img class="f-p-icon-img" src="<?php echo img_dir_url() . '/areaW.png'  ?>" />
                                                    <span class="f-p-item"><?php the_field('property_size', get_the_ID()); ?>mq</span>
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-sm-12">
                                    
                                            <div class="r-p-slider-img" style="background-image:url('<?php echo get_the_post_thumbnail_url($id); ?>')">
                                                
                                            </div>
                                        </div>
                                    </div>
                            </div>
                    <?php endforeach; ?>
                    </div>
                </div>
                <?php wp_reset_postdata(); ?>
                  <style>
                     .prev-arrow {
                        background-image: url('<?php echo img_dir_url(); ?>/prev.png');
                        background-size: contain;
                        background-repeat: no-repeat;
                        background-position: center;
                        height: 40px;
                        width: 40px;
                        padding-right: 15px;
                     }
                     .next-arrow {
                        background-image: url('<?php echo img_dir_url(); ?>/next.png');
                        background-size: contain;
                        background-repeat: no-repeat;
                        background-position: center;
                        height: 40px;
                        width: 40px;
                        margin-left: 65px;
                     }
                  </style>    
            <?php endif; ?>
          </div>
       </section>
    <!-- Recommend Property Section Ends -->
    
</div><!-- Home Page Ending tag --> 

 <?php

 get_footer();