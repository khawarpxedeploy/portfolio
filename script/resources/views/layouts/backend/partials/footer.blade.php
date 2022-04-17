<footer class="main-footer">
    <div class="footer-left">
      {{ __('Copyright') }} &copy; {{ Carbon\Carbon::now()->format('Y') }} <div class="bullet"></div>  <a href="{{ url('/') }}">{{ config()->get('app.name') }}</a>
    </div>
    <div class="footer-right">
      1.6
    </div>
  </footer>