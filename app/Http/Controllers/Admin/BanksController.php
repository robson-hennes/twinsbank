<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBankRequest;
use App\Http\Requests\StoreBankRequest;
use App\Http\Requests\UpdateBankRequest;
use App\Models\Bank;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class BanksController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('bank_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Bank::query()->select(sprintf('%s.*', (new Bank())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'bank_show';
                $editGate = 'bank_edit';
                $deleteGate = 'bank_delete';
                $crudRoutePart = 'banks';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('bank_code', function ($row) {
                return $row->bank_code ? $row->bank_code : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
                    return sprintf(
        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
        $photo->url,
        $photo->thumbnail
    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logo']);

            return $table->make(true);
        }

        return view('admin.banks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('bank_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.banks.create');
    }

    public function store(StoreBankRequest $request)
    {
        $bank = Bank::create($request->all());

        if ($request->input('logo', false)) {
            $bank->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $bank->id]);
        }

        return redirect()->route('admin.banks.index');
    }

    public function edit(Bank $bank)
    {
        abort_if(Gate::denies('bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.banks.edit', compact('bank'));
    }

    public function update(UpdateBankRequest $request, Bank $bank)
    {
        $bank->update($request->all());

        if ($request->input('logo', false)) {
            if (!$bank->logo || $request->input('logo') !== $bank->logo->file_name) {
                if ($bank->logo) {
                    $bank->logo->delete();
                }
                $bank->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($bank->logo) {
            $bank->logo->delete();
        }

        return redirect()->route('admin.banks.index');
    }

    public function show(Bank $bank)
    {
        abort_if(Gate::denies('bank_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank->load('bankAgencies');

        return view('admin.banks.show', compact('bank'));
    }

    public function destroy(Bank $bank)
    {
        abort_if(Gate::denies('bank_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bank->delete();

        return back();
    }

    public function massDestroy(MassDestroyBankRequest $request)
    {
        Bank::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('bank_create') && Gate::denies('bank_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Bank();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
