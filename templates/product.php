    <div class="container">
      <h1 class="mt-4 mb-3"><?= h($product['title']) ?></h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/products">Products</a></li>
        <li class="breadcrumb-item active"><?= h($product['title']) ?></li>
      </ol>
      <p class="lead"><?= h($product['summary']) ?></p>
      <p><?= h($product['body']) ?></p>
      <p><a class="btn btn-outline-primary" href="/products">&larr; All products</a></p>
    </div>
