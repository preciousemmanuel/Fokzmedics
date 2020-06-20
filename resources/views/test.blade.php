<!DOCTYPE html>
<head>
  <title>Pusher Test</title>
  <script src="https://js.pusher.com/5.0/pusher.min.js"></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('cb6fdb5fd93409f87da0', {
      cluster: 'eu',
      forceTLS: true
    });

    var channel = pusher.subscribe('message-channel');
    channel.bind('App\\Events\\NewMessage', function(data) {
      alert(JSON.stringify(data));
    });
  </script>
</head>
<body>
  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
</body>
