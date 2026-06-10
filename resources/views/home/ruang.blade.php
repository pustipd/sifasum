@extends('master')

@section('content')
    <style>
        .swal-top {
            z-index: 99999 !important;
        }

        .swal2-container {
            z-index: 20000 !important;
        }
    </style>

    <div id="calendar"></div>

    <div class="modal" id="event-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-borderless">
                        <colgroup>
                            <col style="width:1%">
                            <col style="width:1%">
                            <col>
                        </colgroup>
                        <tbody id="table-event-body">
                            <tr>
                                <td class="text-nowrap">Seminar</td>
                                <td style="width: 1%">:</td>
                                <td>Budi</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @auth
                        @if (auth()->user()->role == 'admin')
                            <a class="btn btn-outline-primary" id="btn-print" href="#">Print</a>
                            <button id="btn-delete" type="button" class="btn btn-danger btn-delete">
                                Hapus
                            </button>
                        @endif
                    @endauth

                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="add-event-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kegiatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('ruangan/book') }}" method="POST">
                        @csrf

                        <input type="hidden" name="ruang_id" value="{{ $data_ruang->id_ruang }}">
                        <input type="hidden" name="ruang_name" value="{{ $data_ruang->nama_ruang }}">
                        <input type="hidden" id="harga-ruang" name="harga_ruang" value="{{ $data_ruang->harga }}">
                        <input type="hidden" name="acara_id" id="acara-id" value="0">
                        {{-- <div class="mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_user" id="type-mahasiswa"
                                    value="mahasiswa" checked>
                                <label class="form-check-label" for="type-mahasiswa">Mahasiswa</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="type_user" id="type-lain-mahasiswa"
                                    value="lain_mahasiswa">
                                <label class="form-check-label" for="type-lain-mahasiswa">Lain Mahasiswa</label>
                            </div>
                        </div> --}}


                        @if (auth()->check() && auth()->user()->role == 'admin')
                            <div id="form-lain-mahasiswa">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Nama Kegiatan</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="responsible">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="phone_number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Jumlah Peserta</label>
                                    <input type="number" class="form-control" name="participants_number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Institusi</label>
                                    <input type="text" class="form-control" name="institution">
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Mulai</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="date_start">
                                        </div>

                                        <div class="col-md-6">
                                            <input type="time" class="form-control" name="time_start">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Akhir</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="date_end">
                                        </div>

                                        <div class="col-md-6">
                                            <input type="time" class="form-control" name="time_end">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="" class="form-label">NIP</label>
                                    <input type="text" class="form-control" name="nip">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="position">
                                </div>

                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Kategori</label>
                                    <select name="category" class="form-select" id="category"
                                        onchange="hitung_semua()">
                                        <option value="2">Pegawai/Mahasiswa/Alumni</option>
                                        <option value="3">Umum</option>
                                        <option value="4">Corporate Swasta</option>
                                        <option value="1">Corporate Pemerintah/Sosial</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label d-block">Catering</label>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="catering" id="catering-ya"
                                            value="1" required checked onchange="hitung_semua()">
                                        <label class="form-check-label" for="catering-ya">
                                            Ya
                                        </label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="catering"
                                            id="catering-tidak" value="2" onchange="hitung_semua()">
                                        <label class="form-check-label" for="catering-tidak">
                                            Tidak
                                        </label>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Uang Sewa</label>
                                            <input type="number" class="form-control" id="uang-sewa" name="uang_sewa"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="" class="form-label">Charge</label>
                                            <input type="number" class="form-control" id="charge" name="charge"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Bayar</label>
                                            <input type="number" class="form-control" id="bayar" name="bayar"
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Uang Muka</label>
                                            <input type="number" class="form-control" id="uang-muka" name="uang_muka"
                                                onkeyup="hitung_semua()">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="" class="form-label">Sisa</label>
                                            <input type="number" class="form-control" id="sisa" name="sisa"
                                                readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Lain-lain</label>
                                    <input type="text" class="form-control" name="lain_lain">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Nama Pemesan</label>
                                    <input type="text" class="form-control" name="nama_pemesan">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Alamat Pemesan</label>
                                    <input type="text" class="form-control" name="alamat_pemesan">
                                </div>
                            </div>
                        @elseif(auth()->check() && auth()->user()->role == 'user')
                            <div id="form-mahasiswa">
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Nama Kegiatan</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">NIM</label>
                                    <input type="text" class="form-control" name="nim">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="responsible">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" name="phone_number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Jumlah Peserta</label>
                                    <input type="number" class="form-control" name="participants_number">
                                </div>
                                <div class="form-group mb-3">
                                    <label for="" class="form-label">Institusi</label>
                                    <input type="text" class="form-control" name="institution">
                                </div>
                                <div class="form-group mb-3">
                                    <label>Tanggal Mulai</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="date_start">
                                        </div>

                                        <div class="col-md-6">
                                            <input type="time" class="form-control" name="time_start">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Akhir</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="date_end">
                                        </div>

                                        <div class="col-md-6">
                                            <input type="time" class="form-control" name="time_end">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label>Tanggal Pesan (Optional)</label>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="date" class="form-control" name="booking_date">
                                        </div>

                                        <div class="col-md-6">
                                            <input type="time" class="form-control" name="booking_time">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                        @endif

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="day-modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Kegiatan Dalam Satu Hari</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="table-day" class="table table-striped">
                        <tr>
                            <th>Acara</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                        </tr>
                        <tbody id="table-day-body">

                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script>
        let list_event = @json($list_event);
        let is_login = @json(auth()->check());
        let user = @json(auth()->user());

        document.addEventListener('DOMContentLoaded', function() {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                displayEventTime: false,
                eventDisplay: 'block',
                dateClick: function(info) {

                    if (!is_login) {
                        let html = '';

                        const clickedDate = info.dateStr;

                        const events = calendar.getEvents().filter(event => {

                            const start = event.startStr.substring(0, 10);

                            return start === clickedDate;

                        });

                        if (events.length === 0) {
                            // html = '<li>Tidak ada event</li>';
                        } else {

                            events.forEach(event => {
                                console.log(event.title)
                                html += `
                                <tr>
                                    <td>${event.title}</td>
                                    <td>${event.extendedProps.date_start}</td>
                                    <td>${event.extendedProps.date_end}</td>
                                </tr>
                            `;

                            });

                        }

                        $("#table-day-body").empty();
                        $("#table-day-body").append(html);
                        $("#day-modal").modal('show');

                    } else {
                        $("#add-event-modal").modal('show');
                    }

                },

                eventClick: function(info) {

                    let html = '';

                    html += `
                        <tr>
                            <td>Nama Acara</td>
                            <td>:</td>
                            <td>${info.event.title}</td>
                        </tr>
                        <tr>
                            <td>Penanggung Jawab</td>
                            <td>:</td>
                            <td>${info.event.extendedProps.nama_peminjam}</td>
                        </tr>
                        <tr>
                            <td>No HP</td>
                            <td>:</td>
                            <td>${info.event.extendedProps.hp}</td>
                        </tr>
                        <tr>
                            <td>Institusi</td>
                            <td>:</td>
                            <td>${info.event.extendedProps.institusi}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Pesan</td>
                            <td>:</td>
                            <td>${info.event.extendedProps.tgl_pesan}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Mulai</td>
                            <td>:</td>
                            <td>${info.event.extendedProps.tgl_awal}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Akhir</td>
                            <td>:</td>
                            <td>${info.event.extendedProps.tgl_akhir}</td>
                        </tr>
                    `;

                    $("#table-event-body").empty();
                    $("#table-event-body").append(html);

                    if(is_login) {
                        let url = "{{ route('ruangan.event.destroy', ['event_id' => '__ID__']) }}";
                        url = url.replace('__ID__', info.event.id);
                        $("#btn-delete").attr('data-url', url);

                        if(user['role'] == 'admin') {
                            if(info.event.extendedProps.has_pusbis == 0) {
                                // Set Data
                                $("#acara-id").val(info.event.extendedProps.acara_id);

                                $("input[name='name']").val(info.event.title);
                                $("input[name='responsible']").val(info.event.extendedProps.nama_peminjam);
                                $("input[name='phone_number']").val(info.event.extendedProps.hp);
                                $("input[name='participants_number']").val(info.event.extendedProps.jumlah_peserta);
                                $("input[name='institution']").val(info.event.extendedProps.institusi);

                                let date_start = info.event.extendedProps.date_start.split(' ');
                                let date_end = info.event.extendedProps.date_end.split(' ');
                                let date_pesan = info.event.extendedProps.tgl_pesan.split(' ');

                                $("input[name='date_start']").val(date_start[0]);
                                $("input[name='time_start']").val(date_start[1]);
                                $("input[name='date_end']").val(date_end[0]);
                                $("input[name='time_end']").val(date_end[1]);
                                $("input[name='booking_date']").val(date_pesan[0]);
                                $("input[name='booking_time']").val(date_pesan[1]);

                                $("#add-event-modal").modal('show');
                            } else {
                                $("#btn-print").attr('href', '/print/kgt/' + info.event.id);
                                $("#event-modal").modal('show');
                            }
                        } else if(user['role'] == 'user') {
                            $("#btn-print").attr('href', '/print/event/' + info.event.id);
                            $("#event-modal").modal('show');
                        }
                    } else {
                        $("#event-modal").modal('show');
                    }

                    // contoh detail event
                    // window.location.href = '/booking/' + info.event.id;
                },

                events: list_event
            });

            calendar.render();
        });

        document.querySelectorAll('.btn-delete').forEach(button => {

            button.addEventListener('click', function() {

                Swal.fire({
                    title: 'Hapus Data?',
                    text: 'Apakah anda yakin ingin menghapus data ini?',
                    icon: 'warning',
                    customClass: {
                        popup: 'swal-top'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {

                    if (result.isConfirmed) {

                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = this.dataset.url;

                        form.innerHTML = `
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="_method" value="DELETE">
                        `;

                        document.body.appendChild(form);
                        form.submit();
                    }

                });

            });

        });
    </script>

    <script>
        function hitung_semua() {
            let category = $('#category').val();
            let catering = 1;
            let jumlah_bayar = 0;
            if (document.getElementById('catering-ya').checked) {
                //ya ceked
                catering = 1;
            } else if (document.getElementById('catering-tidak').checked) {
                //tidak cekked
                catering = 2;
            }

            let harga_ruang_aset = Number($('#harga-ruang').val());
            let bayardis = 0;

            if (category == "1") {
                bayardis = parseInt(Number(harga_ruang_aset) * 0.3);
            } else if (category == "2") {
                bayardis = parseInt(Number(harga_ruang_aset) * 0.4);
            } else if (category == "4") {
                bayardis = parseInt(Number(harga_ruang_aset) * 0.2);
            }

            jumlah_bayar = Number(harga_ruang_aset) - Number(bayardis);

            // uang sewa = usd / us
            // charge = cash
            // bayar = ub
            // uang muka = um
            // sisa = sisaa/sisa

            if (catering == 1) {
                $('#uang-sewa').val(Number(harga_ruang_aset));
                // $('#us').val(Number(harga_ruang_aset));
                $('#charge').val(0);
            } else {
                $('#uang-sewa').val(Number(harga_ruang_aset));;
                $('#charge').val(1000000);
                jumlah_bayar = Number(jumlah_bayar) + 1000000;
            }

            $('#bayar').val(jumlah_bayar);
            let uang_muka = $('#uang-muka').val();

            let sisa = Number(jumlah_bayar) - Number(uang_muka);
            $('#sisa').val(sisa);

        }

        $(document).ready(function() {
            hitung_semua();
            // $("input[name='type_user']").on("change", function(e) {
            //     if ($(this).val() == "lain_mahasiswa") {
            //         $("#form-mahasiswa").hide();
            //         $("#form-lain-mahasiswa").show();

            //     } else {
            //         $("#form-lain-mahasiswa").hide();
            //         $("#form-mahasiswa").show();
            //     }
            // });
        });
    </script>
@endsection
