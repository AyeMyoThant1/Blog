
<?php require_once "../layout/header.php" ?>
<?php require_once "../layout/nav.php" ?>
<?php require_once "../layout/sidebar.php" ?>
<?php require_once "../db/database.php" ?>
<?php require_once "../db/token.php" ?>
<?php 
$user = json_decode($_COOKIE['user'], true);

if (!$user) {
  echo "<script> window.location.href = 'login.php';</script>";
}

?>
<main id="main" class="main">

  <div class="container">
    <div class="card">
      <div class="card-header">
        <a href="add.php" class="btn btn-primary">create new</a>
      </div>
      <div class="card-body">
        <table class="table-bordered table">
          <thead>
            <tr>
              <th>id</th>
              <th>title</th>
              <th>content</th>

              <th>action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = [];

              if(isset($_POST['search'])){
                $search = $_POST['search'];
                $sql = $pdo->prepare("SELECT * FROM post WHERE title LIKE '%$search%' OR context LIKE '%$search%'");
                 $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
              }else{
                $sql = $pdo->prepare("SELECT * FROM `post`");
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
              }
              echo  "<pre>";
              //die(var_dump($result));

            ?>
            <?php if ($result) {
              $i =1;
              foreach ($result as $post) {
            ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo escape($post['title']) ?></td>
                  <td><?php echo escape(substr($post['context'], 0, 20))  ?></td>
                  <td>
                    <a href="edit.php?id=<?php echo $post['id'] ?> " class="btn btn-primary">edit</a>
                    <a href="delete.php?id=<?php echo $post['id'] ?>"class="btn btn-danger"
                    onclick="return confirm('Are you sure to Delete   ?')">delete</a>
                  </td>
                </tr>
            <?php
              $i++;
            }
            } ?>

          </tbody>
        </table>
      </div>
          
    </div>
  </div>

</main>

<?php require_once "../layout/footer.php" ?>