@extends('app.layout')

@section('title', 'Uploaded Receipts')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Uploads/</span> Uploaded Receipts
    </h4>

    <!-- Scrollable -->
    <div class="card">
        <h5 class="card-header">List of all Uploaded Receipts</h5>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Company</th>
                        <th scope="col">CUSerial</th>
                        <th scope="col">CUIN</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Seller's Pin</th>
                        <th scope="col">Amount</th>
                        <th scope="col">VAT</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($uploadedReceipts as $receipt)
                        <tr>
                            <td>{{ $receipt->purchase_date }}</td>
                            <td>{{ $receipt->company }}</td>
                            <td>{{ $receipt->cuserial }}</td>
                            <td>{{ $receipt->cuin }}</td>
                            <td>{{ $receipt->seller }}</td>
                            <td>{{ $receipt->pin }}</td>
                            <td>{{ number_format($receipt->amount / 100, 2) }}</td>
                            <td>{{ number_format((($receipt->amount / 100) * 16) / 100, 2) }}</td>
                            <td>{{ number_format($receipt->amount / 100 + (($receipt->amount / 100) * 16) / 100, 2) }}</td>
                            <td>
                                <span class="badge rounded-pill bg-{{ $receipt->status->toColor() }}">
                                    {{ $receipt->status->toString() }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Scrollable -->

@endsection

@push('scripts')
    <script src="{{ asset('js/uploaded-receipts.js') }}"></script>
@endpush
