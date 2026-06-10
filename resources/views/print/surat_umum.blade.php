<script type="text/javascript" src="{{asset('assets/js/jquery-4.0.0.min.js')}}"></script>
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
		window.print();
		//surat();
		//$('#detail-data').show();
	});
</script>
<html>

	<head><title>Surat Keterangan {{$data->nama_acara}}</title></head>

	<!-- <body oncontextmenu='return false;' onkeydown='return false;' onmousedown='return false;'> -->
	<body >

	<div id="perjanjian">

		<table width="650px;" style=margin:auto;>
			<tr>
				<td>

			<div id="header">
				<div id="gambar2"><img style="height:8%; width:130%;" src="{{asset('assets/img/img2.png')}}"/></div>
				<div id="tulisan_uin2">
					<strong>KEMENTRIAN AGAMA REPUBLIK INDONESIA
					<br/>UNIVERSITAS ISLAM NEGERI SUNAN AMPEL SURABAYA<br/></strong><span style="font-size:0.7em">
					Jl. Jend. A. Yani 117 Surabaya 60237 Telp. 031-8410298 Fax. 031-8413300<br/>E-Mail : info@uinsby.ac.id Website : www.uinsby.ac.id</span></div>
				</div>
				<div id="garis"></div>
				<br/>
				<div style="font-size:20px; text-align:center;">
					<strong>IJIN PENGGUNAAN ASET</strong></div>
				<br/>
				<br/>


				<div >
							Saya yang bertandatangan di bawah ini:
					<table>
						<tr>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>Nama</td>
							<td></td>
							<td>:</td>
							<td>{{$pimpinan[0]->nama}}</td>
						</tr>
						<tr>
							<td></td>
							<td>NIP</td>
							<td></td>
							<td>:</td>
							<td>{{$pimpinan[0]->nip}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Jabatan</td>
							<td></td>
							<td>:</td>
							<td> {{$pimpinan[0]->jabatan}}UIN Sunan Ampel Surabaya </td>
						</tr>
						</table>
				</div>
				<br/>
				<div >
				<a>Berdasarkan surat penyataan terlampir, maka dengan ini memberikan ijin kepada:</a>
				<br/>
				<table>
						<tr>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Nama</td>
							<td></td>
							<td>:</td>
							<td>{{$data->nama_peminjam}}</td>
						</tr>
						<tr>
							<td>NIM / NIP</td>
							<td></td>
							<td>:</td>
							<td>{{$data->nim}}</td>
						</tr>
						<tr>
							<td>Unit Kerja / Fak.</td>
							<td></td>
							<td>:</td>
							<td>{{$data->institusi}} </td>
						</tr>
						<tr>
							<td>Nomor Tlp./HP</td>
							<td></td>
							<td>:</td>
							<td>{{$data->hp}} </td>
						</tr>
						<tr>
							<td></td>
							<td> </td>
						</tr>
						</table>

				<a>untuk menggunakan {{$data->nama_ruang}} sebagai tempat pelaksanaan kegiatan {{$data->nama_acara}}. pada
				hari/tanggal
                @if ($interval->days <= 0)
                    {{$data->date}}
                @else
                    {{$data->date . " sampai " . $data->date_akhir}}
                @endif

				waktu
				{{$data->waktu . " sampai " . $data->waktu_akhir}}<br/></a><br/>
				<a>Demikian surat ijin ini diberikan untuk dipergunakan sebagaimana mestinya.<br/></a><br/>
				</div>
				<div style="margin-left:60%; font-size:15px;">Surabaya,&nbsp;{{$tanggal}}
					<br/>
					{{$pimpinan[0]->jabatan . ' UIN Sunan Ampel Surabaya' }}


					<div id="id" style="width:230px;font-size:15px;">
					<br/>
					<br/>
					<br/>
					<br/>
					{{$pimpinan[0]->nama}}
					<br/>NIP :
					{{$pimpinan[0]->nip}}

					</div>
				</div>
				Tembusan Yth.<br/>
				1. Saudara JFU, untuk diketahui;<br/>
				2. Saudara SATPAM, untuk diketahui;<br/>
				3. Koordinator Masjid Ulul Albab.<br/>
				</td>
			</tr>
		</table>


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
	<div id="perjanjian">

		<table width="650px;" style=margin:auto;>
			<tr>
				<td>


			<div id="header">
				<div id="gambar2"><img style="height:8%; width:130%;" src="{{asset('assets/img/img2.png')}}"/></div>
				<div id="tulisan_uin2"><strong>KEMENTRIAN AGAMA REPUBLIK INDONESIA<br/>UNIVERSITAS ISLAM NEGERI SUNAN AMPEL SURABAYA<br/></strong><span style="font-size:0.7em">
				Jl. Jend. A. Yani 117 Surabaya 60237 Telp. 031-8410298 Fax. 031-8413300<br/>E-Mail : info@uinsby.ac.id Website : www.uinsby.ac.id</span></div>
				</div>
				<div id="garis"></div>
				<br/>
				<div style="font-size:20px; text-align:center;"><strong>SURAT PERNYATAAN KESANGGUPAN</strong></div>
				<br/>
				<br/>


				<div >
							Saya yang bertandatangan di bawah ini:
					<table>
						<tr>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td>Nama</td>
							<td></td>
							<td>:</td>
							<td>{{$data->nama_peminjam}}</td>
						</tr>
						<tr>
							<td></td>
							<td>NIM / NIP</td>
							<td></td>
							<td>:</td>
							<td>{{$data->nim}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Fakultas / Unit Kerja</td>
							<td></td>
							<td>:</td>
							<td>{{$data->institusi}}</td>
						</tr>
						<tr>
							<td></td>
							<td>Nomor Telepon / HP</td>
							<td></td>
							<td>:</td>
							<td>{{$data->hp}}</td>
						</tr>
						</table>
				</div>
				<br/>
				<div >
				<a>bertanggungjawab atas peminjaman {{$data->nama_ruang}} untuk kegiatan
				{{$data->nama_acara}} , pada tanggal
                @if ($interval->days <= 0)
                    {{ $data->date }}
                @else
                    {{$data->date . " sampai " . $data->date_akhir;}}
                @endif
				,dengan ini menyatakan sanggup untuk:</a>
				<br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.&nbsp; Menjaga kebersihan didalam dan di sekitar gedung selama pelaksanaan kegiatan.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.&nbsp; Tidak merokok dalam gedung dan tidak mengijinkan adanya aktifitas merokok bagi semua
				yang <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				terlibat dalam kegiatan penggunaan gedung.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.&nbsp; Ikut membantu ketertiban parkir peserta/pengunjung disekitar gedung selama kegiatan berlangsung.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.&nbsp; Tidak diperkenankan untuk mengadakan pungutan biaya/uang pada kegiatan
				tersebut, atau<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				bekerjasama dengan Lembaga lain yang berakibat mendatangkan keuntungan kecuali ada ijin tertulis
				<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;dari Pusat Bisnis UIN Sunan Ampel Surabaya.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.&nbsp; Bertanggungjawab/mengganti kerusakan gedung atau peralatan yang ada di dalam gedung,
				akibat <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				kelalaian saya atau peserta kegiatan.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.&nbsp; Tidak diperbolehkan bekerja sama dengan pedagang dari luar dan atau mendatangkan pedagang
				dari <br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				luar untuk berjualan dikampus.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.&nbsp; Dibubarkan dengan paksa jika kegiatannya melebihi waktu pelaksanaan yang telah diijinkan
				<br/> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				Pengelola Gedung dan atau melanggar 6 (Enam) poin diatas.</a><br/>
				<br/>
				<a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.&nbsp; Dipindahkan ke Gedung/ruangan lain apabila pihak Universitas memerlukan untuk kegiatan yang
				<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;lebih penting.</a><br/>
				<br/>

				<a>Demikianlah surat Pernyataan Kesanggupan ini kami buat untuk digunakan sebagaimana mestinya.<br/></a><br/>
				</div>
				<div style="margin-left:60%; font-size:15px;">Surabaya,&nbsp;{{$tanggal}}
					<br/>
					<br/>Yang menyatakan,


					<div id="id" style="width:230px;font-size:15px;">
					<br/>
					<br/>
					<br/>
					<br/>
					{{$data->nama_peminjam}}


					</div>
				</div>

				</td>
			</tr>
		</table>


	</div>

	</body>
</html>
