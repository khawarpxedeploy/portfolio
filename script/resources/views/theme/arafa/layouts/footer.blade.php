<footer>
    <div class="footer-area mt-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="footer-social-links">
                        <nav>
                            <ul>
                                @foreach($info->social ?? [] as $row)
                                 <li>
                                    <a target="_blank" href="{{ url($row->link) }}"><span class="{{ $row->icon }}"></span></a>
                                </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="footer-copyright f-right">
                         <p>© {{ date('Y') }} {{ strtoupper(env('APP_NAME')) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>