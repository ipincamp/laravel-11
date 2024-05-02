@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Detail Pembayaran -->
        <div class="row mt-4 mb-3 justify-content-center">
            <div class="col-md-12">
                <div class="mb-4 text-center">
                    <h3>Tabel Angsuran SPP</h3>
                    <h3>SMK Media Solusi Anak Bangsa</h3>
                    <h3>TA. 2023/2024</h3>
                </div>

                <div class="card">
                    <div class="card-title">
                        <div class="mt-3 ms-3 mb-0">
                            <!-- Button Modal Tambah -->
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                data-bs-target="#modalTambahPembayaran">
                                <i class="fas fa-plus"></i> Tambah Pembayaran
                            </button>
                            <!-- Button Modal Tambah -->
                            <!-- Button Export -->
                            <a href="{{ route('pembayaran.export') }}" class="btn btn-secondary">
                                <i class="fas fa-file-export"></i> Export
                            </a>
                            <!-- Button Export -->
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="angsuran" class="table table-striped table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2" class="text-center align-middle">NIS</th>
                                    <th rowspan="2" class="text-center align-middle">Nama</th>
                                    <th rowspan="2" class="text-center align-middle">Kelas</th>
                                    <th colspan="6" class="text-center align-middle">Bulan</th>
                                    <th rowspan="2" class="text-center align-middle">Total</th>
                                    <th rowspan="2" class="text-center align-middle">Aksi</th>
                                </tr>
                                <tr>
                                    <td class="fw-bold text-center">Jan</td>
                                    <td class="fw-bold text-center">Feb</td>
                                    <td class="fw-bold text-center">Mar</td>
                                    <td class="fw-bold text-center">Apr</td>
                                    <td class="fw-bold text-center">Mei</td>
                                    <td class="fw-bold text-center">Jun</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pembayaran as $row)
                                    <tr>
                                        <td class="text-center">{{ $row->nis }}</td>
                                        <td>{{ $row->nama }}</td>
                                        <td class="text-center">{{ $row->kelas }}</td>
                                        <td class="text-end">{{ $row->jan }}</td>
                                        <td class="text-end">{{ $row->feb }}</td>
                                        <td class="text-end">{{ $row->mar }}</td>
                                        <td class="text-end">{{ $row->apr }}</td>
                                        <td class="text-end">{{ $row->mei }}</td>
                                        <td class="text-end">{{ $row->jun }}</td>
                                        <td class="text-end">
                                            {{ $row->jan + $row->feb + $row->mar + $row->apr + $row->mei + $row->jun }}</td>
                                        <td class="text-center">
                                            <!-- Tombol Hapus Modal -->
                                            <button type="button" class="btn btn-outline-danger btn-sm"
                                                data-bs-toggle="modal" data-bs-target="#modalHapus{{ $row->nis }}">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                            <!-- Tombol Hapus Modal -->
                                        </td>
                                    </tr>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade" id="modalHapus{{ $row->nis }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="modalHapus{{ $row->nis }}Label" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="modalHapus{{ $row->nis }}Label">
                                                        Hapus Data</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('pembayaran.destroy', $row->nis) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <div class="modal-body">
                                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                                        <span>{{ $row->nis }} - {{ $row->nama }}</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger">Hapus</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Hapus -->
                                @endforeach

                                <!-- item terakhir -->
                                <tr>
                                    <td colspan="3" class="text-center fw-bold">Total</td>
                                    <td class="fw-bold text-end">{{ $jan }}</td>
                                    <td class="fw-bold text-end">{{ $feb }}</td>
                                    <td class="fw-bold text-end">{{ $mar }}</td>
                                    <td class="fw-bold text-end">{{ $apr }}</td>
                                    <td class="fw-bold text-end">{{ $mei }}</td>
                                    <td class="fw-bold text-end">{{ $jun }}</td>
                                    <td class="fw-bold text-end">{{ $jan + $feb + $mar + $apr + $mei + $jun }}</td>
                                    <td></td>
                                    <td class="d-none"></td>
                                    <td class="d-none"></td>
                                </tr>
                                <!-- item terakhir -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mb-4"></div>
    </div>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambahPembayaran" tabindex="-1" aria-labelledby="modalTambahPembayaranLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahPembayaranLabel">Tambah Pembayaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('pembayaran.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="number" class="form-control w-75" id="inputNIS" placeholder="NIS"
                                name="nis" required>
                            <input type="text" class="form-control w-25" id="inputKelas" placeholder="Kelas"
                                name="kelas" required>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="inputNama" placeholder="Nama" name="nama"
                                required>
                            <label for="inputNama">Nama</label>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" placeholder="Januari" aria-label="Januari"
                                name="jan">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" placeholder="Februari" aria-label="Februari"
                                name="feb">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" placeholder="Maret" aria-label="Maret"
                                name="mar">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" placeholder="April" aria-label="April"
                                name="apr">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" placeholder="Mei" aria-label="Mei"
                                name="mei">
                            <span class="input-group-text">.00</span>
                        </div>
                        <div class="input-group">
                            <span class="input-group-text">Rp.</span>
                            <input type="number" class="form-control" placeholder="Juni" aria-label="Juni"
                                name="jun">
                            <span class="input-group-text">.00</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal Tambah -->
@endsection
