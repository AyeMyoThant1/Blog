<?php require_once "../layout/header.php" ?>
<?php require_once "../layout/nav.php" ?>
<?php require_once "../layout/sidebar.php" ?>
<?php require_once "../db/database.php" ?>

<?php
if (!isset($_SESSION['user'])) {
  header('location:login.php');
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
                $sql = $pdo->prepare("SELECT * FROM posts WHERE title LIKE '%$search%' OR content LIKE '%$search%'");
                 $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
              }else{
                $sql = $pdo->prepare("SELECT * FROM `posts`");
                $sql->execute();
                $result = $sql->fetchAll(PDO::FETCH_ASSOC);
              }

            ?>
            <?php if ($result) {
              $i =1;
              foreach ($result as $post) {
            ?>
                <tr>
                  <td><?php echo $i ?></td>
                  <td><?php echo $post['title'] ?></td>
                  <td><?php echo substr($post['content'], 0, 20)  ?></td>
                  <td>
                    <a href="edit.php?id=<?php echo $result[0]['id'] ?> " class="btn btn-primary">edit</a>
                    <a href="delete.php?id=<?php echo $result[0]['id'] ?>"class="btn btn-danger"
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