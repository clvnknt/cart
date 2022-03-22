<?php
require('app/Customer.php');
require('app/Product.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');
?>

<html>
<head>
    <title>My Cart</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

</head>
<body style="background-image: url('wallpaper.png');">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
  <img src="FruitiliciousLOGO.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
    <a class="navbar-brand" href="#">Fruitilicious</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="shopping-cart.php">Shopping Cart</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<h1>Welcome <?php echo $customer->getName() ?>!</h1>
<div class="mx-auto" style="width: 200px;">
<h2>Products</h2>

<?php foreach ($products as $product): ?>

<form action="add-to-cart.php" method="POST">
    <input type="hidden" name="product_id" value="<?php echo $product->getId(); ?>" />

    <h3><?php echo $product->getName(); ?></h3>
    <img src="<?php echo $product->getImage(); ?>" height="100px" />
    <p>
        <?php echo $product->getDescription(); ?><br/>
        <span style="color: blue">PHP <?php echo $product->getPrice(); ?></span>
        Qty <input type="number" name="quantity" class="quantity" value="0" />
        <br><br><button type="submit" class="btn btn-primary"> 
            ADD TO CART
        </button>
    </p>
</form>

<?php endforeach; ?>
</div>
</div>
</body>
</html>