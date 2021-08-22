<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyBankReportRequest;
use App\Http\Requests\StoreBankReportRequest;
use App\Http\Requests\UpdateBankReportRequest;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BankReportController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bank_report_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankReports.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_report_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankReports.create');
    }

    public function store(StoreBankReportRequest $request)
    {
        $bankReport = BankReport::create($request->all());

        return redirect()->route('admin.bank-reports.index');
    }

    public function edit(BankReport $bankReport)
    {
        abort_if(Gate::denies('bank_report_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankReports.edit', compact('bankReport'));
    }

    public function update(UpdateBankReportRequest $request, BankReport $bankReport)
    {
        $bankReport->update($request->all());

        return redirect()->route('admin.bank-reports.index');
    }

    public function show(BankReport $bankReport)
    {
        abort_if(Gate::denies('bank_report_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.bankReports.show', compact('bankReport'));
    }

    public function destroy(BankReport $bankReport)
    {
        abort_if(Gate::denies('bank_report_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bankReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankReportRequest $request)
    {
        BankReport::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
