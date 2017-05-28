<script>
	$(function(){
		var suami = {};
		suami.results = [
			<?php foreach($laki as $data){?>
			{id:'<?php echo $data['id']?>',name:"<?php echo $data['nik']." - ".($data['nama'])?>",info:"<?php echo ($data['alamat'])?>"},
			<?php }?>
		];

		$('#id_suami').flexbox(suami, {
			resultTemplate: '<div><label>No nik : </label>{name}</div><div>{info}</div>',
			watermark: <?php if($suami){?>'<?php echo $suami['nik']?> - <?php echo spaceunpenetration($suami['nama'])?>'<?php }else{?>'Ketik no nik di sini..'<?php }?>,
			width: 260,
			noResultsText :'Tidak ada no nik yang sesuai..',
			onSelect: function() {
				$('#'+'main').submit();
			}
		});

		var istri = {};
		istri.results = [
			<?php foreach($perempuan as $data){?>
			{id:'<?php echo $data['id']?>',name:"<?php echo $data['nik']." - ".($data['nama'])?>",info:"<?php echo ($data['alamat'])?>"},
			<?php }?>
		];

		$('#id_istri').flexbox(istri, {
			resultTemplate: '<div><label>No nik : </label>{name}</div><div>{info}</div>',
			watermark: <?php if($istri){?>'<?php echo $istri['nik']?> - <?php echo spaceunpenetration($istri['nama'])?>'<?php }else{?>'Ketik no nik di sini..'<?php }?>,
			width: 260,
			noResultsText :'Tidak ada no nik yang sesuai..',
			onSelect: function() {
				$('#'+'main').submit();
			}
		});

	});
</script>

<style>
table.form.detail th{
padding:5px;
background:#fafafa;
border-right:1px solid #eee;
}
table.form.detail td{
padding:5px;
}
</style>
<div id="pageC">
<table class="inner">
<tr style="vertical-align:top">
<td class="side-menu">
<fieldset>
<legend>Surat Administrasi</legend>
<div  id="sidecontent2" class="lmenu">
<ul>
<?php foreach($menu_surat AS $data){?>
        <li <?php  if($data['url_surat']==$lap){?>class="selected"<?php  }?>><a href="<?php echo site_url()?>surat/<?php echo $data['url_surat']?>"><?php echo unpenetration($data['nama'])?></a></li>
<?php }?>
</ul>
</div>
</fieldset>
</td>
<td style="background:#fff;padding:5px;">
<div class="content-header">

</div>
<div id="contentpane">
<div class="ui-layout-north panel">
<h3>Surat Persetujuan Mempelai</h3>
</div>
<div class="ui-layout-center" id="maincontent" style="padding: 5px;" >

	<div id="form-cari-pemohon">
		<form action="<?php echo $surat_url ?>" id="main" name="main" method="POST" class="formular">
		<table class="form">
			<tr>
				<th colspan="2">DATA SUAMI (Berasal dari <?php echo strtolower(config_item('sebutan_desa'))?>) :</th>
			</tr>
			<tr>
				<th width="25%">Nama Suami</th>
				<td>
					<div id="id_suami" name="id_suami">
						*) Diisi jika suami berasal dari dalam <?php echo strtolower(config_item('sebutan_desa'))?>
					</div>
				</td>
			</tr>


			<?php
			if($suami != ''){
				?>
				<tr>
					<th>Tempat Tanggal Lahir (Umur)</th>
					<td>
						<?php echo $laki['tempatlahir']?> <?php echo tgl_indo($suami['tanggallahir'])?> (<?php echo $suami['umur']?> Tahun)
					</td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td><?php echo $suami['alamat_wilayah']; ?></td>
				</tr>
				<tr>
					<th>Pendidikan</th>
					<td><?php echo $suami['pendidikan']; ?></td>
				</tr>
				<tr>
					<th>Warganegara / Agama</th>
					<td><?php echo $suami['warganegara']?> / <?php echo $suami['agama']?></td>
				</tr>
			<?php
			}
			?>

			<tr>
				<th colspan="2">DATA ISTRI (Berasal dari <?php echo strtolower(config_item('sebutan_desa'))?>) :</th>
			</tr>
			<tr>
				<th>Nama Istri</th>
				<td>
					<div id="id_istri" name="istri" value="10">
						*) Diisi jika istri berasal dari dalam <?php echo strtolower(config_item('sebutan_desa'))?>
					</div>
				</td>
			</tr>


			<?php
			if($istri != ''){
				?>
				<tr>
					<th>Tempat Tanggal Lahir (Umur)</th>
					<td>
						<?php echo $istri['tempatlahir']?> <?php echo tgl_indo($istri['tanggallahir'])?> (<?php echo $istri['umur']?> Tahun)
					</td>
				</tr>
				<tr>
					<th>Alamat</th>
					<td><?php echo $istri['alamat_wilayah']; ?></td>
				</tr>
				<tr>
					<th>Pendidikan</th>
					<td><?php echo $istri['pendidikan']; ?></td>
				</tr>
				<tr>
					<th>Warganegara / Agama</th>
					<td><?php echo $istri['warganegara']?> / <?php echo $istri['agama']?></td>
				</tr>
			<?php
			}
			?>

		</table>
		</form>
	</div>


