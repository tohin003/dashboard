<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tohinphp";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$showAlert = false;
$errorAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_POST["id"];
    $ordername = $_POST["ordername"];
    $email = $_POST["email"];
    $phno = $_POST["phno"];
    $name = $_POST["name"];
    $checkbox = isset($_POST["checkbox"]) ? $_POST["checkbox"] : '';

    if (!empty($id) && !empty($ordername) && !empty($email) && !empty($phno) && !empty($name) && !empty($checkbox)) {
        $stmt = $conn->prepare("INSERT INTO `orders`(`id`, `ordername`, `email`, `phno`, `name`) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $id, $ordername, $email, $phno, $name);

        if ($stmt->execute()) {
            $showAlert = true;
        } else {
            $errorAlert = true;
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $errorAlert = true;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
</head>
<body>
<?php
if ($showAlert) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Congratulations!</strong> Your order has been placed successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
if ($errorAlert) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> All fields are required or there was an issue with the submission.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
}
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row flex-grow">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left p-5">
                        <div class="brand-logo">
                            <img src="../../assets/images/logo.svg">
                        </div>
                        <form class="pt-3" method="post" action="">
                            <div class="form-group">
                                <input type="hidden" class="form-control form-control-lg" name="id" value="<?php echo $_GET['id']; ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="ordername" value="<?php echo $_GET['name']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-lg" name="name" placeholder="name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="number" class="form-control form-control-lg" name="phno" placeholder="Phone Number" required>
                            </div>
                            <div class="mb-4">
                                <div class="form-check">
                                    <input type="checkbox" name="checkbox" class="form-check-input" required>
                                    <label class="form-check-label text-muted">
                                        I agree to all Terms & Conditions
                                    </label>
                                </div>
                            </div>
                            <div class="mt-3 d-grid gap-2">
                                <button class="btn btn-gradient-primary me-2" type="submit" name="submit">
                                    BUY
                                </button>
                            </div>
                            
                            <div  id="forms">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="auth-link text-primary" href="order_table.php">Show Orders</a>
                  </li>
                </ul>
              </div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
<script src="../../assets/js/off-canvas.js"></script>
<script src="../../assets/js/misc.js"></script>
<script src="../../assets/js/settings.js"></script>
<script src="../../assets/js/todolist.js"></script>
<script src="../../assets/js/jquery.cookie.js"></script>
</body>
</html>