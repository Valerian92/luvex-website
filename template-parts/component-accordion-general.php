<?php
/**
 * Template Part: General Accordion Component
 *
 * This component can be used anywhere by passing data via the luvex_get_accordion_component() function.
 *
 * @package Luvex
 * @since 3.3.0
 */

// Retrieve data passed from the helper function
$data = get_query_var('accordion_data', ['faqs' => [], 'first_active' => true]);
$faqs_to_display = $data['faqs'];
$first_item_active = $data['first_active'];

if (empty($faqs_to_display)) {
    return;
}
?>

<div class="accordion-container accordion--tech" style="margin-top: 4rem;">

    <?php foreach ($faqs_to_display as $index => $faq) : ?>
        <?php
        // Basic validation
        if (empty($faq['question']) || empty($faq['answer'])) {
            continue;
        }
        $is_active = $first_item_active && ($index === 0);
        ?>
        <div class="accordion-item <?php echo $is_active ? 'active' : ''; ?>">
            <div class="accordion-header">
                <h4><?php echo esc_html($faq['question']); ?></h4>
                <div class="accordion-icon-wrapper">
                    <i class="fa-solid fa-plus icon-open"></i>
                    <i class="fa-solid fa-minus icon-close"></i>
                </div>
            </div>
            <div class="accordion-content">
                <div class="accordion-body">
                    <p><?php echo esc_html($faq['answer']); ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>
