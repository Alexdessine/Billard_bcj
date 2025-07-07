    <script>
        setTimeout(function() {
            window.location.href = "{{ admin_url('club/licencies') }}";
        }, 1000);
    </script>
    <style>
        body { text-align: center; margin-top: 50px; font-family: Arial; }
    </style>
    <h3>{{ $message }}</h3>
    <p>Redirection automatique dans une seconde...</p>
<script>
    setTimeout(function() {
        window.location.href = "{{ admin_url('club/licencies') }}?success={{ urlencode($message) }}";
    }, 1000);
</script>