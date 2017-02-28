<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Contoh Aplikasi Rekap Transkrip Nilai  </title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		padding: 40px;
		margin:0px auto;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
		width:980px;
	}

	a {
		color:#666666;
		background-color: transparent;
		font-weight: normal;
		text-decoration:none;
	}

	a:hover {
		color:#FF3300;
		background-color: transparent;
		font-weight: normal;
		text-decoration:underline;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0px auto;
		width:900px;
	}
	
	input{
	background-color:#EAEAEA;
	cursor:pointer;
	border:1px solid #000000;
	padding:5px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>

<body>

<div id="container">
	<h1>Detail Transkrip Nilai Semua Mata Kuliah</h1>

	<div id="body">
		<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
	<tr>
		<td>NIM</td>
		<td>:&nbsp;<input name="nim" value="<?php echo $nim; ?>" type="text" readonly="readonly"  size="40"/></td>
		
		<td>Dosen Wali</td>
		
		<td>		
		:&nbsp;<input name="dosen_wali" value="Tatang Sunarya a.k.a Sule" type="text" readonly="readonly"  size="40" />
		</td>
	</tr>
	<tr>
		<td>Nama</td>
		<td>:&nbsp;<input name="nama_mhs" value="<?php echo $nama_mhs; ?>" type="text" readonly="readonly"   size="40"/></td>
		<td>IP Semester Lalu/Beban Study Maks</td>
		<td>:&nbsp;<input name="beban_study" value="24" type="text" size="40" readonly="readonly" />
		</td>
				
	</tr>
	<tr>
		<td>Jurusan</td>
		<td>:&nbsp;<input name="jurusan" value="S1 Teknik Informatika" type="text" readonly="readonly"  size="40" /></td>

		<td>Program Kelas</td>
		<td>:&nbsp;<input name="program" value="Kelas Pagi" type="text" readonly="readonly"  size="40" />		
		</td>		
	</tr>
	</table>
	<br>
	<table border="1" width="100%" style="border-collapse: collapse;" cellpadding="4">
	<tr bgcolor="#FFFFFF">
	<td align="center">No</td>
	<td align="center">Kode MK</td>
	<td align="center">Nama MK</td>
	<td align="center">Semester</td>
	<td align="center">SKS</td>
	<td align="center">Nilai</td>	
	<td align="center">Bobot</td>
	<td align="center">SKS x Bobot</td>
	</tr>
	<?php 
	$totalNB=0;	
	$totalSKS=0;
	$no=1;
	
	foreach($transkrip->result_array() as $value)
	{
		echo '<tr>
			<td>'. $no.'</td>
			<td>'. $value['kode_mk'].'</td>
			<td>&nbsp;'. $value['nama_mk'].'</td>
			<td align="center">'.$value['semester_ditempuh'].'</td>
			<td align="center">'. $value['jum_sks'].'&nbsp;</td>
			<td align="center">'. $value['grade'].'</td>
			<td align="center">'. $value['bobot'].'</td>
			<td align="center">'. $value['NxB'].'</td>
		</tr>';
		
		$no++;
		if($value['grade'] != 'T') {
			$totalNB +=$value['NxB'];
			$totalSKS+=$value['jum_sks'];
		}
	}
	$ip = 0;
	if($totalNB !=0)			
		$ip = round($totalNB/$totalSKS, 2);
	echo '
			<tr>
			<td colspan="4"><strong>Jumlah SKS yang telah diselesaikan : '.$totalSKS.' SKS</strong></td>
			<td colspan="4"><strong>IP Kumulatif : '.$ip.'</strong></td>
			</tr>';
	?>
	</table>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>