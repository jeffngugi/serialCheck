
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MAIN NAVIGATION</li>
          <li class="nav-item">
            <a href="{{ url('/dashboard') }}" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview ">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Codes
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            @if(Auth::user()->role_id < 2)
              <li class="nav-item">
                <a href="{{ url('/serials') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Generate</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{ url('/assign') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Assign</p>
                </a>
              </li>
              @endif
              <li class="nav-item">
                <a href="{{ url('/print') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print</p>
                </a>
              </li>
              
            </ul>
          </li>
          @if(Auth::user()->role_id <= 2)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              
              <li class="nav-item">
                <a href="{{ url('users') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('users/create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create User</p>
                </a>
              </li>             
              
              
            </ul>
          </li>
          @if(Auth::user()->role_id < 2)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('roles') }}"class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('roles/create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create</p>
                </a>
              </li>
              
            </ul>
          </li>
          @endif
          @endif
         
         
         
         
          
         
          
 
       
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li>
        