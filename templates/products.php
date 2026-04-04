    <div class="container">
      <h1 class="mt-4 mb-3">Products</h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item active">Products</li>
      </ol>
      <p class="lead">Browse offerings; each item has its own clean URL under <code>/products/</code>.</p>

      <div class="row">
        <?php foreach ($products as $slug => $item) { ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <div class="card-body">
                <h2 class="h5 card-title"><?= h($item['title']) ?></h2>
                <p class="card-text"><?= h($item['summary']) ?></p>
                <a class="btn btn-primary" href="/products/<?= h($slug) ?>">View details</a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
