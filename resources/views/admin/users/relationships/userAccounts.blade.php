@can('account_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.accounts.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.account.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.account.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userAccounts">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.account.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.account.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.account.fields.agency') }}
                        </th>
                        <th>
                            {{ trans('cruds.agency.fields.agency_code') }}
                        </th>
                        <th>
                            {{ trans('cruds.account.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.user.fields.email') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($accounts as $key => $account)
                        <tr data-entry-id="{{ $account->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $account->id ?? '' }}
                            </td>
                            <td>
                                {{ $account->name ?? '' }}
                            </td>
                            <td>
                                {{ $account->agency->name ?? '' }}
                            </td>
                            <td>
                                {{ $account->agency->agency_code ?? '' }}
                            </td>
                            <td>
                                {{ $account->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $account->user->email ?? '' }}
                            </td>
                            <td>
                                @can('account_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.accounts.show', $account->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('account_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.accounts.edit', $account->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('account_delete')
                                    <form action="{{ route('admin.accounts.destroy', $account->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('account_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.accounts.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-userAccounts:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection