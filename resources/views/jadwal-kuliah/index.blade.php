@extends('layouts.app')

@section('content')
    <div class="row justify-content-center py-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    {{ __('Penjadwalan Mata Kuliah') }}

                    <div class="d-flex gap-2">
                        <form action="{{ route('jadwal-kuliah.import') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="file-upload" class="btn btn-primary btn-sm">
                                <i class="fa fa-upload"></i>
                                <input id="file-upload" type="file" name="file" style="display: none;" onchange="this.form.submit()">
                            </label>
                        </form>
                        <a href="{{ url('jadwal-kuliah/export') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-download"></i>
                        </a>
                        <button type="button" class="bg-primary text-white rounded float-end" data-bs-toggle="modal" data-bs-target="#tambahModalJadwal">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive table-bordered table-striped table-hover">
                            <thead>
                                <tr class="align-middle text-center">
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Kuliah</th>
                                    <th>Mata Kuliah</th>
                                    <th>Dosen Pengampu</th>
                                    <th>Jumlah<br>Mahasiswa</th>
                                    <th>Ruang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                @foreach ($jadwals as $row)
                                    <tr>
                                        <td class="text-center">{{ $no }}</td>
                                        <td>{{ \Carbon\Carbon::parse($row->hari)->format('d F Y') }}</td>
                                        <td class="text-center">{{ \Carbon\Carbon::parse($row->waktu_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($row->waktu_selesai)->format('H:i') }}</td>
                                        <td>{{ $row->mata_kuliah }}</td>
                                        <td>{{ $row->dosen }}</td>
                                        <td class="text-center">{{ $row->jumlah_mahasiswa }}</td>
                                        <td class="text-center">{{ $row->ruang }}</td>
                                        <td class="text-center">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $row->id }}">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $row->id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>

                                    {{-- Edit Modal --}}
                                    <div class="modal fade" id="editModal{{ $row->id }}" tabindex="-1" aria-labelledby="editModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="d-flex">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Jadwal Kuliah</h5>
                                                        <p class="text-muted">
                                                            {{ \Carbon\Carbon::parse($row->hari)->format('d/m/Y') }}
                                                        </p>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form method="post" action="{{ route('jadwal-kuliah.update', $row->id) }}">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="modal-body">
                                                        <div class="form-floating d-flex mb-3">
                                                            <div class="col-md-5">
                                                                <label for="floatingMulai" class="ps-2">Mulai Jam</label>
                                                                <input type="time" class="form-control" id="floatingMulai" name="waktu_mulai" value="{{ $row->waktu_mulai }}" placeholder="Mulai Jam">
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-5">
                                                                <label for="floatingSelesai" class="ps-2">Selesai Jam</label>
                                                                <input type="time" class="form-control" id="floatingSelesai" name="waktu_selesai" value="{{ $row->waktu_selesai }}" placeholder="Selesai Jam">
                                                            </div>
                                                            <div class="col-md-1"></div>
                                                        </div>
                                                        <div class="form-floating mb-3">
                                                            <input type="text" class="form-control" id="floatingRuang" name="ruang" value="{{ $row->ruang }}" placeholder="Ruang Kelas">
                                                            <label for="floatingRuang">Ruang</label>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-warning">Simpan</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- Edit Modal --}}

                                    {{-- Delete Modal --}}
                                    <div class="modal fade" id="deleteModal{{ $row->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div class="d-flex">
                                                        <h5 class="modal-title" id="deleteModalLabel">Hapus Data Jadwal Kuliah</h5>
                                                    </div>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <form method="post" action="{{ route('jadwal-kuliah.destroy', $row->id) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus jadwal kuliah ini?</p>
                                                        <p class="text-muted">
                                                            {{ \Carbon\Carbon::parse($row->hari)->format('l, d F Y') }} - {{ $row->mata_kuliah }}
                                                        </p>
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    {{-- Delete Modal --}}

                                    <?php $no++; ?>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="tambahModalJadwal" tabindex="-1" aria-labelledby="tambahModalJadwalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalJadwalLabel">Tambah Jadwal Mata Kuliah</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Form tambah data -->
                <form method="post" action="{{ url('jadwal-kuliah') }}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingMatkul" name="mata_kuliah"
                                placeholder="Mata Kuliah">
                            <label for="floatingMatkul">Mata Kuliah</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingDosen" name="dosen"
                                placeholder="Nama Dosen">
                            <label for="floatingDosen">Dosen</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="floatingHari" name="hari">
                            <label for="floatingHari">Hari</label>
                        </div>
                        <div class="form-floating d-flex mb-3">
                            <div class="col-md-5">
                                <label for="floatingMulai" class="ps-2">Mulai Jam</label>
                                <input type="time" class="form-control" id="floatingMulai" name="waktu_mulai"
                                    placeholder="Mulai Jam">
                            </div>
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <label for="floatingSelesai" class="ps-2">Selesai Jam</label>
                                <input type="time" class="form-control" id="floatingSelesai" name="waktu_selesai"
                                    placeholder="Selesai Jam">
                            </div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="floatingRuang" name="ruang"
                                placeholder="Ruang Kelas">
                            <label for="floatingRuang">Ruang</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="floatingJumlah" name="jumlah_mahasiswa"
                                placeholder="Jumlah Mahasiswa">
                            <label for="floatingJumlah">Jumlah Mahasiswa</label>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">Tambah</button>
                    </div>
                </form>
                <!-- Form tambah data -->

            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
@endsection
