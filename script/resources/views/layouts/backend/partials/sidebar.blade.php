<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="">{{ config()->get('app.name') }}</a>
        </div>
        <ul class="sidebar-menu">
            @if (Auth::user()->role_id == 1)
            @can('dashboard.index')
            <li class="menu-header">{{ __('Dashboard') }}</li>
            <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>
                    <span>{{ __('Dashboard') }}</span></a>
            </li>
            @endcan
            @can('plan.create','plan.edit','plan.delete','plan.index')
            <li class="menu-header">{{ __('Manage Plan & Payments') }}</li>
            <li class="dropdown {{ Request::is('admin/plan*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> <span>{{ __('Manage Plan') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/plan/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.plan.create') }}">{{ __('Add Plan') }}</a></li>
                    <li class="{{ Request::is('admin/plan') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.plan.index') }}">{{ __('Manage Plan') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('payment-gateway.create','payment-gateway.edit','payment-gateway.delete','payment-gateway.index')
            <li class="{{ Request::is('admin/payment_gateway*') ? 'active' : '' }}">
                <a href="{{ route('admin.payment_gateway.index') }}" class="nav-link"><i class="fas fa-money-bill-alt"></i>
                    <span>{{ __('Payment Gateway') }}</span></a>
            </li>
            @endcan
            @can('order.create','order.edit','order.delete','order.index','order.show')
            <li class="dropdown {{ Request::is('admin/order*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th-list"></i> <span>{{ __('Manage Order') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/order/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.order.create') }}">{{ __('Create Order') }}</a></li>
                    <li class="{{ Request::is('admin/order') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.order.index') }}">{{ __('Manage Order') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('report.edit','report.view','report.index','report.invoice-pdf')
            <li class="{{ Request::is('admin/report*') ? 'active' : '' }}">
                <a href="{{ route('admin.report.index') }}" class="nav-link"><i class="fas fa-flag"></i>
                    <span>{{ __('Order Report') }}</span></a>
            </li>
            @endcan
            
            @can('domain.index','tenant.index')
            <li class="menu-header">{{ __('Manage Domain & Tenant ') }}</li>
            <li class="dropdown {{ Request::is('admin/domain*') || Request::is('admin/tenant*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> <span>{{ __('Domains & Profiles') }}</span></a>
                <ul class="dropdown-menu">
                   
                    <li class="{{ Request::is('admin/tenant*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.tenant.index') }}">{{ __('Profiles') }}</a></li>
                   
                    <li class="{{ Request::is('admin/domain') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.domain.index') }}">{{ __('Manage Domains') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('config_dns')
            <li class="{{ Request::is('admin/option/config-dns*') ? 'active' : '' }}">
                <a href="{{ route('admin.option.config-dns') }}" class="nav-link"><i class="fas fa-dna"></i>
                    <span>{{ __('Config DNS') }}</span></a>
            </li>
            @endcan
            @can('customer.index','customer.create')
            <li class="menu-header">{{ __('Customer Management') }}</li>
            <li class="{{ Request::is('admin/customer*') ? 'active' : '' }}">
                <a href="{{ route('admin.customer.index') }}" class="nav-link"><i class="fas fa-users"></i>
                    <span>{{ __('Customers') }}</span></a>
            </li>
            @endcan
            @can('template.edit','template.create','template.index','template.delete')
            <li class="menu-header">{{ __('Templates') }}</li>
            <li class="{{ Request::is('admin/template*') ? 'active' : '' }}">
                <a href="{{ route('admin.template.index') }}" class="nav-link"><i class="fas fa-plug"></i>
                    <span>{{ __('Portfolio Templates') }}</span></a>
            </li>
            @endcan
            @can('template.edit','template.create','template.index','template.delete')
            <li class="{{ Request::is('admin/vcard*') ? 'active' : '' }}">
                <a href="{{ route('admin.vcard.index') }}" class="nav-link"><i class="fas fa-spa"></i>
                    <span>{{ __('VCard Templates') }}</span></a>
            </li>
            @endcan
            @can('template.edit','template.create','template.index','template.delete')
            
            <li class="{{ Request::is('admin/cvtemplate*') ? 'active' : '' }}">
                <a href="{{ route('admin.cvtemplate.index') }}" class="nav-link"><i class="fas fa-id-card"></i>
                    <span>{{ __('Cv Templates') }}</span></a>
            </li>
            @endcan
            @can('blog.edit','blog.create','blog.index','blog.delete')
            <li class="menu-header">{{ __('Website Management') }}</li>
            <li class="dropdown {{ Request::is('admin/blog*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fab fa-blogger-b"></i> <span>{{ __('Manage Blogs') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/blog/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog.create') }}">{{ __('Add New') }}</a></li>
                    <li class="{{ Request::is('admin/blog') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.blog.index') }}">{{ __('Manage Blogs') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('benefit.edit','benefit.create','benefit.index','benefit.delete')
            <li class="dropdown {{ Request::is('admin/benefit*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> <span>{{ __('Manage Benefit') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/benefit/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.benefit.create') }}">{{ __('Add New') }}</a></li>
                    <li class="{{ Request::is('admin/benefit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.benefit.index') }}">{{ __('Manage Benefit') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('template-image.edit','template-image.create','template-image.index','template-image.delete')
            <li class="dropdown {{ Request::is('admin/template-image*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-images"></i> <span>{{ __('Template Images') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/benefit/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.template-image.create') }}">{{ __('Add New') }}</a></li>
                    <li class="{{ Request::is('admin/benefit') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.template-image.index') }}">{{ __('Template Images') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('company.edit','company.create','company.index','company.delete')
            <li class="dropdown {{ Request::is('admin/company*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-building"></i> <span>{{ __('Manage Company') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/company/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.company.create') }}">{{ __('Add New') }}</a></li>
                    <li class="{{ Request::is('admin/company') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.company.index') }}">{{ __('Manage Company') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('page.edit','page.create','page.delete','page.index')
            <li class="dropdown {{ Request::is('admin/page*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-file"></i> <span>{{ __('Manage Page') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('admin/page/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.page.create') }}">{{ __('Add New') }}</a></li>
                    <li class="{{ Request::is('admin/page') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.page.index') }}">{{ __('Manage Page') }}</a></li>
                </ul>
            </li>
            @endcan
            @can('cron')
            <li class="{{ Request::is('admin/cron*') ? 'active' : '' }}">
                <a href="{{ route('admin.cron.index') }}" class="nav-link"><i class="fas fa-clone"></i>
                    <span>{{ __('Cron') }}</span></a>
            </li>
            @endcan
            @can('theme-settings')
            <li class="{{ Request::is('admin/theme-settings*') ? 'active' : '' }}">
                <a href="{{ route('admin.theme-settings') }}" class="nav-link"><i class="fas fa-cog"></i>
                    <span>{{ __('Theme Settings') }}</span></a>
            </li>
            @endcan
            @can('option.seo-index','option.seo-edit')
            <li class="{{ Request::is('admin/option/seo*') ? 'active' : '' }}">
                <a href="{{ route('admin.option.seo-index') }}" class="nav-link"><i class="fas fa-poll"></i>
                    <span>{{ __('SEO Settings') }}</span></a>
            </li>
            @endcan
            <li class="{{ Request::is('admin/option/other') ? 'active' : '' }}">
                <a href="{{ route('admin.option.other') }}" class="nav-link"><i class="fas fa-filter"></i>
                    <span>{{ __('Other Option') }}</span></a>
            </li>
            @can('menu')
            <li class="menu-header">{{ __('Menu Management') }}</li>
            <li class="{{ Request::is('admin/menu*') ? 'active' : '' }}">
                <a href="{{ route('admin.menu.index') }}" class="nav-link"><i class="far fa-list-alt"></i>
                    <span>{{ __('Menu') }}</span></a>
            </li>
            @endcan
            @can('admin.edit','admin.create','admin.update','admin.delete','admin.list')
            <li class="menu-header">{{ __('Roles & Permissions') }}</li>
            <li class="{{ Request::is('admin/admin*') ? 'active' : '' }}">
                <a href="{{ route('admin.admin.index') }}" class="nav-link"><i class="fas fa-user-friends"></i>
                    <span>{{ __('Admin List') }}</span></a>
            </li>
            @endcan
            @can('role.list')
            <li class="{{ Request::is('admin/role*') ? 'active' : '' }}">
                <a href="{{ route('admin.role.index') }}" class="nav-link"><i class="fab fa-critical-role"></i>
                    <span>{{ __('Roles') }}</span></a>
            </li>
            @endcan
            @can('language.index','language.edit','language.delete')
            <li class="menu-header">{{ __('Manage Languages') }}</li>
            <li class="{{ Request::is('admin/language*') ? 'active' : '' }}">
                <a href="{{ route('admin.language.index') }}" class="nav-link"><i class="fas fa-globe"></i>
                    <span>{{ __('Language') }}</span></a>
            </li>
            @endcan
            <li class="{{ Request::is('admin/cvlanguage*') ? 'active' : '' }}">
                <a href="{{ route('admin.cvlanguage.index') }}" class="nav-link"><i class="fas fa-globe-asia"></i>
                    <span>{{ __('CV Language') }}</span></a>
            </li>
            <li class="{{ Request::is('admin/env*') ? 'active' : '' }}">
                <a href="{{ route('admin.env.index') }}" class="nav-link"><i class="fas fa-globe-asia"></i>
                    <span>{{ __('System Settings') }}</span></a>
            </li>
            @elseif(Auth::user()->role_id == 2)
            {{-- user view --}}
            <li class="menu-header">{{ __('Dashboard') }}</li>
            <li class="nav-item {{ Request::is('user/dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer-alt"></i><span>{{ __('Dashboard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('CV Builder') }}</li>
            <li class="{{ !planData('resume_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/cv*') ? 'active' : '' }}">
                <a href="{{ route('user.cv.builder') }}" class="nav-link"><i class="far fa-address-card"></i>
                    <span>{{ __('CV Builder') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Manage VCard') }}</li>
            <li class="{{ !planData('vcard') ? 'nav-disabled' : '' }} {{ Request::is('user/vcard*') ? 'active' : '' }}">
                <a href="{{ route('user.vcard.index') }}" class="nav-link"><i class="fas fa-id-card"></i>
                    <span>{{ __('VCard') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Choose Themes') }}</li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/template*') ? 'active' : '' }}">
                <a href="{{ route('user.template.index') }}" class="nav-link"><i class="fas fa-pencil-ruler"></i>
                    <span>{{ __('Themes') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Website Management') }}</li>
            <li class="dropdown {{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/blog*') || Request::is('user/category*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-clipboard-list"></i> <span>{{ __('Manage Blog') }}</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('user/blog/create') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.blog.create') }}">{{ __('Add New') }}</a></li>
                    <li class="{{ Request::is('user/blog/*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('user.blog.index') }}">{{ __('Manage Blog') }}</a></li>
                </ul>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/service*') ? 'active' : '' }}">
                <a href="{{ route('user.service.index') }}" class="nav-link"><i class="fas fa-tools"></i>
                    <span>{{ __('My Services') }}</span></a>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/project*') ? 'active' : '' }}">
                <a href="{{ route('user.project.index') }}" class="nav-link"><i class="fas fa-tasks"></i>
                    <span>{{ __('My Portfolio') }}</span></a>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/experience*') ? 'active' : '' }}">
                <a href="{{ route('user.experience.index') }}" class="nav-link"><i class="fas fa-code-branch"></i>
                    <span>{{ __('My Experiences') }}</span></a>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/skill*') ? 'active' : '' }}">
                <a href="{{ route('user.skill.index') }}" class="nav-link"><i class="fas fa-wrench"></i>
                    <span>{{ __('My Skills') }}</span></a>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/testimonial*') ? 'active' : '' }}">
                <a href="{{ route('user.testimonial.index') }}" class="nav-link"><i class="fab fa-rocketchat"></i>
                    <span>{{ __('My Testimonials') }}</span></a>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/education*') ? 'active' : '' }}">
                <a href="{{ route('user.education.index') }}" class="nav-link"><i class="fas fa-book-open"></i>
                    <span>{{ __('My Educations') }}</span></a>
            </li>
            <li class="{{ !planData('portfolio_builder') ? 'nav-disabled' : '' }} {{ Request::is('user/site/settings*') ? 'active' : '' }}">
                <a href="{{ route('user.site.settings') }}" class="nav-link"><i class="fas fa-cogs"></i>
                    <span>{{ __('Site Settings') }}</span></a>
            </li>
            <li class="{{ (!planData('sub_domain') && !planData('custom_domain')) ? 'nav-disabled' : '' }} {{ Request::is('user/settings*') ? 'active' : '' }}">
                <a href="{{ route('user.settings.index') }}" class="nav-link"><i class="fas fa-globe"></i>
                    <span>{{ __('Domain Settings') }}</span></a>
            </li>
            <li class="menu-header">{{ __('Plan Management') }}</li>
            <li class="{{ Request::is('user/plan*') ? 'active' : '' }}">
                <a href="{{ route('user.plan.index') }}" class="nav-link"><i class="fas fa-clipboard-list"></i>
                    <span>{{ __('Upgrade Plan') }}</span></a>
            </li>
           
          
            @endif
        </ul>
    </aside>
</div>