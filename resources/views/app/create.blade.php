@extends('app.layout')

@section('title', 'Upload Receipt')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Uploads/</span> Upload Receipt
    </h4>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @include('app.components.alert', ['type' => 'danger', 'message' => $error])
        @endforeach
    @endif

    @if (session('success'))
        @include('app.components.alert', ['type' => 'success', 'message' => session('success')])
    @endif

    <!-- Multi Column with Form Separator -->
    <div class="card mb-4">
        <h5 class="card-header">Use this form to upload a receipt for validation</h5>
        <form class="card-body" action="{{ route('receipts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <h6>1. Receipt Details</h6>
            <div class="row g-4">
                <div class="col-12">
                    <div class="form-floating form-floating-outline">
                        <input type="text" id="username" class="form-control text-center" placeholder="Company Name"
                            name="company" required />
                        <label for="username">Company Name</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="CUSerial" class="form-control" placeholder="KRAMWXXXXXXXXXXXX"
                                aria-label="KRAMWXXXXXXXXXXXX" aria-describedby="CUSerial2" name="cuserial" required />
                            <label for="CUSerial">CUSerial</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="CUIN" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="CUIN2" name="cuin" required />
                            <label for="CUIN">CUIN</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="date" id="purchase_date" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="purchase_date2" name="purchase_date" required />
                            <label for="purchase_date">Purchase Date</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="Nameofseller" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="Nameofseller2" name="seller" required />
                            <label for="Nameofseller">Name of Seller</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="text" id="Pinofseller" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="Pinofseller2" name="pin" required />
                            <label for="Pinofseller">Pin of Seller</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="amount" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="amount2" name="amount" required />
                            <label for="amount">Amount</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="vatpercentage" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="vatpercentage2" value="16" name="vat_percentage" required />
                            <label for="vatpercentage">VAT Percentage</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="vatamount" class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="vatamount2" disabled />
                            <label for="vatamount">VAT Amount</label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group input-group-merge">
                        <div class="form-floating form-floating-outline">
                            <input type="number" id="total" class="form-control text-center"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="total2" disabled />
                            <label for="total">Total</label>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="my-4 mx-n4" />
            <h6>2. Receipt Image</h6>
            <div class="row g-4">
                <div class="col-12 mb-3">
                    <input class="form-control" type="file" id="formFile" name="receipt" accept="image/*" required>
                </div>
            </div>
            <div class="pt-4 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary me-sm-3 me-1" type="submit">Submit</button>
                <button type="reset" class="btn btn-outline-secondary">Reset</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/upload-receipt.js') }}"></script>
@endpush
