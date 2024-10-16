<?php
session_start();
include('assets/inc/config.php'); // Include configuration file

if (isset($_POST['doc_login'])) {
    $doc_number = $_POST['doc_number'];
    $doc_pwd = $_POST['doc_pwd']; // No hashing here, use plaintext

    // Prepare the SQL statement with correct column names
    $stmt = $mysqli->prepare("SELECT doctor_number, password, id FROM doctors WHERE doctor_number=? AND password=?");
    $stmt->bind_param('ss', $doc_number, $doc_pwd); // Bind parameters
    $stmt->execute(); // Execute the prepared statement
    $stmt->bind_result($doc_number, $hashed_pwd, $doc_id); // Bind result variables
    $rs = $stmt->fetch(); // Fetch the result

    if ($rs) {
        // Successful login
        $_SESSION['doc_id'] = $doc_id;
        $_SESSION['doc_number'] = $doc_number; // Store doctor number in session
        header("location:his_doc_dashboard.php"); // Redirect to dashboard
    } else {
        $err = "Access Denied Please Check Your Credentials"; // Error message
    }
}
?>

<!--End Login-->
<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="utf-8" />
    <title>Hospital Management System - A Super Responsive Information System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="MartDevelopers" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- App css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- Load Sweet Alert Javascript -->
    <script src="assets/js/swal.js"></script>
    <!-- Inject SWAL -->
    <?php if (isset($success)) { ?>
        <script>
            setTimeout(function () { 
                swal("Success", "<?php echo $success; ?>", "success");
            }, 100);
        </script>
    <?php } ?>

    <?php if (isset($err)) { ?>
        <script>
            setTimeout(function () { 
                swal("Failed", "<?php echo $err; ?>", "error");
            }, 100);
        </script>
    <?php } ?>
</head>

<body class="authentication-bg authentication-bg-pattern">
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-pattern">
                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <a href="index.php">
                                    <span><img src="assets/images/logo-dark.png" alt="" height="22"></span>
                                </a>
                                <p class="text-muted mb-4 mt-3">Enter your doctor number and password to access the Doctor panel.</p>
                            </div>

                            <form method='post'>
                                <div class="form-group mb-3">
                                    <label for="emailaddress">Doctor Number</label>
                                    <input class="form-control" name="doc_number" type="text" id="emailaddress" required="" placeholder="Enter your doctor number">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" name="doc_pwd" type="password" required="" id="password" placeholder="Enter your password">
                                </div>

                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-success btn-block" name="doc_login" type="submit"> Log In </button>
                                </div>
                            </form>
                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                    <div class="row mt-3">
                        <div class="col-12 text-center">
                            <p> <a href="his_doc_reset_pwd.php" class="text-white-50 ml-1">Forgot your password?</a></p>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <?php include("assets/inc/footer1.php"); ?>

    <!-- Vendor js -->
    <script src="assets/js/vendor.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.min.js"></script>
    
</body>

</html>
