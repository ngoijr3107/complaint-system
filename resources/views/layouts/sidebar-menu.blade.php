<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <router-link to="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-home"></i>
          <p>
            Dashboard
          </p>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link to="/complaints" class="nav-link">
          <i class="nav-icon far fa-comment-alt"></i>
          <p>
            Complaints
          </p>
        </router-link>
      </li>

      @can('isAdmin')
        <li class="nav-item">
          <router-link to="/users" class="nav-link">
            <i class="fa fa-users nav-icon"></i>
            <p>Users</p>
          </router-link>
        </li>
      @endcan
      
      @can('isAdmin')
      <li class="nav-item has-treeview">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-cog"></i>
          <p>
            Settings
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item">
            <router-link to="/department" class="nav-link">
              <i class="nav-icon fas fa-list-ol"></i>
              <p>
                Departments
              </p>
            </router-link>
          </li>
          <li class="nav-item">
            <router-link to="/site" class="nav-link">
              <i class="nav-icon far fa-compass"></i>
              <p>
                Sites
              </p>
            </router-link>
          </li>
          
        </ul>
      </li>

      @endcan
      
      <li class="nav-item">
        <a href="#" class="nav-link" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();">
          <i class="nav-icon fas fa-power-off red"></i>
          <p>
            {{ __('Logout') }}
          </p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
      </li>
    </ul>
  </nav>