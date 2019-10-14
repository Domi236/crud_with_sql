<?php
require 'errors.php';

// enviroment
/*----------------------------------------------------------*/

require_once '../classes/enviroment.php';

$objEnviroment = new Enviroment();
// GET
if(isset($_GET['edit_id'])){
    $id = $_GET['edit_id'];
    $stmt = $objEnviroment->runQuery("SELECT * FROM df_enviroment WHERE id=:id");
    $stmt->execute(array(":id" => $id));
    $rowUser = $stmt->fetch(PDO::FETCH_ASSOC);
}else{
    $id = null;
    $rowUser = null;
}

// POST
if(isset($_POST['btn_save'])){
    $typ   = strip_tags($_POST['typ']);
    $role  = strip_tags($_POST['role']);
    $user  = strip_tags($_POST['user']);
    $password  = strip_tags($_POST['password']);
    $adress  = strip_tags($_POST['adress']);

    try{
        if($id != null){
            if($objUser->update($typ, $role, $user, $password, $adress, $id)){
                $objUser->redirect('index.php?updated');
            }
        }else{
            if($objUser->insert($typ, $role, $user, $password, $adress)){
                $objUser->redirect('index.php?inserted');
            }else{
                $objUser->redirect('index.php?error');
            }
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <!-- Head metas, css, and title -->
    <?php require_once '../includes/head.php'; ?>
</head>
<body>
<!-- Header banner -->
<?php require_once '../includes/header.php'; ?>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar menu -->
        <?php require_once '../includes/sidebar.php'; ?>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <h1 style="margin-top: 10px">Add / Edit Users</h1>
            <p>Required fields are in (*)</p>
            <form  method="post">
                <div class="form-group">
                    <label for="id">ID</label>
                    <input class="form-control" type="text" name="id" id="id" value="<?php print($rowUser['id']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="database">Typ</label>
                    <input  class="form-control" type="text" name="database" id="database" placeholder="database" value="<?php print($rowUser['typ']); ?>" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="role">Role</label>
                    <input  class="form-control" type="text" name="role" id="role" placeholder="admin" value="<?php print($rowUser['role']); ?>" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="user">User</label>
                    <input  class="form-control" type="number" name="user" id="user" placeholder="" value="<?php print($rowUser['user']); ?>" maxlength="20">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input  class="form-control" type="password" name="password" id="password" placeholder="" value="<?php print($rowUser['password']); ?>" maxlength="100">
                </div>
                <div class="form-group">
                    <label for="adress">Url/Database</label>
                    <input  class="form-control" type="text" name="adress" id="adress" placeholder="" value="<?php print($rowUser['adress']); ?>" maxlength="100">
                </div>
                <input class="btn btn-primary mb-2" type="submit" name="btn_save" value="Save">
            </form>
        </main>
    </div>
</div>
<!-- Footer scripts, and functions -->
<?php require_once '../includes/footer.php'; ?>
</body>
</html>
