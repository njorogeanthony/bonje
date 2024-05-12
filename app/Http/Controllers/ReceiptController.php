<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadReceiptRequest;
use App\Models\Receipt;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReceiptController extends Controller
{
    public function index()
    {
        $uploadedReceipts = Receipt::all();

        return view('app.index', compact('uploadedReceipts'));
    }

    public function store(UploadReceiptRequest $request): RedirectResponse
    {
        $uploadedReceipt = new Receipt($request->validated());

        $uploadedReceipt->amount = $request->amount * 100;

        $receiptImage =  $request->file('receipt');

        $fileNameHash = $receiptImage->hashName();

        $receiptImage->storeAs('uploads', $fileNameHash, ['disk' => 'public']);

        $uploadedReceipt->image_path = $fileNameHash;

        $uploadedReceipt->save();

        $receiptCUIN = request('cuin');

        return back()->with('success', "Receipt with CUIN $receiptCUIN uploaded successfully");
    }
}
