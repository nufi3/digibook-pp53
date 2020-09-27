<?php
	function read_file($nama_file){
		$myfile = fopen($nama_file, "r") or die("Unable to open file!");
		$result = array();
		// Output one line until end-of-file
		while(!feof($myfile)) {
		  $result[] = explode('\n',fgets($myfile));
		}
		fclose($myfile);
		
		return ($result);
	}
	
	$data_teks = "";
	$judul = "";
	if(isset($_GET['menu'])){
		$jenis = $_GET['menu'];
		if($jenis == 'kwj'){
			$judul = "Kewajiban";
			$data_teks = (read_file("data/kewajiban_pns.txt"));
		}else if($jenis == 'lar'){
			$judul = "Larangan";
			$data_teks = (read_file("data/larangan_pns.txt"));
		}else if($jenis == 'huk'){
			$judul = "Tingkat Hukuman Dinas";
			$data_teks = (read_file("data/tingkat_hukdis.txt"));
		}else if($jenis == 'pel'){
			$judul = "Jenis Hukuman Dinas Atas Pelanggaran";
			$data_teks = (read_file("data/hukuman_pelanggaran.txt"));
		}
?>
<div class="col-md-12 xs-6">
	<div class="card shadow bg-light shadow">
		<div class="card-header py-3">
		  <h6 class="m-0 font-weight-bold text-primary">Detail Peraturan Pemerintah Nomor 53 TAHUN 2010 | <?php echo $judul;?></h6>
		</div>
		<div class="card-body">
			<div class="small" id="main">
				<div id="title">
					<b><?php echo $judul;?></b>
				</div>
				<div id="detail">
					<?php 
						//echo json_encode($data_teks)."<br>";
						$no=1;
						foreach($data_teks as $t){
							$teks = explode("|",$t[0]);
							if($menu=='pel'){
								
								echo $no.". ".$teks[1].", Pelanggaran ";
								if(strlen($teks[2]) > 2) {
									echo "pasal ".$teks[2]." ayat ".$teks[3];
								}else{
									echo $teks[3];
								}
								if(strlen($teks[4]) > 4) 
									echo ", ".$teks[4]."<br>";
								else
									echo "<br>";
							}else{
								echo $teks[3]."<br>";
							}
							
							$no++;
						}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	}
?>