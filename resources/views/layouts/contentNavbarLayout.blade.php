@isset($pageConfigs)
  {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

@php
  $configData = Helper::appClasses();
@endphp

@extends('layouts.commonMaster')

@php
  /* Display elements */
  $contentNavbar = ($contentNavbar ?? true);
  $containerNav = ($containerNav ?? 'container-xxl');
  $isNavbar = ($isNavbar ?? true);
  $isMenu = ($isMenu ?? true);
  $isFlex = ($isFlex ?? false);
  $isFooter = ($isFooter ?? true);
  $customizerHidden = ($customizerHidden ?? '');

  /* HTML Classes */
  $navbarDetached = 'navbar-detached';
  $menuFixed = $configData['menuFixed'] ?? '';
  $navbarType = $configData['navbarType'] ?? '';
  $footerFixed = $configData['footerFixed'] ?? '';
  $menuCollapsed = $configData['menuCollapsed'] ?? '';

  /* Content classes */
  $container = ($configData['contentLayout'] === 'compact') ? 'container-xxl' : 'container-fluid';
@endphp

@section('layoutContent')
  <div class="layout-wrapper layout-content-navbar {{ $isMenu ? '' : 'layout-without-menu' }}">
    <div class="layout-container">

      @if ($isMenu)
        @include('layouts.sections.menu.verticalMenu')
      @endif

      <!-- Layout page -->
      <div class="layout-page">
        <!-- BEGIN: Navbar-->
        @if ($isNavbar)
          @include('layouts.sections.navbar.navbar')
        @endif
        <!-- END: Navbar-->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->
          @if ($isFlex)
            <div class="{{ $container }} d-flex align-items-stretch flex-grow-1 p-0">
          @else
            <div class="{{ $container }} flex-grow-1 container-p-y">
          @endif
            @if(session()->get('global-success'))
              <div class="alert alert-success msg-status-success alert-dismissible fade show msg" role="alert">
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
                Sucesso!
              </div>
            @endif
            @if(session()->get('global-erro'))
              <div class="alert alert-danger msg-status-erro alert-dismissible fade show msg" role="alert">
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
                Não foi possível concluir a operação!
              </div>
            @endif
            @yield('content')
            </div>
          <!-- / Content -->

          <!-- Footer -->
          @if ($isFooter)
            @include('layouts.sections.footer.footer')
          @endif
          <!-- / Footer -->
          <div class="content-backdrop fade"></div>
        </div>
        <!-- / Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    @if ($isMenu)
      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    @endif
    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>
  </div>
  <!-- / Layout wrapper -->
@endsection
