<!-- Modal -->
<div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signupModalLabel">Signup for iForum account </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/php-projects/forum/partials/_handleSignup.php" method="post">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Username</label>
                        <!-- <input type="email" class="form-control" id="signupEmail" name ="signupEmail" aria-describedby="emailHelp"> -->
                        <input type="text" class="form-control" id="signupEmail" name ="signupEmail" aria-describedby="emailHelp">
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword " name="signupPassword">
                    </div>
                    <div class="mb-3">
                        <label for="cpassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="signupCpassword" name="signupCpassword">
                    </div>
                    <button type="submit" class="btn btn-primary">SignUp</button>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </form>
        </div>
    </div>
</div>