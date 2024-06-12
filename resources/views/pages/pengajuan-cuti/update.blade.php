<!-- Modal -->
<div class="modal fade" id="formUpdate{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="formUpdate{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form action="{{ route('pengajuan-cuti.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="formUpdate{{ $item->id }}Label">
                        Pengajuan Cuti
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="mb-2">
                                <strong>User:</strong> {{ $item->user->name }}
                            </p>
                            <p class="mb-2">
                                <strong>Type:</strong> {{ $item->type }}
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-2">
                                <strong>Date Start:</strong> {{ $item->date_start }}
                            </p>
                            <p class="mb-2">
                                <strong>Date End:</strong> {{ $item->date_end }}
                            </p>
                        </div>
                    </div>
                    <hr>
                    <strong>Notes:</strong> {{ $item->notes }}
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control" required>
                                    <option value="">-- Select Status --</option>
                                    @foreach (['APPROVED', 'REJECTED'] as $status)
                                        <option value="{{ $status }}">
                                            {{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="comment">Comment</label>
                                <textarea class="form-control" id="comment" placeholder="comment" name="comment" required></textarea>
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
