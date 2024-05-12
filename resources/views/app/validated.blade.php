@extends('app.layout')

@section('title', 'Validated Receipts')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Validation/</span> Validated Receipts
    </h4>

    <!-- Scrollable -->
    <div class="card">
        <h5 class="card-header">List of all Validated Receipts</h5>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">CUSerial</th>
                        <th scope="col">CUIN</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($validatedReceipts as $receipt)
                        <tr>
                            <td>{{ $receipt->company }}</td>
                            <td>{{ $receipt->cuserial }}</td>
                            <td>{{ $receipt->cuin }}</td>
                            <td>{{ $receipt->seller }}</td>
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
