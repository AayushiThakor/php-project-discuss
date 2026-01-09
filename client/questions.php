<div class="container">
    <div class="row">
        <div class="col-8">
            <h1 class="heading">Questions</h1>

            <?php
            include("./common/db.php");

            if (isset($_GET['c-id'])) {
                $cid = (int) $_GET['c-id'];
                $query = "SELECT * FROM questions WHERE category_id = $cid";

            } else if (isset($_GET['u-id'])) {
                $uid = (int) $_GET['u-id'];
                $query = "SELECT * FROM questions WHERE user_id = $uid";

            } else if (isset($_GET['latest'])) {

                $query = "SELECT * FROM questions order by id desc";

            } else if (isset($_GET['search'])) {

                $query = "SELECT * FROM questions WHERE `title` LIKE '%$search%' ";

            } else {
                $query = "SELECT * FROM questions";
            }

            $result = $conn->query($query);

            foreach ($result as $row) {
                $title = $row['title'];
                $id = $row['id'];

                echo "<div class='row question-list'>
            <h4 class='my-question'>
                <a href='?q-id=$id'>$title</a>";


                if (isset($_SESSION['user'])) {
                    echo " <a href='./server/requests.php?delete=$id' class='text-danger'>Delete</a>";
                }

                echo "</h4>
          </div>";
            }

            ?>

        </div>
        <div class="col-4">
            <?php
            include('categorylist.php');
            ?>
        </div>

    </div>
</div>