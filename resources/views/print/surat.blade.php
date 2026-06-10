<script type="text/javascript" src="{{asset('assets/js/jquery-4.0.0.min.js')}}"></script>
<link rel="stylesheet" href={{asset('assets/css/colorbox.css')}} />
<script src="{{asset('assets/js/jquery.colorbox.js')}}"></script>

<style>

    #wrapper{
        width:50%;
        margin:30px auto 20px auto;
    }

    #header{
        height:15%;
        width:100%;
    }

    #gambar{
        height:100%;
        width:20%;
        float:left;
    }

    #gambar2{
        height:100%;
        width:10%;
        float:left;
    }

    #tulisan_uin{
        height:100%;
        width:90%;
        margin-left:10%;
        text-align:center;
        font-size:1.2em;
    }

    #tulisan_uin2{
        height:100%;
        width:100%;
        text-align:center;
        font-size:1.2em;
    }

    #garis{
        border-top:3px solid;
        border-bottom:1px solid;
        height:3px;
    }

    #ket{
        margin-top:2%;
        margin-left:30%;
        height:6%;
        width:50%;
        text-align:center;
    }

    #tengah{
        width:100px;
    }

    #id{
        width:280px;
        float:left;
        margin-bottom:30px;
    }

    a{
        font-size:15px;
        text-decoration:none;
        color:#000;
    }

    b{
        font-size:15px;
    }

    #gambar_per{
        height:100%;
        width:12%;
        float:left;
    }

    #garis_per{
        border-top:3px solid;
        border-bottom:1px solid;
        height:3px;
        margin-left:12%;
    }

    #jajal{
        width:150px;
        height:150px;
        float:left;
        border-radius:100px;
        font-size:30px;
        margin-left: 1px ;
    }

    @page {
    size: 8.5in 13in;
    /*   size: 7in 10in;
    /*   margin: 27mm 16mm 27mm 16mm;
    size: 8.27in  11.69in; A4
    */
    }
</style>

<script>
	$(document).ready(function(){
        // window.print();
		$('#form').hide();
		$('#perjanjian').hide();
		//surat();
		//$('#detail-data').show();
	});
	function form(){
		$('#form').show();
		$('#perjanjian').hide();
		$('#pilih').hide();
		$("#form2").empty();
		$("#form2").append('<script>$(document).ready(function(){window.print();});');

	}
	function surat(){
		$('#pilih').hide();
		$('#perjanjian').show();
		$('#form').hide();
		$("#perjanjian2").empty();
		$("#perjanjian2").append('<script>$(document).ready(function(){window.print();});');

	}
	function semua(){
		$('#form').show();
		$('#perjanjian').show();
		$('#pilih').hide();
		$("#perjanjian2").append('<script>$(document).ready(function(){window.print();});');

	}
