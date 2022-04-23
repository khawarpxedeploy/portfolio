<footer>
    <div class="footer-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="footer-social-links">
                        <nav>
                            <ul>
                                @foreach($info->social ?? [] as $row)
                                 <li><a target="_blank" href="{{ url($row->link) }}"><span class="{{ $row->icon }}"></span></a></li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-copyright f-right">
                        <p>© {{ date('Y') }} {{ __('copyright all right reserved.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>