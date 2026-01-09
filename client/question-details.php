<?php
include("./common/db.php");

/* ---------- GET QUESTION ID ---------- */
if (isset($_GET['q-id'])) {
    $qid = (int)$_GET['q-id'];
} else {
    die("Question ID missing");
}

/* ---------- FETCH QUESTION ---------- */
$query = "SELECT * FROM questions WHERE id = $qid";
$result = $conn->query($query);

if ($result->num_rows == 0) {
    die("Question not found");
}

$row = $result->fetch_assoc();
$category_id = $row['category_id'];
?>

<div class="container">
    <h1 class="heading">Questions</h1>

    <div class="row">
        <!-- LEFT SIDE -->
        <div class="col-8">
            <?php
            echo "<h4 class='margin-bottom-20 question-title'>
                    Question: {$row['title']}
                  </h4>
                  <p class='margin-bottom-20'>{$row['description']}</p>";

            include("answers.php");
            ?>

            <form action="./server/requests.php" method="post">
                <input type="hidden" name="question_id" value="<?php echo $qid; ?>">
                <textarea name="answer" class="form-control margin-bottom-20"
                    placeholder="Your answers......"></textarea>
                <button class="btn btn-primary">Write your answers</button>
            </form>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-4">
            
            <?php
            $categoryQuery = "SELECT name FROM category WHERE id = $category_id";
            $categoryResult = $conn->query($categoryQuery);

            if ($categoryResult && $categoryResult->num_rows > 0) {
                $categoryRow = $categoryResult->fetch_assoc();
                echo "<h1>" . ucfirst($categoryRow['name']) . "</h1>";
            }


            $query = "SELECT * FROM questions WHERE category_id = $category_id AND id != $qid";
            $result = $conn->query($query);

            if ($result->num_rows > 0) {
                foreach ($result as $row) {
                    $id = $row['id'];
                    $title = $row['title'];

                    echo "
                    <div class='question-list'>
                        <h4>
                            <a href='?q-id=$id'>$title</a>
                        </h4>
                    </div>";
                }
            } else {
                echo "<p>No related questions</p>";
            }
            ?>
        </div>
    </div>
</div>
