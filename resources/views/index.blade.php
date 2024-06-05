<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Demo Application</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="/css/bootstrap-notifications.min.css">
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Demo App</a>
                </div>

                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="dropdown dropdown-notifications">
                            <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                                <i data-count="{{ $notifications->count() }}" class="glyphicon glyphicon-bell notification-icon"></i>
                            </a>

                            <div class="dropdown-container">
                                <div class="dropdown-toolbar">
                                    <div class="dropdown-toolbar-actions">
                                        <a href="#">Mark all as read</a>
                                    </div>
                                    <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">{{ $notifications->count() }}</span>)</h3>
                                </div>
                                <ul class="dropdown-menu">
                                    @foreach($notifications as $notification)
                                    <li class="notification active">
                                        <div class="media">
                                            <div class="media-body">
                                                <p class="notification-desc">{{ $notification->title }}</p>
                                                <div class="notification-meta">
                                                    <small class="timestamp">{{ $notification->message }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="dropdown-footer text-center">
                                    <a href="#">View All</a>
                                </div>
                            </div>
                        </li>
                        <li><a href="#">Timeline</a></li>
                        <li><a href="#">Friends</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <h1>Olá {{ Auth::user()->name }}</h1>
            <hr>
            <a href="{{ route('logout') }}" class="btn btn-danger">Sair</a>
        </div>

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript">
            var user = '<?php echo Auth::user()->id ?>';
            var notificationsWrapper = $('.dropdown-notifications');
            var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
            var notificationsCountElem = notificationsToggle.find('i[data-count]');
            var notificationsCount = parseInt(notificationsCountElem.data('count'));
            var notifications = notificationsWrapper.find('ul.dropdown-menu');

            // if (notificationsCount <= 0) {
            //     notificationsWrapper.hide();
            // }

            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('3401d6a6b66eb02a9a1a', {
                encrypted: true,
                cluster: 'us2'
            });

            // Subscribe to the channel we specified in our Laravel Event
            var channel = pusher.subscribe('channel-user-' + user);

            // Bind a function to a Event (the full Laravel class)
            channel.bind('notification-user', function(data) {
                console.log(data);
                var existingNotifications = notifications.html();
                var newNotificationHtml = `
                <li class="notification active">
                    <div class="media">
                        <div class="media-body">
                            <p class="notification-desc">${data.title}</p>
                            <div class="notification-meta">
                                <small class="timestamp">${data.message}</small>
                            </div>
                        </div>
                    </div>
                </li>`;
                notifications.html(newNotificationHtml + existingNotifications);

                notificationsCount += 1;
                notificationsCountElem.attr('data-count', notificationsCount);
                notificationsWrapper.find('.notif-count').text(notificationsCount);
                notificationsWrapper.show();
            });
        </script>

        {{--
        @vite('resources/js/app.js')
        <script type="module">
            Echo.channel(`my-channel`).listen('MyEvent', (e) => {
                console.log(e);
            });
        </script>
        --}}
    </body>
</html>