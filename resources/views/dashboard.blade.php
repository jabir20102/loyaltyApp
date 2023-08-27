@extends('layouts.app')

@section('content')
    <div class="jumbotron text-center"
        style="background-color: #f8f9fa;
color: #000;
padding: 100px 25px;
font-family: Montserrat, sans-serif;">
        <h1>Loyalty App</h1>
        <p>We specialize in blablabla</p>
        <form>
            <div class="input-group">
                <input type="email" class="form-control" size="50" placeholder="Email Address" required>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-danger">Subscribe</button>
                </div>
            </div>
        </form>
    </div>


    <!-- Container (About Section) -->
    <div id="about" class="container-fluid">
        <div class="row">
            <div class="col-sm-8">
                <h2>About Company Page</h2><br>
                <h5>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.</h4><br>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                        et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                        aliquip
                        ex ea commodo consequat. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                        deserunt mollit anim id est laborum consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                        nisi
                        ut aliquip ex ea commodo consequat.</p>
                    <br>
                    <button class="btn btn-default btn-lg">Get in Touch</button>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-signal logo"></span>
            </div>
        </div>
    </div>
@endsection
