<div class="container">
    <h1 class="heading">Ask a Question</h1>
    <form action="./server/requests.php" method="post">
       
        <div class="col-6 offset-3 mb-3" margin-bottom-20>
            <label for="title" class="form-label" >Title</label>
            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Question">
        </div>

        <div class="col-6 offset-3 mb-3" margin-bottom-20>
            <label for="description" class="form-label" >Description</label>
            <textarea type="description" class="form-control" name="description" 
              id="description" placeholder="Enter Question"></textarea>
        </div>

        <div class="col-6 offset-3 mb-3" margin-bottom-20>
            <label for="category" class="form-label">Category</label>
            <?php 
                include("category.php");
             ?>
        </div>
        <div class="col-6 offset-3 mb-3" margin-bottom-20>
        <button type="submit"  name="ask" class="btn btn-primary">Ask Question</button>
        </div>
        
</form>
</div>