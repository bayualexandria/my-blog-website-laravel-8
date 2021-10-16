<div id="sidebar" class='active'>
      <div class="sidebar-wrapper active">
        <div class="sidebar-header text-center">
          <img src="{{ url('assets/images/web/logo-circle.png') }}" alt="" srcset="">
        </div>
        <div class="sidebar-menu">
          <ul class="menu">


            <li class='sidebar-title'>Main Menu</li>



            <li class="sidebar-item  ">
              <a href="{{ route('dashboard') }}" class='sidebar-link'>
                <i data-feather="home" width="20"></i>
                <span>Dashboard</span>
              </a>

            </li>




            <li class="sidebar-item  has-sub">
              <a href="#" class='sidebar-link'>
                <i data-feather="triangle" width="20"></i>
                <span>Master</span>
              </a>

              <ul class="submenu ">

                <li>
                  <a href="{{ route('blog') }}">Blogs</a>
                </li>

                <li>
                  <a href="{{ route('category') }}">Categories</a>
                </li>

              </ul>

            </li>

            <li class='sidebar-title'>Profile</li>



            <li class="sidebar-item">
              <a href="{{ route('profile') }}" class='sidebar-link'>
                <i data-feather="user" width="20"></i>
                <span>Profile</span>
              </a>

            </li>

             <li class="sidebar-item">
                 <form action="{{ route('logout') }}" method="post">
                     @csrf
                     <button type="submit" class="sidebar-link border-0 bg-white text-primary color-primary">
                         <i data-feather="log-out" width="20"></i>
                         <span>Logout</span>
                     </button>
                 </form>
                

             </li>

          </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
      </div>
</div>