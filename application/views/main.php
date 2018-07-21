<!DOCTYPE html>
<html lang="en">
<head>
  <title>KasBook ORTEGA</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="<?php echo base_url('home/'); ?>">ORTEGA</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#"><?php echo $usn?></a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url('home/logout'); ?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
    <div class="panel panel-default">
  <div class="panel-heading">
  <h3 class="panel-title">
  <span class="glyphicon glyphicon-pencil"></span> Form</h3></div>
  <div class="panel-body">
      <a class="btn btn-success" href="<?php echo base_url('home/formdeber/'); ?>"><i class="glyphicon glyphicon"></i> Pemasukan</a>
     <br><br><a class="btn btn-warning" href="<?php echo base_url('home/formkredit/'); ?>"><i class="glyphicon glyphicon"></i> Pengeluaran</a>
      </div></div>


 <div class="panel panel-primary">
  <div class="panel-heading">
  <h3 class="panel-title">
  <span class="glyphicon glyphicon-envelope"></span> Saldo Terkini</div>
  <div class="panel-body">
  <?php 
  $totkredit=0;
  $totdebet=0;
  foreach ($debetku as $saldo){
    $totdebet= $totdebet + $saldo->jml;
  }
    foreach ($kreditku as $saldo){
    $totkredit= $totkredit + $saldo->jml;
    } 
      echo $totdebet-$totkredit;
    ?></div>
</div>
    </div>

    <div class="col-sm-8 text-left"> <br>
    
   
   <ul class="nav nav-pills">
  <li class="active"><a data-toggle="pill" href="#home">Debet</a></li>
  <li><a data-toggle="pill" href="#menu1">Kredit</a></li>
</ul>

<div class="tab-content">
  <div id="home" class="tab-pane fade in active">
    <h3>Debet</h3>
    <table class="table table-bordered table-hover">
    <thead><br>
    <input class="search" placeholder="Search" /><br>
      <tr>
        <th>ID</th>
         <th>Keterangan</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
       
      </tr>
    </thead>
    <tbody class="list">
      <?php 
      $no=1;
      foreach($debetku as $bebas):
      ?>

      <tr>
      <td><?php echo $no++;?></td>
      <!-- echo $bebas->seko database; -->
        <td class="ket"><?php echo $bebas->ket; ?></td>
        <td class="tgl_debet"><?php echo $bebas->tgl_debet;?></td>
        <td class="jml"><?php echo $bebas->jml;?></td>
     
      </tr>
      
      <?php
      endforeach;
      ?>
      
    </tbody>
  </table>

  <ul class="pagination"></ul>

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>  
<script type="text/javascript">
  var options = {
  valueNames: [ 'ket', 'tgl_debet','jml' ],
  page: 4,
  pagination: true
};

var userList = new List('home', options);

</script>
  </div>

  <div id="menu1" class="tab-pane fade">
    <h3>Kredit</h3>

     <table class="table table-bordered table-hover">
    
    <thead><br>
    <input class="search" placeholder="Search" /><br>
      <tr>
        <th>ID</th>
         <th>Keterangan</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
       
      </tr>
    </thead>
    <tbody class="list">
      <?php 
      $no=1;
      foreach($kreditku as $bebas):
      ?>

      <tr>
      <td><?php echo $no++;?></td>
      <!-- echo $bebas->seko database; -->
        <td class="ket"><?php echo $bebas->ket; ?></td>
        <td class="tgl_kredit"><?php echo $bebas->tgl_kredit;?></td>
        <td class="jml"><?php echo $bebas->jml;?></td>
     
      </tr>
      
      <?php
      endforeach;
      ?>
      
    </tbody>
  </table>

  <ul class="pagination"></ul>

<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>  
<script type="text/javascript">
  var options = {
  valueNames: [ 'ket', 'tgl_kredit','jml' ],
  page: 5,
  pagination: true
};

var userList = new List('menu1', options);

</script>

  </div>
</div>
  

  </div>
</div>

<footer class="container-fluid text-center">
  <p>@MWahyu_kun</p>
</footer>
</body>
</html>
