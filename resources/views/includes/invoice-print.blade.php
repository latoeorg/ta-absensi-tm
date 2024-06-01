<div class="row my-3">
    <div class="col-12">
        <h4>
            {{-- <i class="fas fa-globe"></i> AdminLTE, Inc. --}}
            <div>
                <img src="{{ asset('logo.svg') }}" alt="Logo" width="30" class="brand-image float-left"
                    style="opacity: .8" />

                <p class="fw-medium float-left ml-2">
                    Sistem Absensi
                </p>
            </div>

            <small class="float-right">Date:
                {{ $salesOrder->date }}
            </small>
        </h4>
    </div>

</div>

<div class="row invoice-info">
    <div class="col-sm-4 invoice-col">
        From
        <address>
            <strong>Sistem Absensi, Inc.</strong><br>
            Indonesia, Batam<br>
            Phone: (804) 123-5432<br>
            Email: Absensi@absensi.com
        </address>
    </div>

    <div class="col-sm-4 invoice-col">
        To
        <address>
            <strong>{{ $salesOrder->customer }}</strong><br>
        </address>
    </div>

    <div class="col-sm-4 invoice-col">
        <b>Invoice #000{{ $salesOrder->id }}</b><br>
        <br>
        <b>Order ID:</b> {{ $salesOrder->id }}<br>
        <b>Payment Due:</b> {{ $salesOrder->date }}<br>
    </div>

</div>


<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Qty</th>
                    <th>Product</th>
                    <th>Code #</th>
                    <th>Description</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($salesOrder->items as $item)
                    <tr>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->item->name }}</td>
                        <td>#{{ $item->item->code }}</td>
                        <td>{{ $item->item->description }}</td>
                        <td class="rupiah-format">{{ $item->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

<div class="row">

    <div class="col-6">
        <p class="lead mb-1">Note:</p>
        {{-- Transfer to BCA 123456789 a/n IT Inventory, Inc. --}}
        </p>
    </div>

    <div class="col-6">
        <div class="table-responsive">
            <table class="table">
                <tbody>
                    <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td class="rupiah-format">{{ $salesOrder->subtotal }}</td>
                    </tr>
                    <tr>
                        <th>Additional Fee:</th>
                        <td class="rupiah-format">{{ $salesOrder->additional_fee }}</td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td class="rupiah-format">{{ $salesOrder->total_amount }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</div>
