<!DOCTYPE html>
<html lang="en">
<head>
   @include('admin.element.head')
</head>
<body>
    
    <div class="main-wrapper">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.element.sidebar')
        <!-- partial -->
    
        <div class="page-wrapper">      
            <!-- partial:partials/_navbar.html -->
            @include('admin.element.navbar')
            <!-- partial -->
            <div class="page-content">
                @yield('content')
            </div>
          
            <!-- partial:partials/_footer.html -->
            @include('admin.element.footer')
            <!-- partial -->
        
        </div>
    </div>
   
    <!-- core:js -->
    @include('admin.element.script')
     <script>
        Echo.join('statusUser')
        .here((users) => {
            for(let i=1;i<=users.length;i++) {
                document.getElementById("qweqweqwe"+users[i-1]['id']).style.color = 'green';
                document.getElementById("qweqweqwe"+users[i-1]['id']).innerHTML = ' <span  class="online_dot"></span> online';
               
            }
        })
        .joining((user) => {
            document.getElementById("qweqweqwe"+user.id).style.color = 'green';
            document.getElementById("qweqweqwe"+user.id).innerHTML = ' <span  class="online_dot"></span> online';
            alert("here"+user.name);
        })
        .leaving((user) => {
            document.getElementById("qweqweqwe"+user.id).style.color = 'black';
            document.getElementById("qweqweqwe"+user.id).innerHTML = ' <span class="offline_dot"></span> offline';
        })
        .error((error) => {
            console.error(error);
        });
    </script>
</body>
</html>    