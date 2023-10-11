<!DOCTYPE html>
<html lang="en">
<head>
   @include('frontend.element.head')
</head>
<body>
   <div class="page-wrapper">
      <header class="page-header">
         @include('frontend.element.header')
      </header>
      @yield('content')
      <footer class="page-footer">
         @include('frontend.element.footer')
      </footer>
   </div>
   <script src="{{ asset('assets/frontend/js/main.js') }}"></script>
</body>
</html>    