<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Scripts -->
    <script src="{{ asset('/js/app.js') }}"></script>

    <!-- Styles -->
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

    <livewire:styles/>
</head>
<body>

<div class="w-full h-screen p-2 bg-blue-500">
    <livewire:sales-orders-status-board
        before-status-board-view="before-view"
        :sortable="true"
        :sortable-between-statuses="true"
        status-footer-view="footer"
        record-view="record"
    />
</div>

<livewire:scripts/>

</body>
</html>
