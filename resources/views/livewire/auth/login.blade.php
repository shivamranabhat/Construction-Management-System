<div class="main-signup-header">
    <h3>Welcome back!</h3>
    <h6 class="fw-medium mb-4 fs-17">Please sign in to continue.</h6>
    <form wire:submit='login'>
        <div class="form-group mb-3"> <label class="form-label">Email</label>
            <input class="form-control" wire:model='email' placeholder="Enter your email" type="text">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group mb-3"> <label class="form-label">Password</label>
            <input class="form-control" wire:model='password' placeholder="Enter your password" type="password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div> <button type='submit' class="btn btn-primary btn-block w-100">Sign In <x-spinner /></button>
        <div class="row mt-3 px-3">
            <div class="col-12 btn d-flex justify-content-center align-items-end" style="border:1px solid rgb(145, 145, 145)"> <img src="{{asset('assets/images/google.png')}}" width='20' alt="Google"> <i class="fab fa-facebook-f me-2"></i>
                    Signin with
                    Google</button> </div>
        </div>
    </form>
    <div class="main-signin-footer mt-5">
        <p class="mb-1"><a href="forgot.html">Forgot password?</a></p>
        <p>Don't have an account? <a href="signup.html">Create an Account</a>
        </p>
    </div>
</div>