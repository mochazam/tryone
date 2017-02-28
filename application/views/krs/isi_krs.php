<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Contoh Aplikasi Pengisian KRS</title>

	<script src="<?php echo base_url(); ?>asset/jquery.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>asset/jquery.validate.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#datafrs").validate({
				debug: false,
				rules: {
					nim: "required"
				},
				messages: {
					nim: "<div style='width:100%; position:absolute; text-align:center; color:#fff; padding:5px; background-color:red;'>Masukkan NIM..!!!</div>",
				},
				submitHandler: function(form) {
					// do other stuff for a valid form
					$.post('<?php echo base_url(); ?>krs/simpan_krs', $("#datafrs").serialize(), function(data) {
						$('#hasil').html(data);
						document.datafrs.tombolsimpan.disabled=true;
					});
				}
			});
		});
	</script>
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
<script languange="javascript">

function pilih(chk) {
	var jumlahSKS=0;	
	var detailfrs="";
	var beban=document.datafrs.beban_study.value;
	var temp=document.datafrs.jumlahsks.value;

	for(i=0 ; i<document.datafrs.length; i++) 
	{
		if(document.datafrs.elements[i].type=='checkbox')
		{
			if(document.datafrs.elements[i].checked==true)
			{
					parseData= document.datafrs[i].name.split("_");
					jumlahSKS += parseInt(document.getElementById(parseData[1]).innerHTML);
					if(jumlahSKS > beban) {
					chk.checked=false;
					jumlahSKS = temp;
					alert('Jumlah SKS yang anda ambil tidak boleh lebih dari beban maksimal');
				}
			}
		}
	}

	for(i=0 ; i<document.datafrs.length; i++) 
	{
		if(document.datafrs.elements[i].type=='checkbox')
		{
			if(document.datafrs.elements[i].checked==true)
			{
				parseData= document.datafrs[i].name.split("_");
				idMk = "mk_"+parseData[1];
				idDosen = "dosen_"+parseData[1];
				idJadwal = "jdw_"+parseData[1];
				if(detailfrs=="")
				{
					detailfrs += document.getElementById(idMk).innerHTML+"+"+document.
					getElementById(idDosen).innerHTML+"+"+document.getElementById(idJadwal).innerHTML;
				}
				else
				{
					detailfrs += "|"+document.getElementById(idMk).innerHTML+"+"+document.
					getElementById(idDosen).innerHTML+"+"+document.getElementById(idJadwal).innerHTML;
				}
				
			}
		}
	}
	document.datafrs.jumlahsks.value=jumlahSKS;
	document.datafrs.detailfrs.value=detailfrs;
	if(parseInt(document.getElementById(idSKS).innerHTML)>0)
		document.datafrs.tombolsimpan.disabled=false;
	else
		document.datafrs.tombolsimpan.disabled=true;
}//end function

</script>
<body>

<div id="container">
	<h1>Contoh Aplikasi Pengisian KRS - Sistem Paket</h1>

	<div id="body">
	
	<form method="post" action="" name="datafrs" id="datafrs">
		<table border="0" width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
	<tr>
		<td>NIM</td>
		<td>:&nbsp;<input name="nim" value="<?php echo $nim; ?>" type="text" readonly="readonly"  size="40"/></td>
		<td>Semester, Tahun Ajaran</td>
		<td>:&nbsp;<input name="smstr_thn_ajaran" value="<?php echo date('Y'); ?>" type="text" readonly="readonly"  size="40" /></td>
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
		<tr>
		<td>Dosen Wali</td>
		
		<td>		
		:&nbsp;<input name="dosen_wali" value="Tatang Sunarya a.k.a Sule" type="text" readonly="readonly"  size="40" />
		</td>

		<td>Semester yang akan ditempuh (*)</td>
		<td>:&nbsp;<input name="semester" value="" type="text"  readonly="readonly"  size="40"/>
		</td>
	</tr>
	</table>
	<br>
	<div id="hasil"></div>
	<br>
	<table border="1" cellpadding="5" cellspacing="0" width="100%" bordercolor="#999999">
		<?php
			foreach($jadwal->result_array() as $d)
			{
				echo '<tr><td id="mk_'.$d['id_jadwal'].'">'.$d['kode_mk'].'</td><td>'.$d['nama_mk'].'</td><td>'.$d['nama_dosen'].'</td><td id="dosen_'.$d['id_jadwal'].'">'.$d['kode_dosen'].'</td><td>'.$d['semester'].'</td>
				<td id="'.$d['id_jadwal'].'">'.$d['jum_sks'].'</td><td id="jdw_'.$d['id_jadwal'].'">'.$d['jadwal'].'</td><td>
				<input type="checkbox" name="chk_'.$d['id_jadwal'].'" onchange="javascript:pilih(this);"/>
				</td></tr>';
			}
		?>
	<tr><td colspan="7"><p class="left">
	<strong>Total Beban Study yang Akan Ditempuh </strong>
	<input id="idJumlahSKS" name="jumlahsks" value="" type="text" size="2" style="background-color: #CFCFCF;" readonly="readonly"/>	
	<input name="detailfrs" type="hidden" size=100 value=""/>
	<strong>SKS</strong>	
	</p></td><td>
	<input type="submit" value="Simpan KRS"></td></tr>
	</form>
	</table>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>