<?php
require_once "./connect.php";
session_start();
//bắt đầU session
//nếu giá trị session user null thì về trang login
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
$sql = "select * from product where status = 1";

$result = mysqli_query($conn, $sql);
$listProduct = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Trang chủ - Danh sách sản phẩm</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>

    <style>
        body {
            padding-top: 50px;
        }

        table {
            width: 80%;
            text-align: center;
        }

        td {
            padding: 10px;
        }

        tr.item {
            border-top: 1px solid #5e5e5e;
            border-bottom: 1px solid #5e5e5e;
        }

        tr.item:hover {
            background-color: #d9edf7;
        }

        tr.item td {
            min-width: 150px;
        }

        tr.header {
            font-weight: bold;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            color: deeppink;
            font-weight: bold;
        }

        td img {
            max-height: 100px;
        }
    </style>


    <script>
        function onClick(product) {
            var object = product.getAttribute("data-object");
            object = JSON.parse(object)
            document.getElementById("deleteItemModal").setAttribute("deleteItemProductId", object.id);
            $(document.getElementById('modal-message')).html("Bạn có chắc rằng muốn xóa <strong id ='delete-object'>" + object.name + "</strong>");
        }

        function deleteItem(deleteItemId) {
            $.ajax({
                method: "POST",
                url: 'delete_item.php',
                data: {
                    deleteItemId: deleteItemId
                },
                success: function() {
                    location.reload();
                }
            }).done(function() {
                $('#deleteItemModal').modal('hide');
            })
        }
    </script>


    <table cellpadding="10" cellspacing="10" border="0" style="border-collapse: collapse; margin: auto">

        <tr class="control" style="text-align: left; font-weight: bold; font-size: 20px">
            <td colspan="4">
                <a href="add_product.php">Thêm sản phẩm</a>
            </td>
            <td class="text-right">
                <a href="logout.php">Đăng xuất</a>
            </td>
        </tr>
        <?php
        if (empty($listProduct)) {
        ?>
            <p style="text-align:center">Không có sản phẩm nào, hãy thêm mới</p>
        <?php
        } else {
        ?>
            <tr class="header">
                <td>Image</td>
                <td>Name</td>
                <td>Price</td>
                <td>Description</td>
                <td>Action</td>
            </tr>
            <?php
            foreach ($listProduct as $product) {

            ?>
                <tr class="item">
                    <td><img src="images/<?= $product["image"] ?>"></td>
                    <td id="productName"><?= $product["name"] ?></td>
                    <td id="productPrice"><?= $product["price"] ?> VND</td>
                    <td id="productDes"><?= $product["description"] ?></td>
                    <td><a href="edit_product.php" data-object="<?php echo htmlentities(json_encode($product)); ?>">Edit</a> |
                        <a data-toggle="modal" data-object="<?php echo htmlentities(json_encode($product)); ?>" onclick="onClick(this)" class="delete-item" href="#deleteItemModal">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
            <tr class="control" style="text-align: right; font-weight: bold; font-size: 17px">
                <td colspan="5">
                    <p>Số lượng sản phẩm: <?= count($listProduct) ?></p>
                </td>
            </tr>
        <?php
        }
        ?>


    </table>


    <!-- Delete Confirm Modal -->
    <div id="deleteItemModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <hp class="modal-title">Xóa sản phẩm</hp>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="modal-message"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger" onclick="deleteItem(document.getElementById('deleteItemModal').getAttribute('deleteItemProductId'))">Xóa</button>
                </div>

            </div>

        </div>
    </div>

</body>

</html>