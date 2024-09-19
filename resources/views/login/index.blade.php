@if (session('admin'))
  <script>
    window.location="/admin/dashboard";
  </script>

@endif

@if (session('employee'))
  <script>
    window.location="/employee/dashboard";
  </script>

@endif

<!doctype html>
<html dir="ltr" lang="en">
  
<!-- Mirrored from softivuspro.com/html/dashhub/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jun 2024 07:15:46 GMT -->
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="asstes/images/favicon.html" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="stylesheet" href="{{url('assets/fonts/line-awesome/css/line-awesome.min.css')}}" />
    <link rel="stylesheet" href="{{url('assets/css/animate.min.css')}}" />
    <title>Login</title>
  <script defer src="{{url('index.js')}}"></script><link href="{{url('style.css')}}" rel="stylesheet">
<style>
  .error{
    color:red;
  }
</style>
</head>

  <body x-cloak x-data="customizer" :class="$store.app.isDarkMode?'dark':''">
    <!-- loader -->
    <!-- screen loader -->
<div x-cloak class="screen_loader animate__animated duration-700 fixed inset-0 z-[60] grid place-content-center bg-neutral-400">
  <div class="loader"></div>
</div>


    <!-- Main Content -->
    <main class="relative min-h-screen overflow-x-hidden flex items-center justify-center bg-neutral-0 dark:bg-neutral-904 py-12">
      <div class="h-screen absolute inset-0 overflow-hidden">
        <div class="absolute -top-8 -left-8 lg:-top-32 lg:-left-40 size-40 lg:size-[340px] rounded-full bg-secondary-300 opacity-[0.2] blur-[100px]"></div>
        <div class="absolute -top-8 -right-8 lg:-top-32 lg:-right-40 size-40 lg:size-[340px] rounded-full bg-error-300 opacity-[0.2] blur-[100px]"></div>
        <div class="absolute -right-8 -bottom-8 lg:-right-40 lg:-bottom-28 size-40 lg:size-[340px] rounded-full bg-info-300 opacity-[0.15] blur-[100px]"></div>
        <div class="absolute -left-8 -bottom-8 lg:-left-40 lg:-bottom-28 size-40 lg:size-[340px] rounded-full bg-warning-300 opacity-[0.15] blur-[100px]"></div>
      </div>

      <div class="container overflow-y-auto">
        <div class="grid grid-cols-12 gap-4 xxl:gap-6 items-center relative z-[4] text-neutral-700 dark:text-neutral-20">
          <div class="col-span-12 lg:col-span-6 xxl:col-span-5">
            <h3 class="mb-4 xl:mb-6">Welcome Back!</h3>
            <p class="mb-7 xl:mb-10">Sign in to your account and join us</p>
            <form class="" id="loginForm">
              <input type="hidden" id="url" value="/login">
              <input type="hidden" id="method" value="POST">
              <input type="hidden" id="btnName" value="Login">
              {{@csrf_field()}}
              <div class="form-input mb-4 xl:mb-6">
                <input type="text" name="email" id="email" class="!rounded-full" placeholder="Enter Email" required />
                <label for="email">Email Address</label>
              </div>
              <div x-data="{showPass: false}" class="form-input rounded-3xl">
                <input :type="showPass?'text':'password'" id="pass2" class="!rounded-full" name="password" placeholder="Textfield" required/>
                <label for="pass2">Password</label>
                <span @click="showPass = !showPass" class="absolute ltr:right-5 rtl:left-5 top-1/2 flex size-8 -translate-y-1/2 cursor-pointer items-center justify-center rounded-full duration-300 hover:bg-neutral-40 dark:hover:bg-neutral-700">
                  <i x-show="showPass" class="las la-eye text-xl"></i>
                  <i x-show="!showPass" class="las la-eye-slash text-xl"></i>
                </span>
              
              </div>
              <div class="flex justify-start mt-2 mb-5">
                {{-- <label for="">Employee</label>
                <input type="radio" name="type" value="employee">
                <input type="radio" name="type" value="admin"> --}}

                <label for="switch" class="switch flex" style="margin-left: 15px;">
                    <input  id="switch" type="checkbox" name="adminOrEmployee" />Employee
                    <span class="inner primary"></span>
                    Admin
                  </label>
              </div>
           
              <button type="submit" class="btn-primary w-full" id="btn">Login</button>
            </form>
          </div>
          <div class="col-span-12 lg:col-span-6 xxl:col-start-7 flex justify-center">
            <div class="size-72 sm:size-[450px] xxl:size-[636px] rounded-full bg-neutral-30 dark:bg-neutral-700 flex items-center justify-center">
              <img src="{{url('assets/images/login-1.png')}}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="{{url('assets/js/libs/alpine.collapse.js')}}"></script>
    <script src="{{url('assets/js/libs/alpine.persist.js')}}"></script>
    <script defer src="{{url('assets/js/libs/alpine.min.js')}}"></script>
    <script src="{{url('assets/js/main.js')}}"></script>

   <script src="{{url('/projectJs/jquery.js')}}"></script>
   <script src="{{url('/projectJs/form_validation.js')}}"></script>
   <script src="{{url('/projectJs/sweetalert.js')}}"></script>
   <script src="{{url('/projectJs/form.js')}}"></script>

  </body>

<!-- Mirrored from softivuspro.com/html/dashhub/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 12 Jun 2024 07:15:47 GMT -->
</html>
