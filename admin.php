<?php
/**
 * Created by PhpStorm.
 * User: jinbangzhu
 * Date: 11/15/13
 * Time: 11:08 AM
 */
require_once('./mysqlConn.php');
getCon();

if($_GET['id']){
    $sql = "delete from menu where id =".$_GET['id'];
    if (!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }
    echo "<alert>删除成功</alert>";
}
?>

<html>
<head>
    <title>绿野订餐管理系统</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
</head>
<body>

<form action="./upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file">上传新菜单:</label>
    <input type="file" name="file"  id="file"/>
    <br/>
    <input type="submit" name="submit" value="开始上传"/>
</form>

<hr/>
<a href="order.php">查看订单</a>
<hr/>
<table>
    <?php
    $result = mysql_query("SELECT * FROM menu");

    while ($row = mysql_fetch_array($result)) {
        echo "<tr><td>
            <a class='fancybox-effects-b' href='menus/'" . $row['name'] . "'>" .
                "<img width='200' height='200' src='menus/".$row['name']."' class='raw_image'>
            </a>
            </td>
            <td>
                <a onclick=\"return confirm('确定要删除吗?')\"  href='./admin.php?id=".$row['id']."'>删除</a>
            </td>
            </tr>";
    }
    ?>
</table>
<hr/>
</body>
</html>