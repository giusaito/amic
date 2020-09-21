<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Example user</span>
                        <span class="text-muted text-xs block">menu <b class="caret"></b></span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="login.html">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                <a href="{{route('backend.index')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Painel</span></a>
            </li>
            <li class="{{ (request()->is('painel/projetos*')) ? 'active' : '' }}">
                <a href="{{route('backend.projects.index')}}"><i class="fa fa-list-alt"></i> <span class="nav-label">Projetos</span></a>
            </li>
            <li class="{{ (request()->is('painel/links-uteis*')) ? 'active' : '' }}">
                <a href="{{route('backend.link.util.index')}}"><i class="fa fa-link"></i> <span class="nav-label">Links Úteis</span></a>
            </li>
            <li class="{{ (request()->is('painel/tv-amic*')) ? 'active' : '' }}">
                <a href="{{route('backend.tv-amic.index')}}"><i class="fa fa-tv"></i> <span class="nav-label">TV amic</span></a>
            </li>
            <li>
            </li>
        </ul>

    </div>
</nav>