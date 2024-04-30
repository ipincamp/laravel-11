{{-- Delete Modal --}}
<div class="modal fade" id="modalHapusProdi{{ $row->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="d-flex">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus Data Prodi</h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form method="post" action="{{ route('prodi.destroy', $row->kode) }}">
                @csrf
                @method('DELETE')

                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data mahasiswa ini?</p>
                    <p class="text-muted">
                        {{ $row->kode }} - {{ $row->nama }}
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