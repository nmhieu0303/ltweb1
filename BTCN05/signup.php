

<?php 
  require_once 'init.php';
    // Xử lý logic ở đây

  $title = "Sign Up";
    if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['email'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        

        $content = file_get_contents('./data.json');
        $users = json_decode($content,true) ;

        $user = findUserByUsername($username);
        if($user){
            $error = 'user already exists!';
        }
        else{
            //Assign the user to session
            $user = array(
                'username' => $username,
                'password' => $password,
            );
            array_push($users,$user);
            file_put_contents('./data.json',json_encode($users));

            $_SESSION['username'] = $user['username'];
            $_SESSION['password'] = $user['password'];
            header('Location: index.php');
            exit();
        }

    }
?>
<?php include 'header.php'; ?>

<?php if(isset($error)):?>
    <div class="alert alert-danger" role="alert">
    <?php echo $error;?>
    </div>
<?php else: ?>

<form action="signup.php" method="POST">
    <div class="form-group">
        <label>Username</label>
        <input type="text" class="form-control" name="username" required>
    </div>
    <div class="form-group">
        <label>Password</label> 
        <input type="password" class="form-control" name="password" required>
    </div>
    <div class="form-group">
        <label>Email</label> 
        <input type="email" class="form-control" name="email" required>
    </div>
    <div class = "mt-4 text-right "><a href="login.php">Login</a></div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <div class = "mt-4"><small>&copy; 2020 Nguyễn Minh Hiếu</small></div>
</form>
</div>
<?php endif; ?>

<?php include 'footer.php'; ?>