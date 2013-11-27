<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
        <meta charset="utf-8">
        <title>Patient Profile</title>
        <meta name="generator" content="Bootply" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/css/bootstrap.min.css" rel="stylesheet">
        
        <!--[if lt IE 9]>
          <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
        <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
        <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">
        <!-- add backgrouond -->
        <link type="text/css" rel="stylesheet" href="home_page.css" />
 <!-- CSS code from Bootply.com editor -->     
        <style type="text/css">
            /* custom inclusion of left tab */
            .tabs-left > .nav-tabs {
                border-bottom: 0;
            }

            .tab-content > .tab-pane,
            .pill-content > .pill-pane {
                display: none;
            }

            .tab-content > .active,
            .pill-content > .active {
                display: block;
            }

            .tabs-left > .nav-tabs > li{
                float: none;
            }

            .tabs-left > .nav-tabs > li > a {
                 min-width: 74px;
                 margin-right: 0;
                 margin-bottom: 3px;
            }

            .tabs-left > .nav-tabs {
                float: left;
                margin-right: 19px;
                border-right: 1px solid #ddd;
            }

            .tabs-left > .nav-tabs > li > a {
                margin-right: -1px;
                -webkit-border-radius: 4px 0 0 4px;
                -moz-border-radius: 4px 0 0 4px;
                border-radius: 4px 0 0 4px;
            }

            .tabs-left > .nav-tabs > li > a:hover,
            .tabs-left > .nav-tabs > li > a:focus {
                border-color: #eeeeee #dddddd #eeeeee #eeeeee;
            }

            .tabs-left > .nav-tabs .active > a,
            .tabs-left > .nav-tabs .active > a:hover,
            .tabs-left > .nav-tabs .active > a:focus {
                border-color: #ddd transparent #ddd #ddd;
                *border-right-color: #ffffff;
            }
            
            #profilepic
            {
                width: 250px;
                heigth: 250px;
            }
        </style>
        
        <link type="text/css" rel="stylesheet" href="home_page.css" />
    </head>
    
    <!-- HTML code from Bootply.com editor -->
    
<body>
     <div class="container">

             <?php include("header_bar.php"); ?>

      <hr>
    <ul style="list-style-type: none;" style="width: 275px;">
        <li>
            <h4>Welcome David, </h4>
        </li>
        <li>
            <img src="images/img1.jpg" id="profilepic">
        </li>
    </ul>
    

        <div class="container">
        <!-- /row -->
          
            <div class="row">
                <div><!--class="col-md-6" this was here-->
                    <h3 class=""></h3> 

                <!-- tabs left -->
                        <div class="tabbable tabs-left">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#a" data-toggle="tab" class="" contenteditable="false">My Info</a>
                                </li>
                                <li class=""><a href="#b" data-toggle="tab" class="" contenteditable="false">My Dentist</a>
                                </li>
                                <li class=""><a href="#c" data-toggle="tab" class="" contenteditable="false">My History</a>
                                </li>
                                <li class=""><a href="#d" data-toggle="tab" class="" contenteditable="false">My Appointments</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="a">My Information will go here.</div>
                                <div class="tab-pane" id="b">My Dentist Information will go here.</div>
                                <div class="tab-pane" id="c">My History will go here.</div>
                                <div class="tab-pane" id="d">My Appointments will go here.</div>
                            </div>
                        </div>
    <!-- /tabs -->
                </div>
            </div>
    <!-- /row -->
        </div> 
        <hr class="">
        
        <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0-rc2/js/bootstrap.min.js"></script>


        <!-- JavaScript jQuery code from Bootply.com editor -->
        
        <script type='text/javascript'>
            $(document).ready(function() {
            });
        
        </script>
        
    </body>
</html>