
   <!-- div for Content Wrapper of top bar-->
        <!-- div for Main Content of topbar -->
    <div id="content-wrapper">
        <style>
            .topbar-header{
            margin: 0;
            width: calc(100% - 305px);
            margin-left: 305px;
            display:block;
            background: white;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
            }

            .header-txt{

                right: 100%;
                margin: 0;
                padding: 27px;
                text-align: center;
                color: darkblue;
                font-size: 30px;
                font-weight: bold;
                
            }
            .container-fluid{
                padding:0;
                padding-top:5px;
            }
            .timestamp {
            position: absolute;
            top: 70px;
            right: 10px;
        }


        </style>
            <div class="timestamp" id="timestamp"></div>
            <script>
                function updateTimestamp() {
                    var timestampDiv = document.getElementById('timestamp');
                    var now = new Date();
                    var timestamp = now.toLocaleString();
                    timestampDiv.innerText =  timestamp;
                }
                window.onload = updateTimestamp;
            </script>

      <!-- Main Content -->
      <div id="content">
            <header class="topbar-header">
                <p class ="header-txt">LAYCO'S CAR RENTAL SERVICES </p>
            </header>
            <!-- End of Topbar -->
    

            <!-- Begin Page Content -->
            <div class="container-fluid">