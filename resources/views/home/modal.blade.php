<!-- Modal -->
<div class="modal fade" id="tambahdata" tabindex="-1" aria-labelledby="tambahdataLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahdataLabel">Tambah History</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- form start -->
                <form class="form-horizontal" action="addhistory" method="POST">
                    @csrf
                    <div class="card-body">
                        <input type="Number" name="user_id" hidden value="{{ Auth::check() ? Auth::user()->id : '' }}">
                        <div class="form-group row">
                            <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal" name="tanggal"
                                    placeholder="Tanggal" value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="waktu" class="col-sm-2 col-form-label">waktu</label>
                            <div class="col-sm-10">
                                <input type="time" class="form-control" id="waktu" name="waktu"
                                    placeholder="waktu" value="{{ date('H:i') }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tempat" class="col-sm-2 col-form-label">Tempat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lokasi" id="tempat"
                                    placeholder="Citymall">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="suhu" class="col-sm-2 col-form-label">suhu tubuh</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="suhu" id="suhu"
                                    placeholder="0.0">
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Tambahkan</button>
                    </div>
                </form>
                <!-- /.card-footer -->
            </div>

        </div>
    </div>
</div>
