<?php
require_once('./mysqlConn.php');
getCon();


$name = $_POST['name'];
$phone = $_POST['phone'];
$eatwhat = $_POST['eat'];
$price = $_POST['price'];

if ($name) {
    if (isAlreadyOrder($name)) {
        echo "<script>alert('您今天已经下过单啦～')</script>";
        return;
    }
    insertOrder($name, $phone, $eatwhat, $price);

    setcookie('name', $name, time() + (10 * 365 * 24 * 60 * 60));
    setcookie('phone', $phone, time() + (10 * 365 * 24 * 60 * 60));
}

function insertOrder($name, $phone, $eatwhat, $price)
{
    $sql = "INSERT INTO lvyeorder (name, phone, eatwhat, price)
        VALUES ('" . $name . "', '" . $phone . "', '" . $eatwhat . "', '" . $price . "'); ";
//    echo $sql;
    if (!mysql_query($sql)) {
        die('Error: ' . mysql_error());
    }

    echo "<script>alert('下单成功')</script>";
}

function isAlreadyOrder($name)
{
    $sql = "select count(*) from lvyeorder where name ='" . $name . "' and DATE( TIME ) = curdate()";
    $result = mysql_query($sql);
    $row = mysql_fetch_array($result);
    return $row[0];
}

?>
<html>
<head>
    <title>绿野订餐系统</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="imagetoolbar" content="no"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <link href="resources/css/jquery-ui-themes.css" type="text/css" rel="stylesheet">
    <link href="resources/css/axure_rp_page.css" type="text/css" rel="stylesheet">
    <link href="Home_files/axurerp_pagespecificstyles.css" type="text/css" rel="stylesheet">
    <!--[if IE 6]>
    <link href="Home_files/axurerp_pagespecificstyles_ie6.css" type="text/css" rel="stylesheet">
    <![endif]-->
    <script src="data/sitemap.js"></script>
    <script src="resources/scripts/jquery-1.7.1.min.js"></script>
    <script src="resources/scripts/axutils.js"></script>
    <script src="resources/scripts/jquery-ui-1.8.10.custom.min.js"></script>
    <script src="resources/scripts/axurerp_beforepagescript.js"></script>
    <script src="resources/scripts/messagecenter.js"></script>
    <script src='Home_files/data.js'></script>

    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="./lib/jquery.mousewheel-3.0.6.pack.js"></script>

    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="./source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="./source/jquery.fancybox.css?v=2.1.5" media="screen"/>

    <!-- Add Button helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="./source/helpers/jquery.fancybox-buttons.css?v=1.0.5"/>
    <script type="text/javascript" src="./source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

    <!-- Add Thumbnail helper (this is optional) -->
    <link rel="stylesheet" type="text/css" href="./source/helpers/jquery.fancybox-thumbs.css?v=1.0.7"/>
    <script type="text/javascript" src="./source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

    <!-- Add Media helper (this is optional) -->
    <script type="text/javascript" src="./source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

    <script>

        $(document).ready(function () {
            $('#u9').click(function () {
                if ($('#u1').val() == "") {
                    alert('请输入姓名');
                    return false;
                }
                if ($('#u3').val() == "") {
                    alert('请输入手机号码');
                    return false;
                }

                if ($('#u5').val() == "") {
                    alert('我要吃什么呢？');
                    return false;
                }
                if ($('#u7').val() == "") {
                    alert('多少钱呢？');
                    return false;
                } else if (!isNumber($('#u7').val())) {
                    alert('请输入合理的金额');
                    return false;
                }


            });
            $('.sameto').click(function () {
                $('#u5').val($(this).closest('tr').data('eatwhat'));
                $('#u7').val($(this).closest('tr').data('price'));
            })
        })

        function isNumber(n) {
            return !isNaN(parseFloat(n)) && isFinite(n);
        }


        // Disable opening and closing animations, change title type
        $(".fancybox-effects-b").fancybox({
            openEffect: 'elastic',
            openSpeed: 150,

            closeEffect: 'elastic',
            closeSpeed: 150,
            closeClick: true,

            helpers: {
                title: {
                    type: 'over'
                }
            }
        });
    </script>
