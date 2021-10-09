<!-- Sidebar -->
<div id="sidebar-wrapper" style="position: fixed; height: 100%;">
    <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
        <li class="active">
            <a href="{{ url('/usuarios') }}"><i class="fas fa-user-friends fa-2x" style="float: left; margin-top: 12px; align-items: center"></i>Usuarios</a>
        </li>
        <li class="active">
            <a href="{{ url('/conductores') }}"><i class="fas fa-id-card fa-2x" style="float: left; margin: 12px 3px"></i>Conductores</a>
        </li>
        <li class="active">
            <a href="{{ url('/vehiculos') }}"><i class="fas fa-bus-alt fa-2x" style="float: left; margin: 12px 3px"></i>Vehiculos</a>
        </li>
    </ul>
</div>