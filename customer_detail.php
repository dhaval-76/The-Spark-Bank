<?php 
include 'dbCreation.php';
if(isset($_POST['submit']))
{
    $from = $_GET['ac'];
    $toUser = $_POST['to'];
    $amnt = $_POST['amount'];

    $sql = "SELECT * from user where acno=$from";
    $query = mysqli_query($conn,$sql);
    $sql1 = mysqli_fetch_array($query); 

    $sql = "SELECT * from user where acno=$toUser";
    $query = mysqli_query($conn,$sql);
    $sql2 = mysqli_fetch_array($query);

  
 if($amnt > $sql1['balance'])
    {

        echo '<script type="text/javascript">';
        echo ' alert("Insufficient Balance")';  
        echo '</script>';
    }

     else if($amnt == 0){
         echo "<script type='text/javascript'>alert('Enter Amount Greater than Zero');
    </script>";
     }
   else {    
    $newCredit = $sql1['balance'] - $amnt;
    $sq3 = "UPDATE user set balance=$newCredit where acno=$from";
    mysqli_query($conn,$sq3);

    $newCredit = $sql2['balance'] + $amnt;
    $sq3 = "UPDATE user set balance=$newCredit where acno=$toUser";
    mysqli_query($conn,$sq3);

    $sender = $sql1['name'];
    $receiver = $sql2['name'];
    echo "<script type='text/javascript'>console.log('insert before');
          console.log('$sender'+'sender');  
          console.log('$receiver'+'receiver');  
        </script>";
    $sql = "INSERT INTO history VALUES ('$sender','$receiver',$amnt);";
    echo "<script type='text/javascript'>console.log('insert after');
            console.log(`$sql sql`);        
          </script>";
    $tns = mysqli_query($conn,$sql);
    if($tns){
      echo "<script type='text/javascript'>console.log('insert inside'); </script>";
      echo "<script type='text/javascript'>
              alert('Transaction Successfull!');
              window.location='transaction.php';
            </script>";
    }
    $newCredit= 0;
    $amnt = 0;
  }

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <link rel="stylesheet" href="css/index.css">
    <title>TSF Bank</title>
  </head>
  <body>
    <div class="customer-container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="customers_all.php">View Customers</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="transaction.php">Transaction History</a>
              </li>
            </ul>
            <span class="navbar-brand">
              TSF Bank
            </span>
          </div>
        </div>
      </nav>
      <div class="container">
        <div class="col-12 col-md-9">
          <h2 class="title">Customer Detail</h2>

      <?php
        include 'dbCreation.php';
        $sid=$_GET['ac'];
        $sql = "SELECT * FROM  user where acno=$sid";
        $query=mysqli_query($conn,$sql);
        if(!$query)
        {
        echo "Error ".$sql."<br/>".mysqli_error($conn);
        }
        $rows=mysqli_fetch_array($query);
      ?>
      <form method="post" name="tcredit" class="tabletext" >
        <div class="table-responsive">
        <table class="table table-bordered border-primary">
          <tr>
            <th>Ac No. </th>
            <td><?php echo $rows['acno'] ?></td>
          </tr>
          <tr>
            <th>Name </th>
            <td><?php echo $rows['name'] ?></td>
          </tr>
          <tr>
            <th>Email </th>
            <td><?php echo $rows['email'] ?></td>
          </tr>
          <tr>
            <th>Gender </th>
            <td><?php echo $rows['gender'] ?></td>
          </tr>
          <tr>
            <th>Balance </th>
            <td><?php echo $rows['balance'] ?></td>
          </tr>
        </table>
      </div>
          <h2 class="title">Transfer Amount</h2>
    <div class="col-sm-6">
    <div class="form-group">
      <label for="sel1">TRANSFER TO:</label>
      <select class="form-control" id="sel1" name="to">
        <?php
          include 'dbCreation.php';
          $sid=$_GET['ac'];
          $sql = "SELECT * FROM user where acno!=$sid";
          $query=mysqli_query($conn,$sql);
          if(!$query)
          {
            echo "Error ".$sql."<br/>".mysqli_error($conn);
          }
          while($rows = mysqli_fetch_array($query)) {
        ?>
        <option value="<?php echo $rows['acno'];?>"><?php echo $rows['name'] ;?></option>
      <?php } ?>
      </select>
    </div>
    </div>

    <div class="col-sm-6">
      <label for="sel1">SELECT AMOUNT</label>
      <input type="number" id="amm" class="form-control" name="amount" min="0" required  />
    </div>

    <div class="col-sm-6">
      <div class="text-center" >
        <button type="submit" name="submit" class="btn btn-success submitbtn">PROCEED</button>
      </div>
    </div>
    </form>
    </div>
    </div>
      
<?php
include 'footer.php';
?>