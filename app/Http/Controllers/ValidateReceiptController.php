<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateReceiptRequest;
use App\Models\Receipt;
use App\Support\Enums\Status;

class ValidateReceiptController extends Controller
{
    public function unvalidated()
    {
        $unvalidatedReceipts = Receipt::where('status', Status::PENDING)->orderBy('created_at', 'desc')->get();

        return view('app.unvalidated', compact('unvalidatedReceipts'));
    }

    public function validate(ValidateReceiptRequest $request, Receipt $receipt)
    {
        $receiptAction = $request->validated('action');
        if ($receiptAction === "approved")
            $receipt->status = Status::APPROVED;
        else
            $receipt->status = Status::REJECTED;

        $receipt->save();

        return back()->with('success', "Receipt with CUIN {$receipt->cuin} was $receiptAction successfully");
    }

    public function validated()
    {
        $validatedReceipts = Receipt::where('status', Status::APPROVED)->orWhere('status', Status::REJECTED)->orderBy('created_at', 'desc')->get();

        return view('app.validated', compact('validatedReceipts'));
    }
}
