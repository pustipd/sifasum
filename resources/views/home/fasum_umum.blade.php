@extends('master')

@section('content')

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
                    {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
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
                    <form action="">
                        @csrf
                        <div class="form-group">
                            <label for="" class="form-label">Nama Kegiatan</label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">NIM</label>
                            <input type="text" class="form-control" name="nim">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" name="responsible">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control" name="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Jumlah Peserta</label>
                            <input type="number" class="form-control" name="participants_number">
                        </div>
                        <div class="form-group">
                            <label for="" class="form-label">Institusi</label>
                            <input type="text" class="form-control" name="Institution">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>
    <script>
        let list_event = @json($list_event);

        document.addEventListener('DOMContentLoaded', function() {

            let calendarEl = document.getElementById('calendar');

            let calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                displayEventTime: false,

                dateClick: function(info) {
                    $("#add-event-modal").modal('show');
                },

                eventClick: function(info) {
                    console.log(info.event);

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

                    $("#event-modal").modal('show');

                    // contoh detail event
                    // window.location.href = '/booking/' + info.event.id;
                },

                events: list_event
            });

            calendar.render();
        });
    </script>
@endsection