<form id="validasi" action="<?php echo $form_action?>" method="POST" target="_blank">
					<input type="hidden" name="id_suami" value="<?php echo $suami['id']?>">
					<input type="hidden" name="id_istri" value="<?php echo $istri['id']?>">
<table class="form">

	<tr>
		<th width="25%">Nomor Surat</th>
		<td><input name="nomor" type="text" class="inputbox required" size="30"/> <span>Terakhir: <?php echo $surat_terakhir['no_surat'];?> (tgl: <?php echo $surat_terakhir['tanggal']?>)</span></td>
	</tr>

	<?php
	if($suami == ''){
		?>
		<tr>
			<th colspan="2">DATA SUAMI (Berasal dari luar <?php echo strtolower(config_item('sebutan_desa'))?>) :</th>
		<tr>
			<th>Nama Lengkap</th>
			<td><input name="nama_suami" type="text" class="inputbox " size="30"/>*) Diisi jika suami berasal dari luar <?php echo strtolower(config_item('sebutan_desa'))?></td>
		</tr>
		<tr>
			<th>Bin</th>
			<td><input name="bin_suami" type="text" class="inputbox " size="30"/></td>
		</tr>
		<tr>
			<th>Tempat Tanggal Lahir</th>
			<td><input name="tempatlahir_suami" type="text" class="inputbox " size="30"/>
			<input name="tanggallahir_suami" type="text" class="inputbox  datepicker" size="20"/></td>
		</tr>
		<tr>
			<th>Warganegara</th>
			<td><input name="wn_suami" type="text" class="inputbox " size="15"/></td>
		</tr>
		<tr>
			<th>Agama</th>
			<td><input name="agama_suami" type="text" class="inputbox " size="15"/></td>
		</tr>
		<tr>
			<th>Pekerjaan</th>
			<td><input name="pekerjaan_suami" type="text" class="inputbox " size="30"/></td>
		</tr>
		<tr>
			<th>Tempat Tinggal</th>
			<td><input name="tempat_tinggal_suami" type="text" class="inputbox " size="40"/></td>
		</tr>
	<?php
	}
	?>


	<?php
	if($istri == ''){
		?>
		<tr>
			<th colspan="2">DATA ISTRI (Berasal dari luar <?php echo strtolower(config_item('sebutan_desa'))?>) :</th>
		</tr>
		<tr>
			<th>Nama Lengkap</th>
			<td><input name="nama_istri" type="text" class="inputbox " size="30"/>*) Diisi jika istri berasal dari luar <?php echo strtolower(config_item('sebutan_desa'))?></td>
		</tr>
		<tr>
			<th>Bin</th>
			<td><input name="bin_istri" type="text" class="inputbox " size="30"/></td>
		</tr>
		<tr>
			<th>Tempat Tanggal Lahir</th>
			<td><input name="tempatlahir_istri" type="text" class="inputbox " size="30"/>
			<input name="tanggallahir_istri" type="text" class="inputbox  datepicker" size="20"/></td>
		</tr>
		<tr>
			<th>Warganegara</th>
			<td><input name="wn_istri" type="text" class="inputbox " size="15"/></td>
		</tr>
		<tr>
			<th>Agama</th>
			<td><input name="agama_istri" type="text" class="inputbox " size="15"/></td>
		</tr>
		<tr>
			<th>Pekerjaan</th>
			<td><input name="pekerjaan_istri" type="text" class="inputbox " size="30"/></td>
		</tr>
		<tr>
			<th>Tempat Tinggal</th>
			<td><input name="tempat_tinggal_istri" type="text" class="inputbox " size="40"/></td>
		</tr>
	<?php
	}
	?>

</table>
</div>

<div class="ui-layout-south panel bottom">
<div class="left">
<a href="<?php echo site_url()?>surat" class="uibutton icon prev">Kembali</a>
</div>
<div class="right">
<div class="uibutton-group">
<button class="uibutton" type="reset">Clear</button>

							<button type="button" onclick="$('#'+'validasi').attr('action','<?php echo $form_action?>');$('#'+'validasi').submit();" class="uibutton special"><span class="ui-icon ui-icon-print">&nbsp;</span>Cetak</button>
							<?php if (SuratExport($url)) { ?><button type="button" onclick="$('#'+'validasi').attr('action','<?php echo $form_action2?>');$('#'+'validasi').submit();" class="uibutton confirm"><span class="ui-icon ui-icon-document">&nbsp;</span>Export Doc</button><?php } ?>
</div>
</div>
</div> </form>
</div>
</td></tr></table>
</div>
