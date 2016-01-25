<div class="rightinfo">
    <table class="tablelist">
        <thead>
            <tr>
                <th>序号</th>
                <th>字段名称</th>
                <th>数据类型</th>
                <th>字段类型</th>
                <th>字段描述</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($list)): ?>
                <?php foreach ($list as $key => $value): ?>
                    <tr>
                        <td><?php echo $key + 1; ?></td>
                        <td><?php echo $value->COLUMN_NAME; ?></td>
                        <td><?php echo $value->DATA_TYPE; ?></td>
                        <td><?php echo $value->COLUMN_TYPE; ?></td>
                        <td><?php echo $value->COLUMN_COMMENT; ?></td>
                    </tr> 
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>