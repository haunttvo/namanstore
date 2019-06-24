<style>
    .app_kioviet{
        margin-top: 20px;
    }
    .table_nt {
        border-collapse: collapse;
        width: 100%;
        padding: 10px;
    }

    .table_nt, .table_nt th, .table_nt td {
        text-align: left;
        border: 1px solid #dee2e6;
        padding: 5px;
    }
    .pagination_custom{
        display: flex;
        justify-content: center;
    }
    .pagination_custom li{
        float: left;
        border: 1px solid #dee2e6;
        margin-right: 5px;
        margin-left: 5px;
    }
    .pagination_custom li a{
        color: #222;
        text-decoration: none;
        padding: 5px 10px;
        display: inline-block;
    }
    .pagination_custom li a.active{
        color: #fff;
        background-color: #4b93ff;
    }
    .pagination_custom li a:hover{
        color: #fff;
        background-color: #4b93ff;
    }

</style>
<?php
//    echo "<pre>";
//    print_r($result);
?>
<div class="app_kioviet">
    <table class="table_nt table-bordered-nt">
        <thead>
        <tr>
            <th width="20">
                <input type="checkbox" name="allItems">
            </th>
            <th>Id</th>
            <th>Tên sản phẩm</th>
            <th>Danh mục</th>
            <th>Ngày tạo</th>
            <th>Thao tác</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($result as $key => $value){
            ?>
            <tr>
                <td>
                    <input type="checkbox">
                </td>
                <td><?php echo $value[0]['id'] ?></td>
                <td><?php echo $value[0]['name'] ?></td>
                <td><?php echo $value[0]['categoryName'] ?></td>
                <td><?php echo $value[0]['createdDate'] ?></td>
                <td>
                    <button>Sửa</button>
                </td>
            </tr>
        <?php }
        ?>
        </tbody>
    </table>
    <?php
//    echo get_pagination_links(30, 31, admin_url());
        pagination_custom($pg);
    ?>

</div>
<?php
    function pagination_custom($pg){
        $page = $_GET['page_size'];
        $page_current = intval($page)/100;
        ?>
        <ul class="pagination_custom">
            <?php
                echo get_pagination_links($page_current, $pg, admin_url());
            ?>
        </ul>
    <?php }
function get_pagination_links($current_page, $total_pages, $url)
{
    $links = "";
    if ($total_pages >= 1 && $current_page <= $total_pages) {
        $at0 = ($current_page == 0) ? 'active' : '';
        $atlast = ($current_page == $total_pages) ? 'active' : '';
        $links .= "<li><a class=\"{$at0}\" href=\"{$url}?page=kioviet&page_size=0\">0</a></li>";
        $i = max(1, $current_page - 5);
        if ($i > 2)
            $links .= " <span>...</span> ";
        for (; $i < min($current_page + 6, $total_pages); $i++) {
            $active = ($i == $current_page) ? 'active' : '';
            $links .= "<li><a class=\"{$active}\" href=\"{$url}?page=kioviet&page_size={$i}00\">{$i}</a></li>";
        }
        if ($i != $total_pages)
            $links .= " <span>...</span> ";
        $links .= "<li><a class=\"{$atlast}\" href=\"{$url}?page=kioviet&page_size={$total_pages}00\">{$total_pages}</a></li>";
    }
    return $links;
}
?>
