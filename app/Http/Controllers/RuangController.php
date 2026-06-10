<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// Models
use App\Models\Ruang;
use App\Models\Peminjaman;

class RuangController extends Controller
{
    public function getDataFasum($no) {
        $data = Ruang::where('status', $no)->get();
        return $data;
    }

    public function dataRuang($ruang = "Auditorium") {

        $data = [];

        $ruang = str_replace("%20"," ",$ruang);

        $list_event = [];

        // cek ruang
        $cek_ruang = Peminjaman::query()
                        ->join('ruang as b', 'peminjaman.id_ruang', '=', 'b.id_ruang')
                        ->where('peminjaman.status', '1')
                        ->where('b.nama_ruang', $ruang)
                        ->selectRaw("
                            peminjaman.institusi,
                            peminjaman.hp,
                            peminjaman.nama_peminjam,
                            peminjaman.id,
                            peminjaman.id_ruang,
                            b.nama_ruang,
                            peminjaman.nama_acara,
                            peminjaman.tgl_pesan,
                            peminjaman.tgl_awal,
                            peminjaman.tgl_akhir,
                            YEAR(peminjaman.tgl_awal) AS tahun_awal,
                            MONTH(peminjaman.tgl_awal) AS bulan_awal,
                            DAY(peminjaman.tgl_awal) AS hari_awal,
                            YEAR(peminjaman.tgl_akhir) AS tahun_akhir,
                            MONTH(peminjaman.tgl_akhir) AS bulan_akhir,
                            DAY(peminjaman.tgl_akhir) AS hari_akhir
                        ")
                        ->orderByDesc('peminjaman.tgl_awal')
                        ->limit(1000)
                        ->get();

        foreach($cek_ruang as $item) {

            $bulan_awal = $item['bulan_awal'];
            $bulan_akhir = $item['bulan_akhir'];
            $hari_akhir = $item['hari_akhir'];

            array_push($list_event, [
                "id" => $item->id,
                "title" => $item->nama_acara,
                "start" => Carbon::parse($item->tahun_awal . "-" . str_pad($bulan_awal, 2, "0", STR_PAD_LEFT) . "-" . $item->hari_awal),
                "end" => Carbon::parse($item->tahun_akhir . "-" . str_pad($bulan_akhir, 2, "0", STR_PAD_LEFT) . "-" . $hari_akhir),
                "extendedProps" => [
                    "date_start" => Carbon::parse($item->tgl_awal)->format("Y-m-d H:i:s"),
                    "date_end" => Carbon::parse($item->tgl_akhir)->format("Y-m-d H:i:s"),
                    "nama_peminjam" => $item->nama_peminjam,
                    "hp" => $item->hp,
                    "institusi" => $item->institusi,
                    "tgl_pesan" => $item->tgl_pesan,
                    "tgl_awal" => $item->tgl_awal,
                    "tgl_akhir" => $item->tgl_akhir
                ]
            ]);
        }

        // get ruang
        $get_ruang = Ruang::where('nama_ruang', $ruang)->first();

        $fasum3 = Ruang::where('status', 3)->get();
        $fasum4 = Ruang::where('status', 4)->get();

        return view('home.ruang', [
            "ruang" => $cek_ruang,
            "list_event" => $list_event,
        ]);

		// $user = $this->session->userdata('username');
		// $data['hak'] = $this->Jadwal->gethak($user);
		// echo $this->db->last_query();

		// if($user==null){
		// 	$data['as'] = "data";
        //     $this->load->view('header',$data);
        //     $this->load->view('calendar',$data);
        //     $this->load->view('footer',$data);

		// 	//echo "///";
		// 	//print_r($data);
		// }else {
		// 	$data['as'] = "";


		// 	$data['user'] = $this->Jadwal->getuser($user);
		// 	//print_r ($data['user']);
		// 	$this->load->view('header',$data);
		// 	$this->load->view('calendar',$data);
		// 	$this->load->view('footer',$data);
		// 	//$data['tabel'] = $this->Jadwal->cek();
		// }

    }
}
