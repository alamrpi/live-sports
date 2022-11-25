@extends('layouts.website-master')

@section('title')
    Contact
@endsection

@section('content')
    <div class="inner-banner-header wf100">
        <h1 data-generated="News List">Contact</h1>
        <div class="gt-breadcrumbs">
            <ul>
                <li> <a href="{{ route('home') }}"> <i class="fas fa-home"></i> Home </a> </li>
                <li> <a href="{{ route('website/news/index') }}" class="active"> Contact </a> </li>
            </ul>
        </div>
    </div>
    <div class="main-content p80 innerpagebg wf100">
        <!--Contact Page Start-->
        <div class="contact">
            <div class="container">
                <div class="row">
                    <!--Form Start-->
                    <div class="col-md-6">
                        <div class="contact-form">
                            <h2>Feel Free to Contact us</h2>
                            <ul class="form-row">
                                <li class="half-col">
                                    <input type="text" class="form-control" placeholder="Your Name">
                                </li>
                                <li class="half-col">
                                    <input type="text" class="form-control" placeholder="Email">
                                </li>
                                <li class="half-col">
                                    <input type="text" class="form-control" placeholder="Contact">
                                </li>
                                <li class="half-col">
                                    <input type="text" class="form-control" placeholder="Subject">
                                </li>
                                <li class="full-col">
                                    <textarea  class="form-control" placeholder="Write Your Message"></textarea>
                                </li>
                                <li class="full-col">
                                    <button type="button">Contact us Now</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--Form End-->
                    <!--Map Start-->
                    <div class="col-md-6">
                        <div class="google-map">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1697.3072037532606!2d-74.00693495101423!3d40.7123457655961!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a188537cd67%3A0xa98395c323552df0!2sJacob+Wrey+Mould+Fountain!5e0!3m2!1sen!2s!4v1556523104271!5m2!1sen!2s"></iframe>
                        </div>
                    </div>
                    <!--Map End-->
                </div>
                <div class="row mt-60">
                    <div class="col-md-12">
                        <h2>Contact Information</h2>
                    </div>
                    <!--Start-->
                    <div class="col-md-4">
                        <div class="contact-box">
                            <h5>Address:</h5>
                            <p> 4700 Millenia Blvd # 175, Orlando,
                                FL 32839, USA
                            </p>
                        </div>
                    </div>
                    <!--End-->
                    <!--Start-->
                    <div class="col-md-4">
                        <div class="contact-box">
                            <h5>Contact:</h5>
                            <p><strong>Phone:</strong> +1 321 2345 678-9</p>
                            <p><strong>Fax: </strong>+1 321 2345 876-7 </p>
                        </div>
                    </div>
                    <!--End-->
                    <!--Start-->
                    <div class="col-md-4">
                        <div class="contact-box">
                            <h5>For More Information:</h5>
                            <p> <strong>Email:</strong> info@soccer.com</p>
                            <p>contact@soccer.com</p>
                        </div>
                    </div>
                    <!--End-->
                </div>
            </div>
        </div>
        <!--Contact Page End-->
    </div>
@endsection
