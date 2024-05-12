@extends('app.layout')
@inject('storage', '\Illuminate\Support\Facades\Storage')

@section('title', 'Unvalidated Receipts')

@section('content')
    <h4 class="py-3 mb-4">
        <span class="text-muted fw-light">Validation/</span> Validate Pending Receipts
    </h4>

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            @include('app.components.alert', ['type' => 'danger', 'message' => $error])
        @endforeach
    @endif

    @if (session('success'))
        @include('app.components.alert', ['type' => 'success', 'message' => session('success')])
    @endif

    <!-- Scrollable -->
    <div class="card">
        <h5 class="card-header">List of all Unvalidated Receipts</h5>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Company</th>
                        <th scope="col">CUSerial</th>
                        <th scope="col">CUIN</th>
                        <th scope="col">Seller</th>
                        <th scope="col">Total</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($unvalidatedReceipts as $receipt)
                        <tr>
                            <td>{{ $receipt->company }}</td>
                            <td>{{ $receipt->cuserial }}</td>
                            <td>{{ $receipt->cuin }}</td>
                            <td>{{ $receipt->seller }}</td>
                            <td>{{ number_format($receipt->amount / 100 + (($receipt->amount / 100) * 16) / 100, 2) }}</td>
                            <td>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewReceiptModal-{{ $receipt->id }}"
                                    data-receipt="{{ $receipt->id }}">
                                    View
                                </button>
                                <a
                                    href="{{ route('receipts.validate.validate', ['receipt' => $receipt->id, 'action' => 'approved']) }}">
                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#validateReceiptModal" data-receipt="{{ $receipt->id }}">
                                        Approve
                                    </button>
                                </a>
                                <a
                                    href="{{ route('receipts.validate.validate', ['receipt' => $receipt->id, 'action' => 'rejected']) }}">
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#deleteReceiptModal" data-receipt="{{ $receipt->id }}">
                                        Reject
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!--/ Scrollable -->

    @foreach ($unvalidatedReceipts as $receipt)
        <div class="modal fade" id="viewReceiptModal-{{ $receipt->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Receipt #{{ $receipt->cuin }}</h3>
                        </div>
                        <form id="" class="row g-4" onsubmit="return false">
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserFirstName" name="modalEditUserFirstName"
                                        class="form-control text-center" placeholder="" value="{{ $receipt->company }}"
                                        disabled />
                                    <label for="modalEditUserFirstName">Company Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserLastName" name="modalEditUserLastName"
                                        class="form-control" placeholder="" value="{{ $receipt->cuserial }}" disabled />
                                    <label for="modalEditUserLastName">CUSerial</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserName" name="modalEditUserName"
                                        class="form-control" placeholder="" value="{{ $receipt->cuin }}" disabled />
                                    <label for="modalEditUserName">CUIN</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="datetime" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com"
                                        value="{{ $receipt->purchase_date }}" disabled />
                                    <label for="modalEditUserEmail">Purchase Date</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com"
                                        value="{{ $receipt->seller }}" disabled />
                                    <label for="modalEditUserEmail">Seller</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com" value="{{ $receipt->pin }}"
                                        disabled />
                                    <label for="modalEditUserEmail">Seller's Pin</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com"
                                        value="{{ number_format($receipt->amount / 100, 2) }}" disabled />
                                    <label for="modalEditUserEmail">Amount</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com"
                                        value="{{ $receipt->vat_percentage }}" disabled />
                                    <label for="modalEditUserEmail">VAT percentage</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control" placeholder="example@domain.com"
                                        value="{{ number_format((($receipt->amount / 100) * 16) / 100, 2) }}" disabled />
                                    <label for="modalEditUserEmail">VAT Amount</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="modalEditUserEmail" name="modalEditUserEmail"
                                        class="form-control text-center" placeholder="example@domain.com"
                                        value="{{ number_format($receipt->amount / 100 + (($receipt->amount / 100) * 16) / 100, 2) }}"
                                        disabled />
                                    <label for="modalEditUserEmail">Total</label>
                                </div>
                            </div>
                            <div class="col-12">
                                {{-- Add an image to the form --}}
                                <div class="form-floating form-floating-outline">
                                    <img src="{{ $storage::disk('public')->url('uploads/' . $receipt->image_path) }}"
                                        alt="Receipt Image" class="img-fluid" />
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@push('scripts')
    <script src="{{ asset('js/uploaded-receipts.js') }}"></script>
@endpush
