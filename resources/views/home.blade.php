@extends('app')

@section('title')
    Home
@stop

@section('headline')
    <h1 class="text-uppercase">Oh, hey {{ Auth::user()->name }}</h1>
    <h2>It's great to see you again!</h2>
    <a class="btn smooth-scroll" href="{{ route( 'user.profile', [ Auth::user()->id ] ) }}">@lang('user::profile.title.mine')</a>
@endsection

@section('content')
    <div class="row v-margin-lg">
        <div class="col-sm-12 col-md-4">
            <div>
                <h1 class="text-center lime-text"><i class="glyphicon glyphicon-flash"></i></h1>
                <h2 class="text-center">Built on a rock solid foundation</h2>
                <p class="text-justify">The vain project is built upon the heavenly laravel framework. Vain aims to be as flexible as possible while using trusted libraries and frameworks from great developers out of the PHP community. We do not need to reinvent the wheel to do something awesome.</p>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div>
                <h1 class="text-center lime-text"><i class="glyphicon glyphicon-user"></i></h1>
                <h2 class="text-center">User Experience Focused</h2>
                <p class="text-justify">We are no professional UX developers but we know the benefits of a beatifully crafted user interface. For all that matters, we do our best to built such a great experience, too.</p>
            </div>
        </div>

        <div class="col-sm-12 col-md-4">
            <div>
                <h1 class="text-center lime-text"><i class="glyphicon glyphicon-cog"></i></h1>
                <h2 class="text-center">Easy to work with, like really...</h2>
                <p class="text-justify">No matter if you are an developer or casual user, the steps that are required to get Vain up an running are as simple as developing extensions and plugins. Given the fact that Vain is based on the laravel foundation you have such a great community all around you for every help you could need.</p>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <div class="container">
        <div class="row v-margin-lg">
            <div class="col-lg-6 col-sm-12">
                <h3>About us</h3>
                <p class="lead">We are a team of students working on this project with love and dedication. Any amount would help support and continue development on this project and is greatly appreciated.</p>
            </div>
            <div class="col-lg-3 col-sm-12">
                <h3>GitHub</h3>
                <ul class="list-unstyled">
                    <li><a href="https://github.com/fgreinus">@fgreinus</a></li>
                    <li><a href="https://github.com/ottowayne">@ottowayne</a></li>
                    <li><a href="https://github.com/voydz">@voydz</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-sm-12">
                <h3>Twitter</h3>
                <ul class="list-unstyled">
                    <li><a href="https://twitter.com/fgreinus">@fgreinus</a></li>
                    <li><a href="https://twitter.com/ottowayne">@ottowayne</a></li>
                    <li><a href="https://twitter.com/voyd_z">@voyd_z</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
