<?php
include 'includes/header-l.php';
include 'classes/User.php';
include 'classes/Database.php';
$config = include 'util/dsn.php';
?>
<?php
$msg ="";
$db = new Database($config);
$dbc = $db->connectToDatabase();
session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $password = $_POST['psw'];

    if($username === 'admin' && $password === 'sudo'){
        $_SESSION['username'] = $username;
        header('Location: admin/adminDashboard.php');
        exit;
    }
    if($user = User::loadByCredentials($username,$password,$db)){
        $_SESSION['username'] = $username;
        $_SESSION['user'] = $user;
        header('Location: user/userDashboard.php');
        exit;

    }else{
        $msg = "Credenziali errate";
    }
}

?>

<div id="loginPage" class="container-md d-flex justify-content-center align-items-center vh-100">
    <div class="row w-100">
        <div class="col-md-4 mx-auto p-4 border rounded shadow">
            <h2 class="text-center mb-4">Login</h2>
            <form method="POST" action="login.php">
                <div class="form-group mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" id="username" class="form-control" placeholder="Inserisci l'username" name="username" required>
                </div>

                <div class="form-group mb-3">
                    <label for="psw" class="form-label">Password:</label>
                    <input type="password" id="psw" class="form-control" placeholder="Inserire la password" name="psw" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
                <span class="text-bg-danger fs-4 "><?php echo $msg ?></span>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
