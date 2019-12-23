<!DOCTYPE html>
<html lang="en">

<head>
  <title>Management</title>
  <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/icons.css') }}" rel="stylesheet">
  <link href="{{ asset('css/metisMenu.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/manager.css') }}" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/croppie.css') }}" rel="stylesheet">
  <script src="{{ asset('js/croppie.js') }}"></script>
</head>

<body>
  <div id="wrapper">
    <!-- Top Bar Start -->
    <div class="topbar">
      <!-- LOGO -->
      <div class="topbar-left">
        <a href="index.html" class="logo"> <span class="logo-light">
          <img src="{{ asset('images/logo-light.png') }}" alt="" height="16"></span>
          <span class="logo-sm">
            <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
          </span>
        </a>
      </div>
      <nav class="navbar-custom">
        <ul class="navbar-right list-inline float-right mb-0">
          <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <form role="search" class="app-search">
              <div class="form-group mb-0">
                <input type="text" class="form-control" placeholder="Search..">
                <button type="submit"></button>
              </div>
            </form>
          </li>
          <!-- language-->
          <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a class="nav-link dropdown-toggle arrow-none waves-effect" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
              <?php $user_id=session()->get('user_id'); $image = App\User::where('id',$user_id)->first('image'); ?>
              <img src="{{ asset('image/') }}/{{$image->image}}" class="mr-2 rounded-circle" alt="" / height="50px" width="50px">
              </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right language-switch"> <a class="dropdown-item" href="{{route('logout')}}">Log Out</a>
            </div>
          </li>
          <!-- full screen -->
          <li class="dropdown notification-list list-inline-item d-none d-md-inline-block">
            <a class="nav-link waves-effect" href="#" id="btn-fullscreen"></a>
          </li>
        </ul>
      </nav>
    </div>
  </div>@include('manager.manager.sidebar') @yield('dashboard_content')</body>
<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/easyNotify.js') }}"></script>
<script src="{{ asset('js/manager.js') }}"></script>
<script src="{{ asset('js/select2.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.11/jquery-ui.min.js"></script>
<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('js/metisMenu.min.js') }}"></script>
<script src="{{ asset('js/jquery.slimscroll.js') }}"></script>
<script src="{{ asset('js/waves.min.js') }}"></script>
<script src="{{ asset('js/app1.js') }}"></script>

</html>