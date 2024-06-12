<!-- Modal -->
<div class="modal fade" id="detailModal{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="detailModal{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModal{{ $item->id }}Label">
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
                <strong>Reason : </strong> {{ $item->notes }}
                <hr>
                @include('includes.badge-status', [
                    'status' => $item->status,
                ])
                <br>

                <strong>Comment : </strong> {{ $item->comment }}
                <hr>
            </div>
        </div>
    </div>
</div>
