

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
       <script type="text/javascript" src="/jquery/jquery-2.1.3.min.js"></script>

    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->
    <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
   <script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="/css/layout/app.css">
    <link rel="stylesheet" type="text/css" href="/css/layout/search_box.css">
    <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> -->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family: 'Lato';
            background: #333;
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
    <script type="text/javascript" href="/js/layouts/app.js"> </script>
    <script type="text/javascript">
                function update_logged_in()
        {
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.open("GET","/profile/update/update_online_info");
            xmlhttp.send();
            // console.log("done");
        }


        function doFirst()
        {
            update_logged_in();
            // console.log("hello");
           doFirstTimeout= setTimeout(doFirst,30000);
        }

        function check_blank_string(search_input)
        {
            var len=search_input.length;
            var spaces=0;
            for(var i=0;i<len;i++)
            {
                if(search_input[i]==' ')
                {
                    spaces++;
                }
            }
            // console.log(spaces+" "+len);
            if(spaces==len)
            return true;

            return false;
        }

        function search(search_input)
        {
            var xmlhttp=new XMLHttpRequest();
            // console.log(check_blank_string(search_input));
            if(!check_blank_string(search_input))
            {
            xmlhttp.open("GET","/topics/search/"+search_input);

            xmlhttp.onreadystatechange=function()
            {
                if(xmlhttp.readyState==4 && xmlhttp.status==200)
                {
                    // console.log(xmlhttp.responseText);
                    if(xmlhttp.responseText.length>0)
                    document.getElementById('search_results').innerHTML=xmlhttp.responseText;

                    else 
                    {
                        document.getElementById('search_results').innerHTML="<br><a><li> No such topic or username exists</li></a><br>";
                    }
                }
            }
            xmlhttp.send();
            }

            else
            {
               document.getElementById('search_results').innerHTML="<br><a><li> No such topic or username exists</li></a><br>";
            }
           
        }
        
        window.addEventListener('load',doFirst);
    </script>

</head>
<body id="app-layout">
    <div id="blur"></div>
    <nav class="navbar navbar-default">
        <div class="container">
            <div id="navbar-header" class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <section>
                <div id="logo"><a class="navbar-brand" href="{{ url('/') }}">
                    BringItOn
                </a>
                </div>
           
                    <div id="search_box" style="color:black" class="search" >
                          
                   
                      <input type="search" onkeyup="search(this.value)" placeholder="Search..." autocomplete="off">
                      <ul class="search-ac" id="search_results">
                        <li><br> </li>
                        <li><a> Start typing to search for topics and username<br></a>
                        <li> <br></li>
                        </li>
                        
                      </ul>
                    </div>
   
            </div>
            </section>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
               <!--  <ul class="nav navbar-nav">
                </ul> -->

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right" style="font-size:15px">
                    <!-- Authentication Links -->

                        <li><a href={{url('/topics')}}>Topics </a></li>
                       <li><a href="{{ url('/home') }}">Home</a></li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href=<?php echo('/profile/'.Auth::user()->username); ?>><i class="fa fa-btn fa-sign-out"></i>Profile</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
    
    @yield('content')


    <!-- JavaScripts -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script> -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

