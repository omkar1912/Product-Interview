@extends('layouts.reg-auth')

@section('content')
<form class="col-lg-6 col-md-8 col-10 mx-auto">
    <div class="mx-auto text-center my-4">
      <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
        <svg version="1.1" id="logo" class="navbar-brand-img brand-md" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 120 120" xml:space="preserve">
          <g>
            <polygon class="st0" points="78,105 15,105 24,87 87,87 	" />
            <polygon class="st0" points="96,69 33,69 42,51 105,51 	" />
            <polygon class="st0" points="78,33 15,33 24,15 87,15 	" />
          </g>
        </svg>
      </a>
      <h2 class="my-3">Register</h2>
    </div>
    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <input type="email" class="form-control" id="inputEmail4">
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="firstname">Firstname</label>
        <input type="text" id="firstname" class="form-control" name="first_name">
      </div>
      <div class="form-group col-md-6">
        <label for="lastname">Lastname</label>
        <input type="text" id="lastname" class="form-control" name="last_name">
      </div>
    </div>
    <hr class="my-4">
    <div class="row mb-4">
      <div class="col-md-6">
        <div class="form-group">
          <label for="inputPassword5">New Password</label>
          <input type="password" class="form-control" id="inputPassword5" name="password">
        </div>
        <div class="form-group">
          <label for="inputPassword6">Confirm Password</label>
          <input type="password" class="form-control" id="inputPassword6" name="c_password">
        </div>
      </div>
      <div class="col-md-6">
        <p class="mb-2">Password requirements</p>
        <p class="small text-muted mb-2"> To create a new password, you have to meet all of the following requirements: </p>
        <ul class="small text-muted pl-4 mb-0">
          <li> Minimum 8 character </li>
          <li>At least one special character</li>
          <li>At least one number</li>
          <li>Can’t be the same as a previous password </li>
        </ul>
      </div>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit" id="register-button">Sign up</button>
    <p class="mt-5 mb-3 text-muted text-center">© 2020</p>
  </form>
@endsection
@section('scripts')
    <script src="{{asset('assets-admin/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets-admin/js/popper.min.js')}}"></script>
    <script src="{{asset('assets-admin/js/moment.min.js')}}"></script>
    <script src="{{asset('assets-admin/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets-admin/js/simplebar.min.js')}}"></script>
    <script src='{{asset('assets-admin/js/daterangepicker.js')}}'></script>
    <script src='{{asset('assets-admin/js/jquery.stickOnScroll.js')}}'></script>
    <script src="{{asset('assets-admin/js/tinycolor-min.js')}}"></script>
    <script src="{{asset('assets-admin/js/config.js')}}"></script>
    <script src="{{asset('assets-admin/js/apps.js')}}"></script>
    <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
    </script>
    {{-- <script src="{{ asset('assets-admin/js/register.js') }}"></script> --}}
    <script>
        $(document).ready(function(){
            console.log(123);
            $("#register-button").click(function(e){
                e.preventDefault();
                const formdata = $(this);
                const submitButton = $("#register-button");

                submitButton.html('Saving....<i class="fa fa-spin fa-spinner" aria-hidden="true"></i>');

                $.ajax({
                    method : "POST",
                    url : '/api/register',
                    data : formdata.serialize(),
                    success : (result) => {
                        console.log(result);
                    },
                    error : (error)=>{
                        console.log(error);
                    }
                })
            });
        });

    </script>
@endsection
