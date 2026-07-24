<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use DB;

// Models
use App\Models\Ruang;
use App\Models\Peminjaman;
use App\Models\PimpinanUmum;
use App\Models\Pusbis;
use App\Models\Pimpinan;

class HomeController extends Controller
{
    public function index()
    {
        return view('home.index');
    }

    public function getDataRuang($name = "Auditorium") {

        $data = [];

        $ruang = str_replace("%20", " ", $name);

        $list_event = [];

        // cek ruang
        $cek_ruang = Peminjaman::query()
                        ->join('ruang as b', 'peminjaman.id_ruang', '=', 'b.id_ruang')
                        ->leftJoin('pusbis as p', 'p.id_acara', '=', 'peminjaman.id')
                        ->where('peminjaman.status', '1')
                        ->where('b.nama_ruang', $ruang)
                        ->selectRaw("
                            peminjaman.jumlah_peserta,
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
                            DAY(peminjaman.tgl_akhir) AS hari_akhir,
                            EXISTS(SELECT 1 FROM pusbis p WHERE p.id_acara = peminjaman.id) AS has_pusbis
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
                    "has_pusbis" => $item->has_pusbis,
                    "acara_id" => $item->id,
                    "nama_acara" => $item->nama_acara,
                    "nama_peminjam" => $item->nama_peminjam,
                    "jumlah_peserta" => $item->jumlah_peserta,
                    "institusi" => $item->institusi,
                    "hp" => $item->hp,
                    "date_start" => Carbon::parse($item->tgl_awal)->format("Y-m-d H:i:s"),
                    "date_end" => Carbon::parse($item->tgl_akhir)->format("Y-m-d H:i:s"),
                    "tgl_pesan" => $item->tgl_pesan,
                    "tgl_awal" => $item->tgl_awal,
                    "tgl_akhir" => $item->tgl_akhir
                ]
            ]);
        }

        // get ruang
        $get_ruang = Ruang::where('nama_ruang', $ruang)->first();
        // dd($get_ruang);

        return view('home.ruang', [
            "ruang" => $cek_ruang,
            "list_event" => $list_event,
            "data_ruang" => $get_ruang
        ]);
    }

    public function bookRuang(Request $request) {
        // dd($request->ruang_id);
        $tanggal_pesan = Carbon::now();

        if($request->booking_date && $request->booking_time) {
            $tanggal_pesan = Carbon::parse($request->booking_date . " " . $request->booking_time);
        }

        $peminjaman = new Peminjaman();

        if($request->acara_id == 0) {
            $peminjaman->id_ruang = $request->ruang_id;
            $peminjaman->nama_acara = $request->name;
            $peminjaman->nim = $request->nim;
            $peminjaman->nama_peminjam = $request->responsible;
            $peminjaman->jumlah_peserta = $request->participants_number;
            $peminjaman->institusi = $request->institution;
            $peminjaman->hp = $request->phone_number;
            $peminjaman->tgl_awal = Carbon::parse($request->date_start . " " . $request->time_start);
            $peminjaman->tgl_akhir = Carbon::parse($request->date_end . " " . $request->time_end);
            $peminjaman->tgl_pesan = $tanggal_pesan;
            $peminjaman->status = 1;
            $peminjaman->save();
        } else {
            $peminjaman = Peminjaman::find($request->acara_id);
        }

        // Input Pusbis
        if(auth()->check() && auth()->user()->role == "admin") {
            $pusbis = new Pusbis();
            $pusbis->pj = $request->responsible;
            $pusbis->tlp = $request->phone_number;
            $pusbis->id_acara = $peminjaman->id;
            $pusbis->tgl_s =  Carbon::parse($request->date_start . " " . $request->time_start);
            $pusbis->jml_p = $request->participants_number;
            $pusbis->id_ruang = $request->ruang_id;
            $pusbis->radio = $request->category;
            $pusbis->catering = $request->catering;
            $pusbis->us = $request->uang_sewa;
            $pusbis->ub = $request->bayar;
            $pusbis->um = $request->uang_muka;
            // $pusbis->lain = $request->lain;
            $pusbis->sisa = $request->sisa;
            $pusbis->lain_lain = $request->lain_lain;
            $pusbis->status = 1;
            $pusbis->save();
        }

        return redirect('ruangan/' . $request->ruang_name);
    }

    public function deleteEvent($event_id) {
        $peminjaman = Peminjaman::find($event_id);
        if(! $peminjaman) {
            return redirect()->back();
        }

        $peminjaman->delete();
        return redirect()->back();
    }

    public function setSurat($id) {

        // Get Peminjaman Umum
        $data_peminjaman = Peminjaman::query()
            ->from('peminjaman as a')
            ->join('ruang as c', 'a.id_ruang', '=', 'c.id_ruang')
            ->where('a.status', 1)
            ->where('a.id', $id)
            ->selectRaw("
                a.*,
                c.nama_ruang,
                DATE_FORMAT(a.tgl_awal, '%d-%m-%Y') AS date,
                DATE_FORMAT(a.tgl_akhir, '%d-%m-%Y') AS date_akhir,
                DATE_FORMAT(a.tgl_awal, '%r') AS waktu,
                DATE_FORMAT(a.tgl_akhir, '%r') AS waktu_akhir
            ")
            ->first();

        // Get Pimpinan Umum
        $pimpinan = PimpinanUmum::all();

		$data['data'] = $data_peminjaman;
		$data['pimpinan'] = $pimpinan;

		$data['tanggal'] = date("d-m-Y");
        $start_date = new DateTime($data_peminjaman->tgl_awal);
        $end_date = new DateTime($data_peminjaman->tgl_akhir);

        $interval = $start_date->diff($end_date);
		// if(strpos(strtolower($data['data']['nama_ruang']),'zoom') >0 ) {
        //     $data['pimpinan'][0]['nip'] ='196605141992032001';
        //     $data['pimpinan'][0]['nama'] ='Dra. Imas Maesaroh, Dip.IM-Lib., M.Lib., Ph.D.';
        //     $data['pimpinan'][0]['jabatan'] ='Kepala PUSTIPD';
		// }
		// print_r ($data['pimpinan']);
		// $this->load->view('print/surat_umum',$data);
        // dd($data);
        return view('print.surat_umum', [
            "data" => $data_peminjaman,
            "pimpinan" => $pimpinan,
            "tanggal" => date("d-m-Y"),
            "interval" => $interval
        ]);

	}

    public function printSurat($id) {

        $op = 1;
        $no = $id;

        $data = Pusbis::query()
            ->from('pusbis as a')
            ->join('peminjaman as b', 'a.id_acara', '=', 'b.id')
            ->join('ruang as c', 'b.id_ruang', '=', 'c.id_ruang')
            ->where('a.status', 1)
            ->when($op == 0, function ($query) use ($no) {
                $query->where('a.id', $no);
            }, function ($query) use ($no) {
                $query->where('a.id_acara', $no);
            })
            ->selectRaw("
                a.*,
                b.*,
                c.nama_ruang,
                DATE_FORMAT(b.tgl_awal, '%d-%m-%Y') AS date
            ")
            ->first();

        if(! $data) {
            return redirect()->back();
        }

        $pimpinan1 = Pimpinan::find(1);
        $pimpinan2 = Pimpinan::find(2);
        $pimpinan3 = Pimpinan::find(3);

        $now = Carbon::now();

        $tglan = [
            'hari' => $now->day,
            'bulan' => $now->month,
            'tahun' => $now->year,
        ];

        $perjanjian = [
            'hari' => $now->day,
            'bulan' => $now->month,
            'tahun' => $now->year,
        ];

        return view('print.surat', [
            "data" => $data,
            "pimpinan1" => $pimpinan1,
            "pimpinan2" => $pimpinan2,
            "pimpinan3" => $pimpinan3,
            "tglan" => $tglan,
            "perjanjian" => $perjanjian
        ]);

    }

    public function getDataFasilitasUmum() {

    }

    public function getDataFasilitasKhusus() {

    }

    public function getDataFasilitasLainnya() {

    }
}
