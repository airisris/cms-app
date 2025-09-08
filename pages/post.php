<?php
  // check if the user is not an admin
  
  // connect to database
  $database = connectToDB();

  // get id from GET
  $id = $_GET["id"];

  $sql = "SELECT 
            posts.*, users.name
            FROM posts 
            JOIN users
            ON posts.user_id = users.id
            WHERE posts.id = :id";
  // 2.2
  $query = $database->prepare( $sql );
  // 2.3
  $query->execute([
    "id" => $id
  ]);
  // 2.4
  $post = $query->fetch();
?>
<?php require "parts/header.php"; ?>

    <div class="container mx-auto my-5" style="max-width: 500px;">
      <h1 class="h1 mb-4 text-center"><?= $post["title"]; ?></h1>
      <h4 class="text-center">By <?= $post["name"]; ?></h4>
      <div class="mb-2">
        <img src="<?= $post["image"]; ?>" class="img-fluid"/>
      </div>
      <?php
        /*
          $content = "1,2,3,4,5";
          $content_array = explode(",", $content);
          $content_array = ( 1,2,3,4,5 );
        */
        // $content = $posts["content"];
        // $content_array = explode("\n", $content);
        // foreach($content_array as $paragraph){
        //   echo "<p>$paragraph</p>";
        // }

        echo nl2br($post["content"]);
      ?>
      <div class="text-center mt-3">
        <a href="/home" class="btn btn-link btn-sm"
          ><i class="bi bi-arrow-left"></i> Back</a
        >
      </div>
    </div>

<?php require "parts/footer.php"; ?>