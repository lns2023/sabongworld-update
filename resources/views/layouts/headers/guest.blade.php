<div class="header bg-default py-7 py-lg-8">
    <div class="container">
        <div class="header-body text-center mb-7">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                    <h1 style="color: black;
                    -webkit-text-fill-color: white; /* Will override color (regardless of order) */
                    -webkit-text-stroke-width: 1px;
                    -webkit-text-stroke-color: black;"> {{ __('Welcome to ').env('APP_NAME') }}</h1>
                </div>
                <div class="col-lg-12 col-md-12 mb--5">
                    <img src="{{config('settings.img.logo')}}" width="275" height="206">
                </div>

            </div>
        </div>
    </div>  
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
             xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>
