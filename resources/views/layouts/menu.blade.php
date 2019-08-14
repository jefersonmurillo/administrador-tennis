<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('template/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Tennis Golf Club</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
            </div>
        </form>
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Usuarios</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=""><a href="{{ route('afiliados.index') }}"><i class="fa fa-circle-o"></i> Afiliados</a>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="">
                    <i class="fa fa-th"></i> <span>Instalaciones</span>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('instalaciones.index') }}"><i class="fa fa-circle-o"></i>Listado de instalaciones</a></li>
                    <li class=""><a href="{{ route('disciplinas.index') }}"><i class="fa fa-circle-o"></i>Disciplinas</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="">
                    <i class="fa fa-th"></i> <span>Eventos</span>
                    <span class="pull-right-container">
                      <small class="label pull-right bg-green">new</small>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('eventos.index') }}"><i class="fa fa-circle-o"></i>Listado de eventos</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-th"></i> <span>Tee-Time</span>
                    <span class="pull-right-container">
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('tee-time.index') }}"><i class="fa fa-circle-o"></i>Programador</a></li>
                </ul>
            </li>

            <li>
                <a href="{{ route('pqrs.index') }}">
                    <i class="fa fa-th"></i> <span>PQRS</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <li>
                <a href="{{ route('sugerencias.index') }}">
                    <i class="fa fa-th"></i> <span>Sugerencias del Chef</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

            <li>
                <a href="{{ route('sabor.index') }}">
                    <i class="fa fa-th"></i> <span>Sabor Gourmet</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>

        </ul>
    </section>
</aside>