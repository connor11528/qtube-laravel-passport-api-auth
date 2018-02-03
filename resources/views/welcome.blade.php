<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Authentication API with Laravel 5.5</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    </head>
    <body>
        <div class="sub-nav text-center" v-cloak="">
            <router-link active-class="active" :to="{ name: 'HomePage' }" exact>Home</router-link>
            <router-link active-class="active" :to="{ name: 'TrendingPage' }">Trending</router-link>
            <router-link active-class="active" :to="{ name: 'SubscriptionPage' }">Subscriptions</router-link>
        </div>
        <router-view>
            {{-- placeholder to show while Vue loads the components for the given route --}}
            <p class="text-center" style="padding:2em;">
                <span class="glyphicon glyphicon-refresh spin"></span> Loading...
            </p>
        </router-view>
    </body>
</html>
