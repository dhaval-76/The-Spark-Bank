<?php
  include 'dbCreation.php';
  $query = "select * from history";
  $result = mysqli_query($conn,$query);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">
    <title>The Spark Bank</title>
  </head>
  <body>
    <div class="customer-container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
                
                <span class="navbar-brand fs-3">The Spark Bank</span>
                <ul class="navbar-nav fs-5 ms-auto">
                  <li class="nav-item px-2">
                    <a class="nav-link " aria-current="page" href="index.php">Home</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link" href="customers_all.php">Customers</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link active" href="transaction.php">Transaction History</a>
                  </li>
                </ul>
              </div>
        </div>
      </nav>
      <div class="container">
        <h2 class="title">Transaction History</h2>
        <div class="table-responsive">
          <table class="table table-hover table-striped">
            <thead class="bg-warning">
              <tr>
                <th>Sender</th>
                <th>Receiver</th>
                <th>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
                while($rows = mysqli_fetch_array($result)){
              ?>
              <tr>
                <td><?php echo $rows['sender'] ?></td>
                <td><?php echo $rows['receiver'] ?></td>
                <td><?php echo $rows['amount'] ?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>  
<?php
include 'footer.php';
?>