<nav class="sidebar">
  <div class="sidebar-header">
  <a href="{{ route('HomeController.index') }}" class="sidebar-brand">
    Serawi
  </a>
  <div class="sidebar-toggler not-active">
    <span></span>
    <span></span>
    <span></span>
  </div>
</div>
<div class="sidebar-body">
  <ul class="nav">
    <li class="nav-item nav-category">Main</li>
    <li class="nav-item">
      <a href="{{ route('HomeController.index') }}" class="nav-link">
        <i class="link-icon" data-feather="box"></i>
        <span class="link-title">Trang chủ</span>
      </a>
    </li>
    <li class="nav-item nav-category">Bán hàng</li>
    <li class="nav-item">
      <a href="{{ route('orders.index') }}" class="nav-link">
        <i class="link-icon" data-feather="calendar"></i>
        <span class="link-title">Quản lý đơn hàng</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('categories.index') }}" class="nav-link">
        <i class="link-icon"data-feather="grid"></i>
        <span class="link-title">Danh mục sản phẩm</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('products.index') }}" class="nav-link">
        <i class="link-icon" data-feather="shopping-bag"></i>
        <span class="link-title">Danh sách các sản phẩm</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('warranty.index') }}" class="nav-link">
        <i class="link-icon" data-feather="shopping-bag"></i>
        <span class="link-title">Quản lý bảo hành</span>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('reviews.index') }}" class="nav-link">
        <i class="link-icon" data-feather="message-square"></i>
        <span class="link-title">Danh sách đánh giá</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#errorPages2" role="button" aria-expanded="false" aria-controls="errorPages22">
          <i class="link-icon" data-feather="grid"></i>
          <span class="link-title">Tình trạng cửa hàng</span>
          <i class="link-arrow" data-feather="chevron-down"></i>
      </a>
      <div class="collapse" id="errorPages2">
          <ul class="nav sub-menu">
          <li class="nav-item">
              <a href="{{ route('StatusController.sell') }}" class="nav-link">Danh sách bán hàng</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('StatusController.refund') }}" class="nav-link">Danh sách trả hàng</a>
          </li>
          </ul>
      </div>
    </li>
    <li class="nav-item nav-category">Quản lý tài khoản</li>
    <li class="nav-item">
      <a href="{{ route('users.index') }}" class="nav-link no-active" >
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">Quản lí users</span>
      </a>
      <a href="{{ route('customers.index') }}" class="nav-link no-active" >
        <i class="link-icon" data-feather="users"></i>
        <span class="link-title">Quản lí customer</span>
      </a>
      <li class="nav-item nav-category">Quản lý của hàng</li>
      <li class="nav-item">
        <a href="{{ route('products.inventory') }}" class="nav-link no-active" >
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Hàng tồn kho</span>
        </a>
      </li>
      </li>
      <li class="nav-item">
        <a href="{{ route('ThongKeController.index') }}" class="nav-link no-active" >
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Báo cáo thống kê</span>
        </a>
      </li>
  </ul>
</div>
</nav>