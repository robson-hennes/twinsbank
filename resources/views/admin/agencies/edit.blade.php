@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.agency.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.agencies.update", [$agency->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name">{{ trans('cruds.agency.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', $agency->name) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agency.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agency_code">{{ trans('cruds.agency.fields.agency_code') }}</label>
                <input class="form-control {{ $errors->has('agency_code') ? 'is-invalid' : '' }}" type="text" name="agency_code" id="agency_code" value="{{ old('agency_code', $agency->agency_code) }}">
                @if($errors->has('agency_code'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agency_code') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agency.fields.agency_code_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="bank_id">{{ trans('cruds.agency.fields.bank') }}</label>
                <select class="form-control select2 {{ $errors->has('bank') ? 'is-invalid' : '' }}" name="bank_id" id="bank_id" required>
                    @foreach($banks as $id => $entry)
                        <option value="{{ $id }}" {{ (old('bank_id') ? old('bank_id') : $agency->bank->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('bank'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bank') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.agency.fields.bank_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection