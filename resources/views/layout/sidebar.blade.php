<style>
  body:not(.sidebar-mini) .sidebar-style-2 .sidebar-menu > li.active > a:before{
    background-color: rgb(39, 58, 98);
  }
  .main-sidebar .sidebar-menu li.active a{
    color:  rgb(39, 58, 98);
  }
  .main-sidebar .sidebar-menu li a i{
    font-size: 20px;
    margin: 0;
  }
  body.sidebar-mini .main-sidebar .sidebar-menu > li{
    padding: 2px;
  }
  body.sidebar-mini .main-sidebar .sidebar-menu > li.active > a{
    background-color: rgb(39, 58, 98);
  }
</style>
<div class="main-sidebar sidebar-style-2">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand" style="line-height: 30px">
      <a href="/">Laravel DataTables</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="/">LD</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="nav-item dropdown active">
            <li class="{{$title === 'Dashboard' ? 'active':''}}"><a class="nav-link" href="/"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
        </li>
        <li class="menu-header">Master Data</li>
        <li class="nav-item dropdown active">
          <li class="{{$title === 'Data User' ? 'active':''}}"><a class="nav-link" href="/user"><i class="ion-android-person"></i><span>User Server-Side</span></a></li>
          <li class="{{$title === 'Data User Client Side' ? 'active':''}}"><a class="nav-link" href="/user_client_side"><i class="ion-android-person"></i><span>User Client-Side</span></a></li>
        </li> 
      </ul>
  </aside>
</div>