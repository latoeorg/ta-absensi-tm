<!-- Modal -->
<div class="modal fade" id="formUpdate{{ $item->id }}" tabindex="-1" role="dialog"
    aria-labelledby="formUpdate{{ $item->id }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('user.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title" id="formUpdate{{ $item->id }}Label">
                        Update User
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Masukan Full Name"
                            name="name" required value="{{ $item->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate</label>
                        <input type="date" class="form-control" id="birthdate" placeholder="Masukan Tanggal Lahir"
                            name="birthdate" value="{{ $item->birthdate }}" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" placeholder="Masukan email address"
                            name="email" required value="{{ $item->email }}" />
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" placeholder="Masukan username"
                            name="username" required value="{{ $item->username }}" />
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" class="form-control" id="Password"
                            placeholder="Masukan Password untuk update" name="password" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
