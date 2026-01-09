<div class="container">
    <h1 class="heading">Login</h1>
    <form action="./server/requests.php" method="post">
       
        <div class="col-6 offset-3 mb-3" margin-bottom-20>
            <label for="email" class="form-label" >User Email</label>
            <input type="text" class="form-control" name="email" id="email" placeholder="Enter user Email">
        </div>

        <div class="col-6 offset-3 mb-3" margin-bottom-20> 
            <label for="password" class="form-label">User Password</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Enter user Password">
        </div>


        <div class="col-6 offset-3 mb-3" margin-bottom-20>
        <button type="submit"  name="login" class="btn btn-primary">Login</button>
        </div>
        
</form>
</div>