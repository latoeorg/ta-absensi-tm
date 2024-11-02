<!-- Modal -->
<div class="modal fade" id="formCreate" tabindex="-1" role="dialog" aria-labelledby="formCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('pengajuan-cuti.store') }}" method="POST">
                @csrf

                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                <div class="modal-header">
                    <h5 class="modal-title" id="formCreateLabel">
                        Pengajuan Cuti
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>User</label>
                                <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type" id="type" class="form-control" required>
                                    <option value="">-- Select Type --</option>
                                    @foreach ($list_type as $type)
                                        <option value="{{ $type }}">
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date_start">Date Start</label>
                                <input type="date" class="form-control" id="date_start" name="date_start" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="date_end">Date End</label>
                                <input type="date" class="form-control" id="date_end" name="date_end" />
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea class="form-control" id="notes" placeholder="Notes" name="notes" required></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date_start').setAttribute('min', today);
        document.getElementById('date_end').setAttribute('min', today);

        document.getElementById('date_start').addEventListener('change', function () {
            const startDate = this.value;
            document.getElementById('date_end').setAttribute('min', startDate);
        });
    });
</script>
