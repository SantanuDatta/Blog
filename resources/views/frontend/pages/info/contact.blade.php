@extends('frontend.layout.template')

@section('title', 'Contact')
@section('body-content')
    <!-- page header -->
    <section class="page-header">
        <div class="container-xl">
            <div class="text-center">
                <h1 class="mt-0 mb-2">Contact</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Contact</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <!-- section main content -->
    <section class="main-content">
        <div class="container-xl">

            <!-- section header -->
            <div class="section-header">
                <h3 class="section-title">Send Message</h3>
                <img src="{{ asset('frontend/images/wave.svg') }}" class="wave" alt="wave" />
            </div>

            <!-- Contact Form -->
            <form id="contact-form" class="contact-form" method="post">

                <div class="messages"></div>

                <div class="row">
                    <div class="column col-md-6">
                        <!-- Name input -->
                        <div class="form-group">
                            <input type="text" class="form-control" name="InputName" id="InputName"
                                placeholder="Your name" required="required" data-error="Name is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-6">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="email" class="form-control" id="InputEmail" name="InputEmail"
                                placeholder="Email address" required="required" data-error="Email is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Email input -->
                        <div class="form-group">
                            <input type="text" class="form-control" id="InputSubject" name="InputSubject"
                                placeholder="Subject" required="required" data-error="Subject is required.">
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="column col-md-12">
                        <!-- Message textarea -->
                        <div class="form-group">
                            <textarea name="InputMessage" id="InputMessage" class="form-control" rows="4" placeholder="Your message here..."
                                required="required" data-error="Message is required."></textarea>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <button type="submit" name="submit" id="submit" value="Submit" class="btn btn-default">Submit
                    Message</button><!-- Send Button -->

            </form>
            <!-- Contact Form end -->
        </div>
    </section>
@endsection
