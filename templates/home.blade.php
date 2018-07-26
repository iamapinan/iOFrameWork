@include('header')
<div class="container-fluid content-wrap" id="root">
    <div class="row align-items-center justify-content-center">
        <div class="col-4 align-self-center text-center">
            <div class="alert alert-danger login-faiil hide" role="alert">
            </div>
            <form class="form-signin" id="signin" method="post">
                <p align="center">Interactive Learning</p>
                <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
                <label for="inputEmail" class="sr-only">Email address</label>
                <input type="email" id="inputEmail" name="username" class="form-control" placeholder="Email address" required autofocus>
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <div class="checkbox my-2 text-left">
                    <label><input type="checkbox" value="remember-me"> Remember me</label>
                </div>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                <p class="mt-5 mb-3 text-muted">&copy; {{date('Y')}}</p>
            </form>

        </div>
    </div>
</div>
@include('footer')