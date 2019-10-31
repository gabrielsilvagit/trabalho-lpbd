<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
                    <a href="{{ route("show.user", Auth::user()) }}">
                        {{ Auth::user()->name }}
                    </a>
                </div>
				<div class="profile-usertitle-status">
                    <form action="{{ route("user.logout") }}" method="POST">
                        @csrf
                        <button class="btn btn-link">Sair</button>
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
			<li class="{{ (strpos(url()->current(), "/services") == false && strpos(url()->current(), "/users") == false) ? 'active' :""  }}">
                <a href="/">
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