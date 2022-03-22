<?php
require('app/Customer.php');
require('app/Product.php');
require('app/ShoppingCart.php');
require('app/FileUtility.php');

$products_data = FileUtility::openCSV('products.csv');

$products = Product::convertArrayToProducts($products_data);

$customer = new Customer('John Doe', 'john@mail.com');

$shoppingCart = new ShoppingCart($customer);
$shoppingCartItems = $shoppingCart->getAllItems();
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
          <a class="nav-link" href="products-list.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="shopping-cart.php">Shopping Cart</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<h1>Welcome <?php echo $customer->getName() ?>!</h1>
<div class="mx-auto" style="width: 200px;">
<h2>Shopping Cart</h2>
<h4>
    <a href="products-list.php">Shop More Products</a>
</h4>

<?php if (count($shoppingCartItems) > 0): ?>

    <table>
    <thead>
        <th>Product</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Subtotal</th>
    </thead>
    <tbody>

    <?php foreach ($shoppingCartItems as $item): ?>

        <tr>
            <td><?php echo $item['product']->getName(); ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['price']; ?></td>
            <td><?php echo $item['subtotal']; ?></td>
        </tr>

    <?php endforeach; ?>

        <tr>
            <td colspan="4">
                <?php echo $shoppingCart->getItemsTotal(); ?>
            </td>
        </tr>

    </tbody>
    </table>

    <?php endif; ?>

</body>
</html>