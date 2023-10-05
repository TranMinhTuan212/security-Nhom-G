<?php
// Start the session
session_start();
require_once 'models/UserModel.php';
$userModel = new UserModel();

$user = NULL; //Add new user
$_id = NULL;

if (!empty($_GET['id'])) {
    $_id = $_GET['id'];
    $user = $userModel->findUserById($_id);//Update existing user
}
$result = false;

if (!empty($_POST['submit'])) {

    if (!empty($_id)) {
        $user = $userModel->updateUser($_POST);
        if($user){
            $result = true;
        }
    } else {
        $userModel->insertUser($_POST);
    }
    if($result){
        header('location: list_users.php');
    }else{
        
        header('location: list_users.php?result=true');
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>User form</title>
    <?php include 'views/meta.php' ?>
    
</head>
<body>
    <?php include 'views/header.php'?>
    <div class="container">

            <?php if ($user || !isset($_id)) { ?>
                <div class="alert alert-warning" role="alert">
                    User form
                </div>
                <form method="POST">
                    <input type="hidden" name="version" value="<?php echo $user[0]['version'] ?>">
                    <input type="hidden" name="id" value="<?php echo $_id ?>">
                    <div class="form-group">
                        <label for="name">Toán</label>
                        <input class="form-control" name="name" placeholder="Name" value='<?php echo $user[0]['name'] ?>'>
                    </div>
                    <div class="form-group">
                        <label for="full-name">Lý</label>
                        <input class="form-control" name="full-name" placeholder="FullName" value='<?php echo $user[0]['fullname'] ?>'>
                    </div>
                    <div class="form-group">
                        <label for="type">Hóa</label>
                        <input class="form-control" name="type" placeholder="Type" value='<?php echo $user[0]['type'] ?>'>
                    </div>

                    <button type="submit" name="submit" value="submit" class="btn btn-primary">Submit</button>
                </form>
            <?php } else { ?>
                <div class="alert alert-success" role="alert">
                    User not found!
                </div>
            <?php } ?>
    </div>
</body>
</html>