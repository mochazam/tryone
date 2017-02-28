<!DOCTYPE html>
<html>
<head>
	<title>admin</title>

	<link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.css" />  
	<link rel="stylesheet" href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" />

	<style type="text/css">
	.page_menu ul li{
		display: inline-block;
	}
	</style>
</head>
<body>

	<div class="container">
		<div class="row">

			<div class="page_menu">
				<ul>
					<li><a href="#"><i class="fa fa-user"></i> admin</a></li>
					<li><?php echo anchor('user/login/logout', 'logout'); ?></li>
					<li><?php echo anchor('user/admin/matakuliah', 'matakuliah'); ?></li>
				</ul>
			</div>

		</div>
	</div>

	<div class="container">
		<div class="row">

			<div class="pull-right">
				<a href="#" class="btn btn-primary">Add Matakuliah</a>
			</div>
			
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>Kode MK</th>
						<th>Nama MK</th>
						<th>SKS</th>
						<th>Jurusan</th>
						<th>Semester</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//untuk menampilkan data dari table, diambil dari variable table yg ada di controller
					$no=1;
					foreach($data_mk->result() as $row){
					?>
						<tr>
							<td><?php echo $no++;?></td>
							<td><?php echo $row->kode_mk;?></td>	
							<td><?php echo $row->nama_mk;?></td>
							<td><?php echo $row->jum_sks;?></td>	
							<td><?php echo $row->kode_jur;?></td>
							<td><?php echo $row->semester;?></td>	
							<td>
								<a class="green" href="<?php echo base_url();?>admin/matakuliah/edit/<?php echo $row->kode_mk;?>" title="edit">
									<i class="fa fa-edit"></i>
								</a>

								<a class="red" href="<?php echo base_url();?>admin/matakuliah/hapus/<?php echo $row->kode_mk;?>" title="delete" onclick="return confirm('Yakin Akan menghapus data ini ?');"> <!-- sedikit penambahan javascript untuk konfirmasi --> 
									<i class="fa fa-times"></i>
								</a>
							</td>
						</tr>
					<?php } ?>			
				</tbody>
			</table>
		</div>
	</div>


</body>
</html>