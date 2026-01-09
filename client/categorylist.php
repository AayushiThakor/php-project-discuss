<div class="container">
    <h1 class="heading">Categories</h1>
    <?php 
        include('./common/db.php');

        $query = "SELECT * FROM category";
        $result = $conn->query($query);

        foreach ($result as $row) {
            $name = ucfirst($row['name']);
            $id= $row['id'];
            echo "  
            <div class='row'>
                <div class='row question-list'>
                    <h4><a href='?c-id=$id'> $name </a></h4>
                </div>
            </div>";
        }
    ?>
</div>
