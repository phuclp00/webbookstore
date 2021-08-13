<!DOCTYPE html>
<html lang="en">

<head>
  @include('client.layout.head')
  @include('client.layout.header.css')
  @include('client.layout.header.links')
  <link rel="stylesheet" href="{{asset('asset/frontend/css/css-loader.css')}}">
  <!-- Include only the reset -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.3.1/themes/reset-min.css"
    integrity="sha256-t2ATOGCtAIZNnzER679jwcFcKYfLlw01gli6F6oszk8=" crossorigin="anonymous">
  <!-- or include the full Satellite theme -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/instantsearch.css@7.4.5/themes/satellite-min.css"
    integrity="sha256-TehzF/2QvNKhGQrrNpoOb2Ck4iGZ1J/DI4pkd2oUsBc=" crossorigin="anonymous">
  <script>
    var ALGOLIA_INSIGHTS_SRC = "https://cdn.jsdelivr.net/npm/search-insights@1.8.0";
    
      !function(e,a,t,n,s,i,c){e.AlgoliaAnalyticsObject=s,e[s]=e[s]||function(){
      (e[s].queue=e[s].queue||[]).push(arguments)},i=a.createElement(t),c=a.getElementsByTagName(t)[0],
      i.async=1,i.src=n,c.parentNode.insertBefore(i,c)
      }(window,document,"script",ALGOLIA_INSIGHTS_SRC,"aa");
      aa('init', {
        appId: 'K177MITG7W',
        apiKey: '7ffdbc248bd1211b1bd1696f1d89cfa6',
      });
  </script>
</head>

<body>
  <!-- Messenger Plugin chat Code -->
  <div id="fb-root"></div>
  <!-- Your Plugin chat code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div>

  <script>
    var chatbox = document.getElementById('fb-customer-chat');
          chatbox.setAttribute("page_id", "105193708338194");
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
  <div id="loader" class="loader loader-default is-active"></div>
  <div id="app">
    <div class="site-wrapper">
      @include('client.layout.header')
      <div class="site-mobile-menu">
        @include('client.layout.mobile.header')
        @include('client.layout.mobile.aside')
      </div>
      @yield('main-body')
      <!-- Modal -->
      @include('client.sections.home.modal')
      <!--=================================
    Brands Slider
    ===================================== -->
      @include('client.sections.home.brands-silder')
      <!--=================================
    Footer Area
    ===================================== -->
      @include('client.layout.footer')
    </div>
  </div>
  <!-- Use Minified Plugins Version For Fast Page Load -->
  @include('client.layout.header.js')
  <script>
    $(window).ready(function () {
            $('#loader').removeClass('is-active');
        });
  </script>
</body>

</html>