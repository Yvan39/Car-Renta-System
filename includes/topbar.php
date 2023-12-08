
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


        <style>
    /* Styles for the timestamp display */
</style>
<div class="timestamp" id="timestamp"></div>
<script>
    // JavaScript function to update the timestamp
    function updateTimestamp() {
        // Get the element with the 'timestamp' id
        var timestampDiv = document.getElementById('timestamp');

        // Create a new Date object to get the current date and time
        var now = new Date();

        // Format the timestamp as a localized string
        var timestamp = now.toLocaleString();

        // Set the inner text of the timestampDiv to the formatted timestamp
        timestampDiv.innerText = timestamp;
    }

    // Call the updateTimestamp function when the window has finished loading
    window.onload = function () {
        // Call updateTimestamp immediately
        updateTimestamp();

        // Update the timestamp every second (1000 milliseconds)
        setInterval(updateTimestamp, 1000);
    };
</script>


      <!-- Main Content -->
      <div id="content">
            <header class="topbar-header">
                <p class ="header-txt">LAYCO'S CAR RENTAL SERVICES </p>
            </header>
            <!-- End of Topbar -->
    

            <!-- Begin Page Content -->
            <div class="container-fluid">