<?php declare(strict_types=1); ?>
    <div class="container">
      <h1 class="mt-4 mb-3">Contact</h1>
      <?php app_breadcrumb([
          ['label' => 'Home', 'href' => app_url()],
          ['label' => 'Contact'],
      ]); ?>
      <address class="mt-3">
        <strong>Start Bootstrap</strong><br>
        3481 Melrose Place<br>
        Beverly Hills, CA 90210<br>
        <abbr title="Phone">P:</abbr> (123) 456-7890<br>
        <abbr title="Email">E:</abbr> <a href="mailto:name@example.com">name@example.com</a>
      </address>
    </div>
