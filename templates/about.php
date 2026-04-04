<?php declare(strict_types=1); ?>
        <!-- About page content -->
        <div class="container">
            <h1 class="mt-4 mb-3">About
                <small class="text-muted">Our Business</small>
            </h1>
            <?php app_breadcrumb([
                ['label' => 'Home', 'href' => app_url()],
                ['label' => 'About'],
            ]); ?>
            <div class="row">
                <div class="col-lg-6">
                    <img class="img-fluid rounded mb-4" src="<?= h(app_url('images/placeholders/about-750x450.svg')) ?>" alt="">
                </div>
                <div class="col-lg-6">
                    <h2>About Our Business</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sed voluptate nihil eum consectetur similique? Consectetur, quod, incidunt, harum nisi dolores delectus reprehenderit voluptatem perferendis dicta dolorem non blanditiis ex fugiat.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe, magni, aperiam vitae illum voluptatum aut sequi impedit non velit ab ea pariatur sint quidem corporis eveniet. Odit, temporibus reprehenderit dolorum!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et, consequuntur, modi mollitia corporis ipsa voluptate corrupti eum ratione ex ea praesentium quibusdam? Aut, in eum facere corrupti necessitatibus perspiciatis quis?</p>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container -->

