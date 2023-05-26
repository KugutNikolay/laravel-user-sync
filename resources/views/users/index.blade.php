<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('User List') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    </head>

    <body>
        <div class="container-fluid">
            <h1>{{ __('User List') }}</h1>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="2">{{ __('Id') }}</th>
                        <th rowspan="2">{{ __('Name') }}</th>
                        <th rowspan="2">{{ __('Username') }}</th>
                        <th rowspan="2">{{ __('Email') }}</th>
                        <th rowspan="2">{{ __('Phone') }}</th>
                        <th rowspan="2">{{ __('Website') }}</th>
                        <!-- Address -->
                        <th colspan="4" class="text-center"> {{ __('Address') }}</th>
                        <!-- Geo -->
                        <th colspan="2" class="text-center"> {{ __('Geo') }}</th>
                        <!-- Company -->
                        <th colspan="3" class="text-center"> {{ __('Company') }}</th>
                    </tr>
                    <tr>
                        <!-- Address -->
                        <th>{{ __('Street') }}</th>
                        <th>{{ __('Suite') }}</th>
                        <th>{{ __('City') }}</th>
                        <th>{{ __('Zip') }}</th>
                        <!-- Geo -->
                        <th>{{ __('Lat') }}</th>
                        <th>{{ __('Lng') }}</th>
                        <!-- Company -->
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Catch Phrase') }}</th>
                        <th>{{ __('Bs') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->website }}</td>
                        <td>{{ $user->street }}</td>
                        <td>{{ $user->suite }}</td>
                        <td>{{ $user->city }}</td>
                        <td>{{ $user->zipcode }}</td>
                        <td>{{ $user->geo_lat }}</td>
                        <td>{{ $user->geo_lng }}</td>
                        <td>{{ $user->company_name }}</td>
                        <td>{{ $user->company_catch_phrase }}</td>
                        <td>{{ $user->company_bs }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="py-2">
                {{ $users->links() }}
            </div>
        </div>
    </body>
</html>
