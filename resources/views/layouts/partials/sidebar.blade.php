<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="{{ asset('img/default.png') }}" class="img-responsive" alt="default">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
                    <a href="{{ route("show.user", Auth::user()) }}">
                        {{ Auth::user()->name }}
                    </a>
                </div>
				<div class="profile-usertile-name">
                    <form action="{{ route("user.logout") }}" method="POST">
                        @csrf
                        <button id="logout" class="btn btn-link">Sair</button>
                    </form>
                </div>
            </div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		{{--  <form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>  --}}
		<ul class="nav menu">
                <li class="{{  strpos(url()->current(), "/home") ? 'active' :""  }}">
                <a href="{{ route("home")  }}">
                    <em class="fa fa-home">&nbsp;</em>
                    Home
                </a>
            </li>
			<li class="{{  strpos(url()->current(), "/users") ? 'active' :""  }}">
                <a href="{{ route("user.index")  }}">
                    <em class="fa fa-users">&nbsp;</em>
                    Usuários
                </a>
            </li>
			<li class="{{  strpos(url()->current(), "/services") ? 'active' :""  }}">
                <a href="{{ route("service.index")  }}">
                    <em class="fa fa-wrench">&nbsp;</em>
                    Serviços
                </a>
            </li>

		</ul>
    </div><!--/.sidebar-->
    {{--  $_SERVER['REQUEST_URI']  --}}
