<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li>
            <select class="searchable-field form-control">

            </select>
        </li>
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/permissions*") ? "c-show" : "" }} {{ request()->is("admin/roles*") ? "c-show" : "" }} {{ request()->is("admin/users*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/permissions") || request()->is("admin/permissions/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/roles") || request()->is("admin/roles/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/users") || request()->is("admin/users/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('bank_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/banks*") ? "c-show" : "" }} {{ request()->is("admin/agencies*") ? "c-show" : "" }} {{ request()->is("admin/accounts*") ? "c-show" : "" }} {{ request()->is("admin/bank-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-check-alt c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.bankManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('bank_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.banks.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/banks") || request()->is("admin/banks/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-university c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bank.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('agency_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.agencies.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/agencies") || request()->is("admin/agencies/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-building c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.agency.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('account_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.accounts.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/accounts") || request()->is("admin/accounts/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-file-invoice-dollar c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.account.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('bank_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.bank-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/bank-reports") || request()->is("admin/bank-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-hand-holding-usd c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.bankReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('expense_management_access')
            <li class="c-sidebar-nav-dropdown {{ request()->is("admin/expense-categories*") ? "c-show" : "" }} {{ request()->is("admin/income-categories*") ? "c-show" : "" }} {{ request()->is("admin/expenses*") ? "c-show" : "" }} {{ request()->is("admin/incomes*") ? "c-show" : "" }} {{ request()->is("admin/expense-reports*") ? "c-show" : "" }}">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-money-bill c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.expenseManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('expense_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-categories") || request()->is("admin/expense-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_category_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.income-categories.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/income-categories") || request()->is("admin/income-categories/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-list c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.incomeCategory.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expenses.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expenses") || request()->is("admin/expenses/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expense.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('income_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.incomes.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/incomes") || request()->is("admin/incomes/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-arrow-circle-right c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.income.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('expense_report_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.expense-reports.index") }}" class="c-sidebar-nav-link {{ request()->is("admin/expense-reports") || request()->is("admin/expense-reports/*") ? "c-active" : "" }}">
                                <i class="fa-fw fas fa-chart-line c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.expenseReport.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'c-active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>