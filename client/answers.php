<div class="container">
    <div class="">
        <h5>Answers:</h5>

        <?php 
            $query = "SELECT * FROM answers WHERE question_id = $qid";
            $result = $conn->query($query);

            foreach ($result as $row) {
                $answers = $row['answers'];
                echo "
                <div class='row'>
                    <p class='answer-wrapper'>$answers</p>
                </div>";
            }
        ?>
    </div>
</div>
