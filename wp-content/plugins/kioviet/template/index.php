<script type="text/javascript">
    var adminurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<div class="app_kioviet">
    <h2>Danh sách sản phẩm</h2>
    <button class="btn" id="sync_product">Đồng bộ</button>
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
            foreach ($value as $k => $vl){
                if( empty($k) ){
                    foreach ($vl as $ks => $vs){ ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="_productID" value="<?php echo $vs['id'] ?>">
                            </td>
                            <td><?php echo $vs['id'] ?></td>
                            <td><?php echo $vs['name'] ?></td>
                            <td><?php echo $vs['categoryName'] ?></td>
                            <td><?php echo $vs['createdDate'] ?></td>
                            <td>
                                <button>Sửa</button>
                            </td>
                        </tr>
                    <?php }
                }else{ ?>
                    <tr>
                        <td>
                            <input type="checkbox" name="_productID" value="<?php echo $vl[0]['masterProductId'] ?>">
                        </td>
                        <td><?php echo $vl[0]['id'] ?></td>
                        <td><?php echo $vl[0]['name'] ?></td>
                        <td><?php echo $vl[0]['categoryName'] ?></td>
                        <td><?php echo $vl[0]['createdDate'] ?></td>
                        <td>
                            <button>Sửa</button>
                        </td>
                    </tr>
                <?php }
            }
        }
        ?>
        </tbody>
    </table>
    <?php
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
