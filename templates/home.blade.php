@include('header')
<div class="container-fluid content-wrap" id="root">
    <div class="row align-items-center justify-content-center">
        <div class="col-12 align-self-center text-center">
                <img src="/assets/images/io-logo.png">
                <h1>Welcome to I/O Framework</h1>
                <p align="center">
                    <span>Version {{ $framework_version['text'] }}</span>
                    <a href="https://iotech.co.th">iOTech Enterprise</a> | 
                    <a href="#">Documents</a> | 
                    <a href="https://git.iotech.co.th/iotech/iOFramework">Contributes</a>
                </p>
            </div>
    </div>
</div>
@include('footer')