</script>
<html>
    @php
        $hari = $tglan['hari'];
        $bulan = ($tglan['bulan']);
        if($bulan == 1){
            $bln = "Januari";
        }else if($bulan == 2){
            $bln = "Februari";
        }else if($bulan == 3){
            $bln = "Maret";
        }else if($bulan == 4){
            $bln = "April";
        }else if($bulan == 5){
            $bln = "Mei";
        }else if($bulan == 6){
            $bln = "Juni";
        }elseif($bulan == 7){
            $bln = "Juli";
        }else if($bulan == 8){
            $bln = "Agustus";
        }else if($bulan == 9){
            $bln = "September";
        }else if($bulan == 10){
            $bln = "Oktober";
        }else if($bulan == 11){
            $bln = "November";
        } else {
            $bln = "Desember";
        }

	    $tahun = $tglan['tahun'];
    @endphp

	<head><title>Surat Keterangan</title></head>

	<!-- <body oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;'> -->
	<body >
	<div id="pilih" style="margin:18vw 34vw;">
		<!-- <button type="text" class="btn btn-primary" style="margin-left:6%;">Simpan</button> -->
 		<a href="javascript:form();"><div id="jajal" class="btn btn-primary" style="height:10vw; width:10vw; border-radius:50%; overflow:hidden;">
			<b style="font-size:2vw; line-height:9vw;">Form</b></div></a>
		<a href="javascript:semua();"><div id="jajal" class="btn btn-primary" style="height:10vw; width:10vw; border-radius:50%; overflow:hidden;">
			<b style="font-size:2vw; line-height:9vw;">Semua</b></div></a>
		<a href="javascript:surat();"><div id="jajal" class="btn btn-primary" style="height:10vw; width:10vw; border-radius:50%; overflow:hidden;">
			<b style="font-size:2vw; line-height:9vw;">Surat</b></div></a>
 	</div>
	<div id="form">
		<div id="form2">

		</div>

		<table width="650px;" style=margin:auto;>
			<tr>
				<td>


			<div id="header">
					<div id="gambar"><img style="height:5%; width:60%;" src="{{asset('assets/img/img.png')}}"/></div>
					<div id="tulisan_uin">KEMENTRIAN AGAMA<br/>UNIVERSITAS ISLAM NEGERI SUNAN AMPEL SURABAYA<br/>PUSAT PENGEMBANGAN BISNIS<br/><span style="font-size:0.7em">
					Jl. Jend. A. Yani 117 Surabaya 60237 Telp. 031-8410298 Fax. 031-8413300<br/>E-Mail : info@uinsby.ac.id Website : www.uinsby.ac.id</span></div>
				</div>
				<div id="garis"></div>
				<br/>
				<div id="ket">FORM PEMESANAN PENGGUNAAN<br/>PROPERTY MANAGEMENT<br/>No :........./PUSBIS.PM.FP/{{$bulan . "/" . $tahun}}</div>
				<br/>
				<br/>
					<table>
						<tr>
							<td></td>
							<td>Penanggung Jawab</td>
							<td>&nbsp;&nbsp;</td>
							<td>:&nbsp;&nbsp;</td>
							<td>{{$data->nama_peminjam}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Nomor Telp. HP</td>
							<td></td>
							<td>:</td>
							<td>{{$data->tlp}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Acara</td>
							<td></td>
							<td>:</td>
							<td>{{$data->nama_acara}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Tanggal</td>
							<td></td>
							<td>:</td>
							<td>{{$data->date}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Jumlah Pax/Peserta</td>
							<td></td>
							<td>:</td>
							<td>{{$data->jml_p . " Orang"}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Jenis Properti</td>
							<td></td>
							<td>:</td>
							<td>{{$data->nama_ruang}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Kategori </td>
							<td></td>
							<td>:</td>
							<td>
                                @if ($data->radio == '1')
                                    Corporate
                                @elseif($data->radio == '2')
                                    Karyawan / Alumni
                                @else
                                    Umum
                                @endif
                            </td>
						</tr>
						<tr>
							<td></td>
							<td>Catering</td>
							<td></td>
							<td>:</td>
							<td>

                                @if ($data->catering == '2')
                                    @php
                                        $cash = 1000000
                                    @endphp
                                    Tidak
                                @else
                                    @php
                                        $cash = 0
                                    @endphp
                                    Ya
                                @endif
                            </td>
						</tr>
						<tr>
							<td></td>
							<td>Pembayaran</td>
							<td></td>
							<td>:</td>
							<td>Uang Sewa&nbsp;: {{" Rp. " . number_format($data->us,2,",",".") }}</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Charge&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
                                {{"Rp. " . number_format($cash,2,",",".")}}
                            </td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Bayar&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
                                {{"Rp. " . number_format($data->ub,2,",",".")}}
                            </td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Uang Muka&nbsp;:&nbsp;{{"Rp. " . number_format($data->um,2,",",".")}}</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
							<td>Sisa&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{"Rp. " . number_format($data->sisa,2,",",".")}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Lain-Lain</td>
							<td></td>
							<td>:</td>
							<td>{{$data->lain_lain}}</td>
						</tr>

					</table>

				<br/>
				<br/>


				<br/>
				<div id="id">Pemesan
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
                @if ($data->nama_p == null)
                    .....................................<br/>
                @else
                    {{$data->nama_p}}<br/>
                @endif
                @if ($data->nip_p == null)
                    <br/>
                @else
                    {{"NIP. " . $data->nip_p}}
                @endif


				</div>
				<div id="tengah"></div>
				<div id="id" style="width:230px; margin-left:130px;">Surabaya,&nbsp;{{$hari . " " . $bln . " " . $tahun}} <br/>Petugas
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				{{$pimpinan2->nama}}<br/>
				NIP. {{$pimpinan2->nip}}
				</div>

				<div id="id">Mengetahui<br/>Kepala Pusat Pengembangan Bisnis
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				{{$pimpinan1->nama}}<br/>
				NIP. {{$pimpinan1->nip}}

				</div>
				<div id="tengah"></div>
				<div id="id" style="width:230px; margin-left:130px;">Pimpinan
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				.......................................<br/>
				NIP. ...............................

				</div>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				</td>
			</tr>
			<tr>
				<td><div style="margin-left:0px;font-size:11px;">Contact Person : Drs. {{$pimpinan2->nama}} Hp.082245888702 (Staf Pusat Pengembangan Bisnis UINSA)</div></td>
			</tr>
		</table>

				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
	</div>

	<div id="perjanjian">

		<div id="perjanjian2">

		</div>
		<table width="650px;" style=margin:auto;>
			<tr>
				<td>


			<div id="header">
					<div id="gambar_per"><img style=" width:85%;" src="{{asset('assets/img/img.png')}}"/><span style="font-size:7px;">UIN SUNAN AMPEL<br/>S&nbsp;&nbsp;U&nbsp;&nbsp;R&nbsp;&nbsp;A&nbsp;&nbsp;B&nbsp;&nbsp;A&nbsp;&nbsp;Y&nbsp;&nbsp;A</span></div>
					<div id="">SURAT PERJANJIAN SEWA ASET / GEDUNG<br/>PUSAT PENGEMBANGAN BISNIS<br/>UIN SUNAN AMPEL SURABAYA<br/></div>
				<div id="garis_per"></div>
				</div>
				<div id="ket"><span style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				&nbsp;&nbsp;No :........./PUSBIS.PM.SP/{{$bulan . "/" . $tahun}}</span></div>
				<br/>
				<div id="keterangan">
							<b>&nbsp;Yang Bertanda Tangan dibawah ini</b>
					<table>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;1. </td>
							<td>Nama</td>
							<td></td>
							<td>:</td>
							<td>{{$pimpinan1->nama}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Nip</td>
							<td></td>
							<td>:</td>
							<td>{{$pimpinan1->nip}}</td>
						</tr>
						<tr>
							<td></td>
							<td>ALamat</td>
							<td></td>
							<td>:</td>
							<td>Jl. A.Yani 117 Surabaya</td>
						</tr>
						<tr>
							<td></td>
							<td>Jabatan</td>
							<td></td>
							<td>:</td>
							<td>Kepala Pusat Pengembangan Bisnis UIN Sunan Ampel Surabaya</td>
						</tr>
						</table>
							&nbsp;<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selanjutnya disebut sebagai Pihak 1</b>

						<br/>
						<br/>
						<table>
					<tr>
							<td>&nbsp;&nbsp;&nbsp;2. </td>
							<td>Nama</td>
							<td></td>
							<td>:</td>
							<td>
                                @if ($data->nama_p == null)
                                    .....................................
                                @else
                                    {{$data->nama_p . ""}}
                                @endif
                            </td>
						</tr>
						<tr>
							<td></td>
							<td>Nip </td>
							<td></td>
							<td>:</td>
							<td>
                                @if ($data->nip_p == null)
                                    ........................................
                                @else
                                    {{$data->nip_p}}
                                @endif
                            </td>
						</tr>
						<tr>
							<td></td>
							<td>Alamat</td>
							<td></td>
							<td>:</td>
							<td>
                                @if ($data->alamat_p == null)
                                    .....................................
                                @else
                                    {{$data->alamat_p}}
                                @endif
                            </td>
						</tr>
						<tr>
							<td></td>
							<td>Jabatan</td>
							<td></td>
							<td>:</td>
							<td>
                                @if ($data->jab_p == null)
                                    .....................................
                                @else
                                    {{$data->jab_p}}
                                @endif
                            </td>
						</tr>
					</table>
						&nbsp;<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Selanjutnya disebut sebagai Pihak II</b>

						<br/>
						<br/>
				</div>

				<div >
				<a>Dengan ini menerangkan bahwa kedua belah pihak sepakat mengikat perjanjian yang di atur dalam pasal-pasal berikut : </a>
				<br/>
				<b >Pasal 1</b><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Pihak 1 menyewakan gedung/ruang {{$data->nama_ruang}}  kepada pihak II, untuk acara/kegiatan {{$data->acara}}.</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Gedung/ruang terletak dijalan A. Yani 117 Surabaya, yang di ketahui oleh pihak II</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Pihak II menyewa gedung/ruang pada tanggal {{$data->date}}.</a><br/>
				<b >Pasal 2</b><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Sewa gedung/ruang ditetapkan sebesar Rp.{{number_format($data->ub,2,",",".")}} .</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Pembayaran dilakukan dua tahap. Tahap 1, 30%(Uang Muka) saat perjanjian ini ditandatangani,<br/>&nbsp;&nbsp;&nbsp;&nbsp;dan sisanya maximal satu minggu (7 Hari) sebelum pelaksana.</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3) Setiap pembayaran diberikan tanda bukti khusus yang sah.</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4) Pembayaran secara tunai langsung ke Pusat Pengembangan Bisnis atau Transfer melalui<br/>&nbsp;&nbsp;&nbsp;&nbsp;rekening Kelola Pusat Pengembangan
						Bisnis an. RPL 135 UIN U DANA KLL BLU BISNIS<br/>&nbsp;&nbsp;&nbsp;&nbsp;Nomor: 142-00-0000303-7 pada bank Mandiri Cabang Graha Pena Surabaya.</a><br/>
				<b >Pasal 3</b><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Pihak II, berkewajiban untuk melaporkan kegiatan tersebut pada Polsek/Dishub setempat.</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Pihak II, bersedia menanggung/megganti segala bentuk kerusakan yang timbul akibat dari<br/>&nbsp;&nbsp;&nbsp;&nbsp;adanya kegiatan tersebut</a><br/>
				<b >Pasal 4</b><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1) Jika terjadi pembatalan oleh pihak II, biaya sewa/uang muka dipotong administrasi 20%.</a><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2) Jika Pembatalan dilakukan oleh pihak 1, maka biaya sewa dikembalikan 100% dan pihak II <br/>&nbsp;&nbsp;&nbsp;&nbsp;tidak menuntut ganti rugi.</a><br/>
				<b >Pasal 5</b><br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Semua perselisihan yang timbul akibat perjanjian ini akan diselesaikan secara musyawarah untuk mufakat.
				Surat perjanjian ini dibuat dan ditandatangani rangkap dua satu lembar untuk Pihak I, satu lembar untuk Pihak II,
				dengan kekuasaan hukum yang sama.<br/></a>
				<a>Demikianlah surat perjanjian ini dibuat dengan kesadaran bersama dan semua isi perjanjiannya telah
				disetujui serta disepakati oleh kedua belah pihak untuk mengikat diri kepada hukum dan segala
				perundang-undangan yang berlaku di Indonesia.<br/></a><br/>
				</div>

                @php
                    $hari = $tglan['hari'];
                    $bulan = $tglan['bulan'];

                    if ($bulan == 1) {
                        $bln = "Januari";
                    } elseif ($bulan == 2) {
                        $bln = "Februari";
                    } elseif ($bulan == 3) {
                        $bln = "Maret";
                    } elseif ($bulan == 4) {
                        $bln = "April";
                    } elseif ($bulan == 5) {
                        $bln = "Mei";
                    } elseif ($bulan == 6) {
                        $bln = "Juni";
                    } elseif ($bulan == 7) {
                        $bln = "Juli";
                    } elseif ($bulan == 8) {
                        $bln = "Agustus";
                    } elseif ($bulan == 9) {
                        $bln = "September";
                    } elseif ($bulan == 10) {
                        $bln = "Oktober";
                    } elseif ($bulan == 11) {
                        $bln = "November";
                    }

                    $tahun = $tglan['tahun'];
                @endphp
				<div style="margin-left:33%; font-size:15px;">Surabaya,&nbsp;{{ $hari." ".$bln." ".$tahun}}
				<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Yang bertanda tangan : </div>

				<div id="id" style="width:230px; margin-left:50px; font-size:15px;"><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pihak I
				<br/>
				<br/>
				<br/>
				<br/>
				{{$pimpinan1->nama}}<br/>
				NIP. {{$pimpinan1->nip}}

				</div>
				<div id="id" style="width:230px; margin-left:130px; font-size:15px;"><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pihak II
				<br/>
				<br/>
				<br/>
				<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                @if ($data->nama_p == null)
                    .....................................<br/>
                @else
                    {{$data->nama_p}} <br/>
                @endif

                @if ($data->nip_p == null)
                    <br/>
                @else
                    {{"NIP. " . $data->nip_p}}
                @endif

				</div>

				</td>
			</tr>
		</table>

	</div>
	</body>
</html>
