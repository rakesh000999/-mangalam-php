<link rel="stylesheet" href="../bootstrap.min.css">
<script src="../bootstrap.bundle.min.js"></script>


<nav class="py-3 shadow">
    <h2 class="px-3">Mangalam</h2>
</nav>


<div class="card my-5 container" style="max-width: 500px;">

    <div class="card-body">
        <h4 class="card-title">Reset your password </h4>
        <hr>
        <form action="mail.php" method="POST" class="mt-3">
            <div class="form-group">
                <label for="email" class="form-label">Send code via email</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Email">
            </div>
            <input type="submit" name="send" value="Continue"
                class="bg-primary rounded text-white border-0 px-2 py-2 MY-3">
        </form>
    </div>
</div>