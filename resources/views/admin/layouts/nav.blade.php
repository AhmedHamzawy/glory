        <aside>
          <div class="sidebar left ">
            <div class="user-panel">
              <div class="pull-left image">
                <img src="http://via.placeholder.com/160x160" class="rounded-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                <p>bootstrap develop</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
            </div>
            <h3 class="menu-title">UI elements</h3>
            <ul class="list-sidebar bg-defoult">
                <li> <a href="#" data-toggle="collapse" data-target="#academic" class="collapsed active" > <i class="fa fa-th-large"></i> <span class="nav-label"> Academic </span> <span class="fa fa-chevron-left pull-right"></span> </a>
                <ul class="sub-menu collapse" id="academic">
                  <li class="active"><a href="{{ url('admin/rooms') }}">Rooms</a></li>
                  <li><a href="{{ url('admin/eduyears') }}">Eduyears</a></li>
                  <li><a href="{{ url('admin/subjects') }}">Subjects</a></li>
                  <li><a href="{{ url('admin/attendances') }}">Attendances</a></li>
                </ul>
              </li>
              <li> <a href="#" data-toggle="collapse" data-target="#timetables" class="collapsed active" > <i class="fa fa-bar-chart-o"></i> <span class="nav-label">TimeTables</span> <span class="fa fa-chevron-left pull-right"></span> </a>
              <ul class="sub-menu collapse" id="timetables">
                <li class="active"><a href="#">Timetables</a></li>
                <li><a href="#">Durations</a></li>
                <li><a href="#">Adding New</a></li>
              </ul>
            </li>
            
            <li> <a href="#" data-toggle="collapse" data-target="#assignments" class="collapsed active" ><i class="fa fa-shopping-cart"></i> <span class="nav-label">Assignments & Exams</span><span class="fa fa-chevron-left pull-right"></span></a>
              <ul  class="sub-menu collapse" id="assignments" >
                <li><a href="">Assignments</a></li>
                <li><a href="">Exams</a></li>
              </ul>
            </li>
            <li> <a href="#"><i class="fa fa-laptop"></i> <span class="nav-label">Books</span></a> </li>
            <li> <a href="#" data-toggle="collapse" data-target="#stuff" class="collapsed active" ><i class="fa fa-shopping-cart"></i> <span class="nav-label">Assignments & Exams</span><span class="fa fa-chevron-left pull-right"></span></a>
              <ul  class="sub-menu collapse" id="stuff" >
                <li><a href="{{ url('admin/users') }}"><i class="fa fa-files-o"></i> <span class="nav-label">Users</span></a> </li>
                <li><a href="">Teachers</a></li>
                <li><a href="">Students</a></li>
                <li><a href="">Workers</a></li>                
              </ul>
            </li>
            
            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Messages</span></a> </li>
            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Events</span></a> </li>
            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Blog</span></a> </li>
            <li> <a href="#"><i class="fa fa-files-o"></i> <span class="nav-label">Logactivity</span></a> </li>
      </ul>
      </div>
      </aside>
