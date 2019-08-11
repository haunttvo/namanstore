<script type="text/javascript">
    var adminurl = "<?php echo admin_url('admin-ajax.php'); ?>";
</script>
<div class="app_kioviet">
    <h2>danh sách danh mục</h2>
    <button id="sync_categories">Đồng bộ danh mục</button>
    <table class="table_nt table-bordered-nt">
        <thead>
            <tr>
                <th width="20">
                    <input name="allItems" type="checkbox">
                </th>
                <th>Name</th>
                <th>Date</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach ($arr_categories['data'] as $key => $value){ ?>
                <tr>
                    <td>
                        <input name="_productID" type="checkbox" value="<?php echo $value['categoryId'] ?>">
                    </td>
                    <td><?php echo $value['categoryName'] ?></td>
                    <td><?php echo date('m-d-Y', strtotime($value['createdDate']))  ?></td>
                    <td>
                        <button>Sua</button>
                    </td>
                </tr>
            <?php
                if(!empty($value['children'])){
                    each_child_items($value['children']);
                }
            }
        ?>
        </tbody>
    </table>
</div>
<?php
    function pagination_custom(){ ?>
        <ul class="pagination_custom">
            <li>
                <a href="">1</a>
            </li>
        </ul>
    <?php }
    function each_child_items($children, $i = 1)
    {
        foreach ($children as $key => $item){ ?>
            <tr>
                <td>
                    <input name="_productID" type="checkbox" value="<?php echo $item['categoryId'] ?>">
                </td>
                <td><?php echo hr_text($i) .' '. $item['categoryName'] ?></td>
                <td><?php echo date('m-d-Y', strtotime($item['createdDate']))  ?></td>
                <td></td>
            </tr>
        <?php
            if(!empty($item['children'])){
                return each_child_items($item['children'], ++$i);
            }
        }
    }
    function hr_text($num){
        $r = '';
        for($i = 0; $i < $num; $i++){
            $r = $r . '—';
        }
        return $r;
    }
?>
