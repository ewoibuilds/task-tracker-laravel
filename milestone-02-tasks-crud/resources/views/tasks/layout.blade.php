<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | Task tracker</title>
  <style>
    body { font-family: system-ui, sans-serif; max-width: 40rem; margin: 2rem auto; padding: 0 1rem; line-height: 1.5; }
    .done { text-decoration: line-through; color: #555; }
    .status { background: #e7f6ec; padding: .5rem; }
    .error { color: #b00020; }
    li { margin-bottom: .75rem; }
    form.inline { display: inline; }
  </style>
</head>
<body>
  <p><a href="{{ route('dashboard') }}">Dashboard</a> | <a href="{{ route('tasks.index') }}">My tasks</a></p>
  @if (session('status'))
    <p class="status" role="status">{{ session('status') }}</p>
  @endif
  @yield('content')
</body>
</html>