</head>
<body>
<div id="main_container">
    <form action="./" method="post">
        <div id="u0" class="u0">
            <div id="u0_rtf"><p style="text-align:left;"><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">姓名</span><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">：</span>
                </p></div>
        </div>
        <INPUT id="u1" type=text value="<?php echo $_COOKIE['name'] ?>" class="u1" name="name">

        <div id="u2" class="u2">
            <div id="u2_rtf"><p style="text-align:left;"><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">电话</span><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">：</span>
                </p></div>
        </div>
        <INPUT id="u3" type=text value="<?php echo $_COOKIE['phone'] ?>" class="u3" name="phone">

        <div id="u4" class="u4">
            <div id="u4_rtf"><p style="text-align:left;"><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">我要吃</span><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">：</span>
                </p></div>
        </div>
        <INPUT id="u5" type=text value="" class="u5" name="eat">

        <div id="u6" class="u6">
            <div id="u6_rtf"><p style="text-align:left;"><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">价钱</span><span
                        style="font-family:Arial;font-size:16px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">：</span>
                </p></div>
        </div>
        <INPUT id="u7" type=text value="" class="u7" name="price">

        <div id="u8" class="u8">
            <DIV id="u8_line" class="u8_line"></DIV>
        </div>
        <INPUT id="u9" type="submit" class="u9" value="下单">
    </form>
    <div id="u10" class="u10">
        <DIV id="u10_line" class="u10_line"></DIV>
    </div>
    <div id="u11" class="u11">
        <DIV id="u11_line" class="u11_line"></DIV>
    </div>
    <div id="u12" class="u12">
        <DIV id="u12_line" class="u12_line"></DIV>
    </div>
    <div id="u13" class="u13">
        <DIV id="u13_line" class="u13_line"></DIV>
    </div>
    <div id="u14" class="u14">
        <div id="u14_rtf"><p style="text-align:left;"><span
                    style="font-family:Arial;font-size:28px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">订餐</span>
            </p></div>
    </div>
    <div id="u15" class="u15">
        <DIV id="u15_line" class="u15_line"></DIV>
    </div>
    <div id="u16" class="u16">
        <DIV id="u16_line" class="u16_line"></DIV>
    </div>

    <div id="u18" class="u18">
        <DIV id="u18_line" class="u18_line"></DIV>
    </div>
    <div id="u19" class="u19">
        <DIV id="u19_line" class="u19_line"></DIV>
    </div>
    <div id="u20" class="u20">
        <div id="u20_rtf"><p style="text-align:left;"><span
                    style="font-family:Arial;font-size:28px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">小伙伴们在吃</span>
            </p></div>


        <table>
            <tr>
                <td>姓名</td>
                <td>电话</td>
                <td>吃什么</td>
                <td>价钱</td>
                <td>操作</td>
            </tr>
            <?php

            $result = mysql_query("SELECT * FROM lvyeorder where DATE( TIME ) = curdate()");

            while ($row = mysql_fetch_array($result)) {
                echo "<tr data-eatwhat='" . $row['eatwhat'] . "' data-price='" . $row['price'] . "' >";
                echo "<td>" . $row['name'] . "</td>"
                    . "<td>" . $row['phone'] . "</td>"
                    . "<td>" . $row['eatwhat'] . "</td>"
                    . "<td>" . $row['price'] . "</td>"
                    . "<td><input type='button' class='sameto' value='和TA吃一样的'  /></td>";
                echo "</tr>";
            }

            mysql_close($mysql_con);
            ?>
        </table>
    </div>
    <div id="u21" class="u21">
        <DIV id="u21_line" class="u21_line"></DIV>
    </div>


    <div id="u39" class="u39">
        <DIV id="u39_line" class="u39_line"></DIV>
    </div>
    <div id="u40" class="u40">
        <DIV id="u40_line" class="u40_line"></DIV>
    </div>
    <div id="u41" class="u41">
        <DIV id="u41_line" class="u41_line"></DIV>
        <table>
            <tr>
            <?php
            $result = mysql_query("SELECT * FROM menu");

            while ($row = mysql_fetch_array($result)) {
                echo "<td><div id=\"u47_img\" >
            <a class=\"fancybox-effects-b\" href=\"menus/" . $row['name'] . "\">" .
                    "<img src='menus/" . $row['name'] . "' class='raw_image'>
            </a></div></td>";
            }?>
            </tr>
        </table>

    </div>
    <div id="u42" class="u42">
        <div id="u42_rtf"><p style="text-align:left;"><span
                    style="font-family:Arial;font-size:28px;font-weight:normal;font-style:normal;text-decoration:none;color:#333333;">菜单</span>
            </p>
        </div>


    </div>

    <div id="u43" class="u43">
        <DIV id="u43_line" class="u43_line"></DIV>
    </div>
    <div id="u44" class="u44">
        <DIV id="u44_line" class="u44_line"></DIV>
    </div>


</div>

<div class="preload"><img src="Home_files/u8_line.png" width="1" height="1"/><img src="Home_files/u10_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u11_line.png" width="1" height="1"/><img src="Home_files/u12_line.png" width="1"
                                                                 height="1"/><img src="Home_files/u13_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u15_line.png" width="1" height="1"/><img src="Home_files/u16_line.png" width="1"
                                                                 height="1"/><img src="Home_files/u17_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u18_line.png" width="1" height="1"/><img src="Home_files/u19_line.png" width="1"
                                                                 height="1"/><img src="Home_files/u21_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u22_normal.png" width="1" height="1"/><img src="Home_files/u25_line.png" width="1"
                                                                   height="1"/><img src="Home_files/u27_line.png"
                                                                                    width="1" height="1"/><img
        src="Home_files/u29_line.png" width="1" height="1"/><img src="Home_files/u32_line.png" width="1"
                                                                 height="1"/><img src="Home_files/u33_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u34_line.png" width="1" height="1"/><img src="Home_files/u39_line.png" width="1"
                                                                 height="1"/><img src="Home_files/u40_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u41_line.png" width="1" height="1"/><img src="Home_files/u43_line.png" width="1"
                                                                 height="1"/><img src="Home_files/u44_line.png"
                                                                                  width="1" height="1"/><img
        src="Home_files/u45_normal.jpg" width="1" height="1"/></div>
</body>
<script src="resources/scripts/axurerp_pagescript.js"></script>
<script src="Home_files/axurerp_pagespecificscript.js" charset="utf-8"></script>