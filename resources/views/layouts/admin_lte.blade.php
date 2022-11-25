<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('page_title', 'AdminPanel | Ahyad')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/bootstrap/css/bootstrap.min.css') }}">
  @if(App::getLocale() == 'ar')
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/bootstrp-rtl/css/bootstrap-flipped.min.css') }}">
  @endif
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/ionicons/css/ionicons.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/iCheck/all.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/jvectormap/jquery-jvectormap-1.2.2.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/datepicker/datepicker3.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/daterangepicker/daterangepicker.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/bootstrap-fileinput/css/fileinput.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css') }}">
  <!-- include the core styles -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/alertify/themes/alertify.core.css') }}" />
  <!-- include a theme, can be included into the core instead of 2 separate files -->
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/alertify/themes/alertify.default.css') }}" />

  @if(App::getLocale() == 'ar')
  <link rel="stylesheet" href="{{ asset('admin-lte/css/AdminLTE-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/css/skins/_all-skins-rtl.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin-lte/lib/bootstrap-fileinput/css/fileinput-rtl.min.css') }}">
  @else
  <link rel="stylesheet" href="{{ asset('admin-lte/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('admin-lte/css/skins/_all-skins.min.css') }}">
  @endif

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  @yield('css-files')

  <link rel="stylesheet" href="{{ asset('admin-lte/css/custom.css') }}">

  @if(App::getLocale() == 'ar')
  <link rel="stylesheet" href="{{ asset('admin-lte/css/custom-rtl.css') }}">
  @endif

  <!-- jQuery 2.2.3 -->
  <script src="{{ asset('admin-lte/lib/jQuery/jquery-2.2.3.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('admin-lte/lib/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>
  <!-- Bootstrap 3.3.6 -->
  <script src="{{ asset('admin-lte/lib/bootstrap/js/bootstrap.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('admin-lte/lib/sparkline/jquery.sparkline.min.js') }}"></script>
  <!-- jvectormap -->
  <script src="{{ asset('admin-lte/lib/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
  <script src="{{ asset('admin-lte/lib/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('admin-lte/lib/knob/jquery.knob.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('admin-lte/lib/moment.min.js') }}"></script>
  <script src="{{ asset('admin-lte/lib/daterangepicker/daterangepicker.js') }}"></script>
  <!-- datepicker -->
  <script src="{{ asset('admin-lte/lib/datepicker/bootstrap-datepicker.js') }}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('admin-lte/lib/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
  <!-- Slimscroll -->
  <script src="{{ asset('admin-lte/lib/slimScroll/jquery.slimscroll.min.js') }}"></script>
  <script src="{{ asset('admin-lte/lib/bootstrap-switch/dist/js/bootstrap-switch.min.js') }}"></script>
  <!-- FastClick -->
  <script src="{{ asset('admin-lte/lib/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('admin-lte/lib/iCheck/icheck.min.js') }}"></script>
  <!-- ideally at the bottom of the page -->
  <!-- also works in the <head> -->
  <script src="{{ asset('admin-lte/lib/alertify/lib/alertify.min.js') }}"></script>

  <script src="{{ asset('admin-lte/lib/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
  @if(App::getLocale() == 'ar')
  <script src="{{ asset('admin-lte/lib/bootstrap-fileinput/js/locales/ar.js') }}"></script>
  @endif

  @yield('js-files')

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">AP</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin Panel</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              @if(Auth::user() && Auth::user()->avatar)
                <img src="{{ url('uploads/users/'.Auth::user()->avatar) }}" class="user-image" alt="User Image">
              @else
                <img src="{{ asset('admin-lte/img/user-icon.png') }}" class="user-image" alt="User Image">
              @endif
              <span class="hidden-xs">@if(Auth::user()) {{ ucfirst(Auth::user()->name) }} @endif</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                @if(Auth::user() && Auth::user()->avatar)
                  <img src="{{ url('uploads/users/'.Auth::user()->avatar) }}" class="img-circle" alt="User Image">
                @else
                  <img src="{{ asset('admin-lte/img/user-icon.png') }}" class="img-circle" alt="User Image">
                @endif

                <p>
                  @if(Auth::user()) {{ Auth::user()->group }} @endif
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{ url('admin/profile') }}" class="btn btn-default btn-flat">{{ __('adminlte.profile') }}</a>
                </div>
                <div class="pull-right">
                  <!-- a href="/logout" class="btn btn-default btn-flat">Sign out</a -->
                  <a href="{{ url('logout') }}" class="btn btn-default btn-flat"
                      onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                      {{ __('adminlte.logout') }}
                  </a>

                  <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                      {{ csrf_field() }}
                  </form>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::user() && Auth::user()->avatar)
            <img src="{{ url('uploads/users/'.Auth::user()->avatar) }}" class="img-rounded" alt="User Image">
          @else
            <img src="{{ asset('admin-lte/img/user-icon.png') }}" class="img-circle" alt="User Image">
          @endif
        </div>
        <div class="pull-left info">
          <p>@if(Auth::user()) {{ ucfirst(Auth::user()->name) }} @endif </p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php
        $admin_lang   = App::getLocale();
        $admin_menus  = config('admin_lte');

        function fetchSubMenu($menu, $admin_lang){
          $tags = '<li class="treeview">';
          $tags .= '<a href="'.url($menu['link']).'">'.$menu['icon'];
          $tags .= '<span>'.$menu['title'][$admin_lang].'</span>';
          $tags .= '<span class="pull-right-container">';
          $tags .= '<i class="fa fa-angle-left pull-right"></i>';
          $tags .= '</span></a><ul class="treeview-menu">';
          echo $tags;
              
              foreach($menu['submenu'] As $submenu){
                if(!empty($submenu['permission'])){
                  if(is_array($submenu['permission'])){
                    if(!array_intersect($submenu['permission'], Auth::user()->permissions))
                      continue;
                  }else{
                    if(!in_array($submenu['permission'], Auth::user()->permissions))
                      continue;
                  }

                }

                if(!empty($submenu['submenu'])){
                  fetchSubMenu($submenu, $admin_lang);
                }else{
                  echo '<li><a href="'.url($submenu['link']).'">'.$submenu['icon'].' '.$submenu['title'][$admin_lang].'</a></li>';
                }
              }
              
            echo '</ul></li>';
        }

        foreach($admin_menus As $menu){
          if(!empty($menu['permission'])){
            if(!Auth::user()->permissions)
              continue;

            if(is_array($menu['permission'])){
              if(!array_intersect($menu['permission'], Auth::user()->permissions))
                continue;
            }else{
              if(!in_array($menu['permission'], Auth::user()->permissions))
                continue;
            }

          }

          if(!empty($menu['submenu'])){
            fetchSubMenu($menu, $admin_lang);
          }else{
            ?>
            <li><a href="<?php echo url($menu['link']); ?>"><?php echo $menu['icon']; ?> <span><?php echo $menu['title'][$admin_lang]; ?></span></a></li>
            <?php
          }
        }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      @yield('content-header')
    </section>

    <!-- Main content -->
    <section class="content">@yield('content')</section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.3
    </div>
    <strong>Copyright &copy; 2018 <a href="http://ahyad.com">Ahyad Essam</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- AdminLTE App -->
<script src="{{ asset('admin-lte/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('admin-lte/js/demo.js') }}"></script>

<script>
$('input[type=file]').not('.custom-file').each(function(){
  if($(this).attr('data-img') != undefined && $(this).attr('data-img') != ''){
    $(this).fileinput({
      'hiddenThumbnailContent':true,
      'showUpload':false,
      minFileCount: 0,
      maxFileCount: 1,
      @if(App::getLocale() == 'ar')
        'language': 'ar',
      @endif
      initialPreview: [$(this).attr('data-img')],
      initialPreviewAsData: true,
      initialPreviewFileType: 'image'
    });
  }else{
    $(this).fileinput({
      'hiddenThumbnailContent':true,
      'showUpload':false,
      minFileCount: 0,
      @if(App::getLocale() == 'ar')
      'language': 'ar',
      @endif
      maxFileCount: 1
    });
  }
});

$(".switch").bootstrapSwitch();

$('.datepicker').datepicker({
  autoclose: true,
  format: 'yyyy-mm-dd'
});
</script>

@yield('javascript')

</body>
</html>
