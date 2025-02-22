<?php
    include 'config.php';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--- google font link -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oxanium:wght@600;700;800&family=Poppins:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">
    <link rel="shortcut icon" href="./fav.png" type="image/x-icon">
    <title>Add A Product</title>
    <link rel="stylesheet" href="adminSideNav.css">
    <link rel="stylesheet" href="addproduct.css">
    
    
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet"/>

  </head>
  <body>
  
<?php
include 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['product_name']) && isset($_POST['product_price']) && isset($_POST['product_description']) && isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
        $pName = $_POST['product_name'];
        $price = $_POST['product_price'];
        $des = $_POST['product_description'];
        
        // Handle image upload
        $imgData = file_get_contents($_FILES['img']['tmp_name']);

        // Use prepared statement to insert image binary data into the database
        $statement = $conn->prepare("INSERT INTO products(name, image, price, product_details) VALUES(?, ?, ?, ?)");
        $statement->bind_param("ssds", $pName, $imgData, $price, $des);

        if ($statement->execute()) {
            session_start();
            echo "<script> alert('Product Added'); </script>";
        } else {
            // Handle insertion error
            echo "<script>alert('Product addition failed.');</script>";
        }

        $statement->close();
    } else {
        // Handle missing or incomplete form data
        echo "<script>alert('Please fill in all required fields.');</script>";
    }
}
?>
    <nav class="navbar">
      <h1 class="navbar-title"><a href="index.php"><i class="bx bxs-dashboard"></a></i> Dashboard</h1>
      </div>
      <div class="user-profile">
        <img src="assets/images/userP.jpg" alt="User Profile" />
        <i class="bx bxs-bell-ring"></i>
      </div>
    </nav>
    <div class="sidebar">
      <ul class="sidebar-menu">
        <li>
          <a href="addproduct.php"><i class="bx bxs-book-add"></i>Add Products</a>
        </li>
        <li>
        <a href="index.php"><i class="bx bx-log-out-circle"></i>Logout</a>
        </li>
      </ul>
    </div>
  
    
    <h2 class="text-center py-5"><b>Add A Product</b></h2>
    <section class="container glass my-2 w-50 text-light p-2">
        <div class="text-center">
        <form action="addProduct.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <label>Product Name</label>
                <input type="text" id="product-name" name="product_name" required>
            </fieldset>
            <fieldset>
                <label>Product Price</label>
                <input type="number" id="product-price" name="product_price" min="0" step="0.01" required>
                </fieldset>
            <fieldset>
                <label>Product Category</label>
                <select id="product-category" name="product_category">
                    <option value="games">Games</option>
                    <option value="electronics">Gaming Accessories</option>
                    <option value="jersey">Jersey</option>
            
                </select>
            </fieldset>
            <fieldset>
                <label>Product Description</label>
                <textarea id="product-description" class="form-control" name="product_description" rows="8" required></textarea>  
            </fieldset>
            <fieldset>
            <label>Product Image</label><br>
                <input type="file" id="img" name="img" accept="image/*">
            </fieldset>  
            <input class="button" id="submit" type="submit" value="Add Product">
            </form>
        </div>
        
    </section>
       
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>
