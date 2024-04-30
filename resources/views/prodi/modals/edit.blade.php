{{-- Edit Modal --}}
<div class="modal fade" id="modalEditProdi{{ $row->id }}" tabindex="-1" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Prodi</h5>
                    <p class="text-muted">
                        {{ $row->kode }}
                    </p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('prodi.update', $row->kode) }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingNama" name="nama"
                            value="{{ $row->nama }}">
                        <label for="floatingNama">Nama</label>
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
