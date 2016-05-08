<?php
  
  $strCurrentMember = "";
  if($row_RecAdmin && isset($row_RecAdmin['m_name'])){
    $strCurrentMember = $row_RecAdmin['m_name'];
  }else if($row_RecMember && isset($row_RecMember['m_name'])){
    $strCurrentMember = $row_RecMember['m_name'];  
  }
  

?>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="login.php">National Registration of Ketamine Uropathy</a>
    </div>

    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <!-- <a href="first_visit.php">新增病歷</a> -->
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">新增病歷 <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="first_visit.php">病人自填</a></li>
            <li><a href="#">??</a></li>
          </ul>
        </li>

        <li><a href="medical_list.php">瀏覽病歷</a></li>
        <li><a href="hospital.php">參與醫院</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="login.php"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $strCurrentMember;?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
      </ul>
    </div>
  </div>
</nav>
      