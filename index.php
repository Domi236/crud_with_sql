<?php
// Show PHP errors
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

require_once 'classes/user.php';

$objUser = new User();

// GET
if(isset($_GET['delete_id'])){
  $id = $_GET['delete_id'];
  try{
    if($id != null){
      if($objUser->delete($id)){
        $objUser->redirect('index.php?deleted');
      }
    }else{
      var_dump($id);
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
        <?php require_once 'includes/head.php'; ?>
    </head>
    <body>
        <!-- Header banner -->
        <?php require_once 'includes/header.php'; ?>
        <div class="container-fluid">
            <div class="row">
                <!-- Sidebar menu -->
                <?php require_once 'includes/sidebar.php'; ?>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 mt-4">
                    <?php
                      if(isset($_GET['updated'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>User!<trong> Updated with success.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['deleted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>User!<trong> Deleted with success.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['inserted'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>User!<trong> Inserted with success.
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }else if(isset($_GET['error'])){
                        echo '<div class="alert alert-info alert-dismissable fade show" role="alert">
                        <strong>DB Error!<trong> Something went wrong with your action. Try again!
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true"> &times; </span>
                          </button>
                        </div>';
                      }
                    ?>
                    <h2 class="mt-4">Kontaktdaten</h2>
                      <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                              <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Telefon</th>
                                <th></th>
                              </tr>
                            </thead>
                            <?php
                              $query = "SELECT * FROM df_users";
                              $stmt = $objUser->runQuery($query);
                              $stmt->execute();
                            ?>
                            <tbody>
                                <?php if($stmt->rowCount() > 0){
                                  while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                                 ?>
                                 <tr>
                                    <td><?php print($rowUser['id']); ?></td>

                                    <td>
                                      <a href="form.php?edit_id=<?php print($rowUser['id']); ?>">
                                      <?php print($rowUser['name']); ?>
                                      </a>
                                    </td>

                                    <td><?php print($rowUser['email']); ?></td>

                                    <td><?php print($rowUser['phone']); ?></td>

                                    <td>
                                      <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>">
                                      <span data-feather="trash"></span>
                                      </a>
                                    </td>
                                 </tr>


                          <?php } } ?>
                            </tbody>
                        </table>

                      </div>

                    <h2 class="mt-4">Zugangsdaten</h2>

                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Typ</th>
                                <th>Role</th>
                                <th>User</th>
                                <th>Password</th>
                                <th>Url/Database</th>
                                <th></th>
                            </tr>
                            </thead>
                            <?php
                            $query = "SELECT * FROM df_enviroment";
                            $stmt = $objUser->runQuery($query);
                            $stmt->execute();
                            ?>
                            <tbody>
                            <?php if($stmt->rowCount() > 0){
                                while($rowUser = $stmt->fetch(PDO::FETCH_ASSOC)){
                                    ?>
                                    <tr>
                                        <td><?php print($rowUser['id']); ?></td>

                                        <td><?php print($rowUser['typ']); ?></td>

                                        <td><?php print($rowUser['role']); ?></td>

                                        <td><?php print($rowUser['user']); ?></td>

                                        <td><?php print($rowUser['password']); ?></td>

                                        <td><?php print($rowUser['adress']); ?></td>

                                        <td>
                                            <a class="confirmation" href="index.php?delete_id=<?php print($rowUser['id']); ?>">
                                                <span data-feather="trash"></span>
                                            </a>
                                        </td>
                                    </tr>


                                <?php } } ?>
                            </tbody>
                        </table>

                    </div>


                </main>
            </div>
        </div>
        <!-- Footer scripts, and functions -->
        <?php require_once 'includes/footer.php'; ?>

        <!-- Custom scripts -->
        <script>
            // JQuery confirmation
            $('.confirmation').on('click', function () {
                return confirm('Are you sure you want do delete this user?');
            });
        </script>
    </body>
</html>
