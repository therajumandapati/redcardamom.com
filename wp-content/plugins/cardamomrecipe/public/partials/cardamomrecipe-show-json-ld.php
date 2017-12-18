<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://rajumandapati.com
 * @since      1.0.0
 *
 * @package    Cardamomrecipe
 * @subpackage Cardamomrecipe/public/partials
 */

$ingredients = "";

if(function_exists('get_field') && !empty(get_field('cardamom_ingredients'))) {
    $ingredients = '"' . implode("\",\"", explode("\n", get_field('cardamom_ingredients'))) . '"';
}

$instructions = "";

if(function_exists('get_field') && !empty(get_field('cardamom_instructions'))) {
    $instructions = '"' . implode("\",\"", explode("\n", get_field('cardamom_instructions'))) . '"';
}

$prep_time = 0;
$cook_time = 0;
$total_time = 0;

if(function_exists('get_field') && !empty(get_field('cardamom_preptime'))) {
    $prep_time = cardamomrecipe_convertToHoursMins(get_field('cardamom_preptime'));
}

if(function_exists('get_field') && !empty(get_field('cardamom_cooktime'))) {
    $cook_time = cardamomrecipe_convertToHoursMins(get_field('cardamom_cooktime'));
}

$total_time = cardamomrecipe_convertToHoursMins(get_field('cardamom_preptime') + get_field('cardamom_cooktime'));


$recipe_yield = '';

if(function_exists('get_field') && !empty(get_field('cardamom_yield'))) {
    $recipe_yield = get_field('cardamom_yield');
}

$review_count = 0;
$review_rating = 0;

if(function_exists('get_field') && !empty(get_field('cardamom_reviewcount'))) {
    $review_count = get_field('cardamom_reviewcount');
}

if(function_exists('get_field') && !empty(get_field('cardamom_rating'))) {
    $review_rating = get_field('cardamom_rating');
}

?>

<script type="application/ld+json">
{
    "@context": "https:\/\/schema.org\/",
    "@type": "Recipe",
    "name": "<? the_title(); ?>",
    "description": "<? echo wp_strip_all_tags(get_the_excerpt()); ?>",
    "author": {
        "@type": "Person",
        "name": "<?php the_author(); ?>"
    },
    <?php if(has_post_thumbnail()) {
      $image_data = wp_get_attachment_image_src( get_post_thumbnail_id() );
       ?>
    "image": {
        "@type": "ImageObject",
        "url": "<?php echo $image_data[0]; ?>",
        "height": "<?php echo $image_data[1]; ?>",
        "width": "<?php echo $image_data[2]; ?>"
    },
    <?php } ?>
    "url": "<?php the_permalink(); ?>",
    "recipeIngredient": [
        <?php echo $ingredients; ?>
    ],
    "recipeInstructions": [
        <?php echo $instructions; ?>
    ],
    "prepTime": "<?php echo $prep_time ?>",
    "cookTime": "<?php echo $cook_time ?>",
    "totalTime": "<?php echo $total_time ?>",
    "recipeYield": "<?php echo $recipe_yield ?>"<?php if($review_count !== 0) { ?>,
    "aggregateRating": {
        "@type": "AggregateRating",
        "reviewCount": <?php echo $review_count; ?>,
        "ratingValue": <?php echo $review_rating; ?>
    }
    <?php } ?>
}
</script>
