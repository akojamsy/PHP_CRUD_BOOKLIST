<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD sidehustle</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        include_once 'process.php';
    ?>

    <div class="container" >

        <h2 class="title-app"> MY BOOK LIST APP</h2>

        <?php 
            if(isset($_SESSION['message'])){
        ?>
                <div class="<?php echo $_SESSION['msg-type']?>">
                    <?php echo $_SESSION['message'];
                    unset($_SESSION['message'])
                    ?>
                </div>
        <?php };?>
            <form action="process.php"  method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="bname">Book Name</label>
                <input type="text" id="bname" name="bookname" value="<?php echo $bookName ?>" placeholder="Book name.." required>

                <label for="pname">Publisher</label>
                <input type="text" id="pname" name="publisher" value="<?php echo $publisher ?>"  placeholder="Publisher name.." required>

                <label for="country">Country</label>
                <input type="text" name="country" value="<?php echo $country ?>"  placeholder="Your country name.." required>
    
                <label for="price">Price</label>
                <input type="number" name="price" value="<?php echo $price ?>"  placeholder="Price e.g, $30.99" required>

               <?php 
                if($update == true){
               ?>
                    <input type="submit" name="update" value="update">
              <?php } else {?>
                <input type="submit" name="save" value="save">
                <?php };?>
            </form>
    </div>
    
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'crud') or die(mysqli_error($mysqli));
        $result = $mysqli->query("SELECT * FROM data") or die(mysqli_error($mysqli));
    ?>
    <table class="styled-table" >
        <thead>
            <tr>
                <th>Name of Book</th>
                <th>Publisher</th>
                <th>Country</th>
                <th>Price</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <?php 
            while ($row = $result->fetch_assoc()){ ?>
                <tbody>
                    <tr>
                        <td><?php echo $row['bookName'] ?></td>
                        <td><?php echo $row['publisher'] ?></td>
                        <td><?php echo $row['country'] ?></td>
                        <td>$<?php echo $row['price'] ?></td>
                        <td><a href="index.php?edit=<?php echo $row['id']; ?>"><img src="img/editIcon.png" alt=""></a></td>
                        <td><a href="process.php?delete=<?php echo $row['id']; ?>"><img src="img/deleteIcon.png" alt=""></a></td>
                    </tr>
                </tbody>
        <?php } ;?>
    </table>



















    
</body>
</html>