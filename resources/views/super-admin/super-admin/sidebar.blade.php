<div class="left side-menu">
  <div class="slimscroll-menu" id="remove-scroll">
    <!--- Sidemenu -->
    <div id="sidebar-menu">
      <!-- Left Menu Start -->
      <ul class="metismenu" id="side-menu">
        <li class="menu-title">Main</li>
          <li>
              <a href="{{route('superAdmin')}}" class="waves-effect"> <!-- <span class="badge badge-primary badge-pill float-right">2</span> -->  <span> Dashboard </span>
              </a>
          </li>
        <li> <a href="{{route('role_status')}}" class="waves-effect"><span> Role Management </span></a>
        </li>
        <li> <a href="javascript:void(0);" class="waves-effect"><span> Teams <span class="float-right menu-arrow"></span> </span></a>
          <ul class="submenu">
            <li> <a href="{{route('allteam')}}" class="waves-effect">All Team </a>
            </li>
            <li><a href="{{route('create_team')}}"> Create Team</a>
            </li>
          </ul>
        </li>

        <li> <a href="javascript:void(0);" class="waves-effect"><span> Quiz <span class="float-right menu-arrow"></span> </span></a>
          <ul class="submenu">
             <!-- <li> <a href="{{route('addQuiz')}}" class="waves-effect">Add Quiz</a></li>  -->
             <li> <a href="{{route('allQuiz')}}" class="waves-effect">All Quiz</a></li>
            <!--  <li> <a href="{{route('allQuestion')}}" class="waves-effect">All Question</a></li>
            <li> <a href="{{route('addQuestion')}}" class="waves-effect">Add Question</a></li> -->

          </ul>
        </li>

        <li> <a href="/add_role" class="waves-effect"><span> Add Role </span></a>
        </li>
        <li> <a href="javascript:void(0);" class="waves-effect"><span> Users <span class="float-right menu-arrow"></span> </span></a>
          <ul class="submenu">
            <li> <a href="/add_user" class="waves-effect">Add User</a>
            </li>
            <li><a href="/all_users">All Users</a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- Sidebar -->
    <div class="clearfix"></div>
  </div>
  <!-- Sidebar -left -->
</div>