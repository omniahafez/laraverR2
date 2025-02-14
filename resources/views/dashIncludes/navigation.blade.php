<div class="top_nav">
            <div class="nav_menu">
                <div class="nav toggle">
                  <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                </div>
                <nav class="nav navbar-nav">
                <ul class=" navbar-right">
                  <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                      <img src="{{asset ('dashAssets/images/img.jpg')}}" alt="">{{ session('name') }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item"  href="javascript:;"> Profile</a>
                        <a class="dropdown-item"  href="javascript:;">
                          <span class="badge bg-red pull-right">50%</span>
                          <span>Settings</span>
                        </a>
                    <a class="dropdown-item"  href="javascript:;">Help</a>
                    <a class="dropdown-item" href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-sign-out pull-right"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                  </li>
  
                  <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1" data-toggle="dropdown" aria-expanded="false">
                      <i class="fa fa-envelope-o"></i>
                      <span class="badge bg-green">{{ $unreadCount }}</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">

                    @foreach($nodifications as $nodification)
                      <li class="nav-item">
                        <a class="dropdown-item" href="{{ route('dashboard.showMessage', $nodification->id) }}">
                          <span class="image"><img src="{{asset ('dashAssets/images/img.jpg')}}" alt="Profile Image" /></span>
                          <span>
                            <span>{{ $nodification->fullName }}</span>
                            <span class="time">{{ $nodification->time_diff }}</span>
                          </span>
                          <span class="message">
                          {{ $nodification->short_message }}
                          </span>
                        </a>
                      </li>

                      @endforeach

                      

                      
                      <li class="nav-item">
                        <div class="text-center">
                          <a class="dropdown-item">
                          <a href="{{ route('dashboard.messages') }}"><strong>See All Alerts</strong></a>
                            
                            <i class="fa fa-angle-right"></i>
                          </a>
                        </div>
                      </li>
                    </ul>
                  </li>
                </ul>
              </nav>
            </div>
          </div>