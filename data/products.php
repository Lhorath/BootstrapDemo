<?php
declare(strict_types=1);

/**
 * Product catalog keyed by URL slug (lowercase, hyphenated).
 * Used by the router to validate /products/{slug} and by listing templates.
 */
return [
    'starter-plan' => [
        'title' => 'Starter Plan',
        'summary' => 'Essential features for small teams getting started.',
        'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.',
    ],
    'professional-suite' => [
        'title' => 'Professional Suite',
        'summary' => 'Advanced tools and priority support for growing businesses.',
        'body' => 'Cras mattis consectetur purus sit amet fermentum. Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.',
    ],
    'enterprise-cloud' => [
        'title' => 'Enterprise Cloud',
        'summary' => 'Scale, compliance, and dedicated infrastructure options.',
        'body' => 'Nullam quis risus eget urna mollis ornare vel eu leo. Vestibulum id ligula porta felis euismod semper. Curabitur blandit tempus porttitor.',
    ],
];
