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

<div class="modal fade" id="debet_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Form Debet</h3>
            </div>
             
            <div class="modal-body form">
                 <form action="<?php echo base_url('home/debet/'.$status); ?>" method="post">
                    
                    <div class="form-body">

                        <div class="form-group">
                            <label class="control-label col-md-3">ID</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="id_debet" value="<?php if(isset($edt)){ echo $edt->id_debet; }?>" disabled>
                                <span class="help-block"></span>
                            </div>
                        </div>
                       
                        <div class="form-group">
                            <label class="control-label col-md-3">Keterangan</label>
                            <div class="col-md-9">
                                <textarea class="form-control" type="text" name="ket" value="<?php if(isset($edt)){ echo $edt->ket; }?>"></textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="control-label col-md-3">Tanggal</label>
                            <div class="col-md-9">
                                <input class="form-control" type="date" name="tgl" value="<?php if(isset($edt)){ echo $edt->tgl_debet; }?>">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Jumlah (Rp)</label>
                            <div class="col-md-9">
                                <input class="form-control" type="text" name="jml" value="<?php if(isset($edt)){ echo $edt->jml; }?>">
                                <span class="help-block"></span>
                            </div>
                        </div>

                    </div>
                
            </div>
         
                <button type="submit"  class="btn btn-primary">Save</button>
                <button type="cancel" class="btn btn-danger" data-dismiss="modal">Cancel</button>
         <br> <br>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div><!-- /.modal -->


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

    <div class="col-sm-8 text-left" id="debet"> 
    <br>
     <button class="btn btn-success" data-toggle="modal" data-target="#debet_form"><i class="glyphicon glyphicon-plus"></i> Add Debet</button><br>
     <table class="table table-bordered table-hover">
    
    <thead><br>
    <input class="search" placeholder="Search" /><br>
      <tr>
        <th>ID</th>
         <th>Keterangan</th>
        <th>Tanggal</th>
        <th>Jumlah</th>
        <th>Action</th>
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
     <td><a href="<?php echo base_url('home/hapusdebet/'.$bebas->id_debet); ?>">delete</a></td>
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
  page: 5,
  pagination: true
};

var userList = new List('debet', options);

</script>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <p>@MWahyu_kun</p>
</footer>
</body>
</html>
