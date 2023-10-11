
    <div class="grid wide container">
        <div class="footer-wrapper">
            <div class="footer-top" style="position: relative">
                <div class="footer-top__logo">
                    <a href="{{ route('homeFrontend.index') }}" class="header-logo">
                        <h1 style="font-size: 50px; color:pink;">SERAWI</h1>
                    </a>
                </div>
                <div class="gird wide footer-top__content">
                    <div class="row">
                        </div>
                        <div style="position: absolute; right: 0px; top: 0px">
                            <div class="grid wide">
                                <div class="row">
                                    <div>
                                       <ul class="footer-top__social-link">
                                            <li>
                                                <a href="" target="_blank">
                                                    <i class="fab fa-facebook-f"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="" target="_blank">
                                                    <i class="fab fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "107668051151557");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>