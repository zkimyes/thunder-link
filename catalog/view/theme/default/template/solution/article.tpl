<?php echo $header; ?>
<?php echo $content_top ?>
<main class="main bg-white contact_us">
    <div class="container">
        <div class="solution-content-article">
            <div class="article-header">
                    <h1>{{article.title}}</h1>
            </div>
            <div class="article-body">
                {{article.content|raw}}
            </div>
        </div>
    </div>
</main>
<?php echo $content_bottom ?>
<?php echo $footer; ?>