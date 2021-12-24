<?php
$search_query = $_GET['search_query'] = !"" ? mysqli_real_escape_string($conn, $_GET['search_query']) : '';
$search_query = str_replace('+', ' ', $search_query);
?>
<main class="default-page-width">
    <section class="hot-list-container">
        <div class="hot-list-left" id="search">
            <h1>
                Tìm kiếm từ khóa : <span><?php echo '' . $search_query . '' ?></span>
            </h1>
            <div data-search="<?php echo '' . $search_query . '' ?>" 
            class="search-posts" id="search-posts" >

            </div>
        </div>
    </section>
</main>