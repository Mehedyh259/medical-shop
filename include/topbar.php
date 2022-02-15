<div class="topbar">
    <div class="dropdown mr-2 clearfix ">
        <div id="clock">
            <div class='time '><span id="hour"></span>  <span>Hours</span></div>
            <div class='time' ><span id="minute"></span>  <span>Minutes</span></div>
            <div class='time ' ><span id="second"></span><span>Seconds</span></div>
        </div>
        
        <a style="text-decoration:none;color:#fff;" href=""class="dropdown-toggle drop-btn float-right" data-toggle="dropdown">
            <img src="assets/img/profile/<?php echo $_SESSION['picture']; ?>" alt="" style="height:45px; width:45px; border-radius:50%; ">
            <span class="text-capitalize"><?php  echo $_SESSION['userName']; ?></span>
        </a>
        

        <div class="dropdown-menu-1" style="padding:0;">
            <div class="account" >
                <div style="background: #3C8DBC;padding: 22px;" class="text-center">
                    <img src="assets/img/profile/<?php echo $_SESSION['picture']; ?>" style='width: 100px;height: 100px; margin:auto;' class='rounded-circle img-thumbnail'>
                    <br><br>
                    <span class="" style="font-size: 13pt;color:#CEE6F0; text-transform:capitalize;"><?php  echo $_SESSION['userName']; ?></span><br>

                </div>
                <div style="padding: 11px;">
                    <span><a href="<?php echo $base_url.'profile'; ?>" class="btn btn-sm btn-info"> Profile </a></span>
                    <span style="float:right"><a href="<?php echo $base_url.'logout.php'; ?>" class="btn btn-danger btn-sm"> Sign Out </a></span>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">

    function clock(){
        var hour = document.querySelector('#hour');
        var minute = document.querySelector('#minute');
        var second = document.querySelector('#second');

        var h = new Date().getHours();
        var m = new Date().getMinutes();
        var s = new Date().getSeconds();

        if( h >12){
            h = h-12;
        }

        h = (h<10)? '0'+h : h;
        m = (m<10)? '0'+m : m;
        s = (s<10)? '0'+s : s;


        hour.innerHTML = h;
        minute.innerHTML = m;
        second.innerHTML = s;

        

    }
    var interval = setInterval(clock);


</script>