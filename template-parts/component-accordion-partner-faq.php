<?php
/**
 * Template Part: Partner Program FAQ Data & Component Loader
 *
 * This file defines the FAQ data for the partner program and then calls
 * the global accordion component to render it.
 *
 * @package Luvex
 * @since 3.3.0
 */

// 1. Define the FAQ data for this specific section
$partner_faq_items = [
    [
        'question' => 'What kind of partnership are you looking for?',
        'answer'   => 'We are primarily interested in distribution or reseller partnerships for products that complement our existing portfolio and offer clear value to our customers in the DACH region and the broader EU market.'
    ],
    [
        'question' => 'Is there an exclusivity requirement?',
        'answer'   => 'This is decided on a case-by-case basis. Our goal is to create a mutually beneficial relationship. We can discuss exclusivity during our technical and market fit analysis.'
    ],
    [
        'question' => 'What is the first step to start the process?',
        'answer'   => 'The best way is to send us an email via the contact link on this page. Please include a brief introduction to your product, its primary applications, and any existing technical documentation or datasheets.'
    ],
    [
        'question' => 'How long does the evaluation process take?',
        'answer'   => 'The timeline depends on the product\'s complexity. An initial review and market analysis typically takes 2-4 weeks. A full technical evaluation with customer feedback may take longer.'
    ],
    [
        'question' => 'Do you also work with start-ups or new companies?',
        'answer'   => 'Yes, absolutely. We evaluate technologies based on their performance, quality, and potential benefit to our customers, not on the age or size of the manufacturing company.'
    ]
];

// 2. Call the global accordion component function with the data
if (function_exists('luvex_get_accordion_component')) {
    luvex_get_accordion_component($partner_faq_items, true);
} else {
    // Fallback or error message if the function is not available
    echo '<p>Error: The accordion component could not be loaded.</p>';
}

?>

