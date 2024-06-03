<div class="modal fade" id="modalNews" tabindex="-1" aria-labelledby="modalPostLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title">Berita Kehilangan</label>
                        <input type="text" class="form-control" placeholder="Nama barang:      " id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Detail Kehilangan</label>
                        <textarea class="form-control" placeholder="Tanggal Kehilangan:       Tempat Kehilangan:" id="text" name="text" rows="3" required></textarea>
                    </div>
                    <input type="hidden" name="type" value="news">
                    <input type="hidden" name="found" value="false">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
