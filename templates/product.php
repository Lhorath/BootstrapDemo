<?php declare(strict_types=1); ?>
    <div class="container">
      <h1 class="mt-4 mb-3"><?= h($product['title']) ?></h1>
      <?php app_breadcrumb([
          ['label' => 'Home', 'href' => app_url()],
          ['label' => 'Products', 'href' => app_url('products')],
          ['label' => $product['title']],
      ]); ?>
      <p class="lead"><?= h($product['summary']) ?></p>
      <p><?= h($product['body']) ?></p>
      <p><a class="btn btn-outline-primary" href="<?= h(app_url('products')) ?>">&larr; All products</a></p>
    </div>
