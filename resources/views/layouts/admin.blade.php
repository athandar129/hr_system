<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'HR System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="bg-dark text-white p-3" style="width: 220px; min-height: 100vh;">
            <h3>HR Admin</h3>
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('employees.index') }}">Employees</a></li>
            </ul>
        </div>

        <!-- Main content -->
        <div class="flex-grow-1 p-4">
            <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
                <div class="container-fluid">
                    <span class="navbar-text">Logged in as {{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="ms-auto">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Logout</button>
                    </form>
                </div>
            </nav>

            @yield('content')
        </div>
    </div>

<!-- Chat Widget -->
<div id="chat-widget" style="position: fixed; bottom: 20px; right: 20px; width: 320px; max-width: 90%; z-index: 9999; font-family: Arial, sans-serif;">

    <!-- Minimized Toggle Button -->
    <button id="chat-toggle" style="background-color:#2563eb;color:#fff;border:none;border-radius:50%;width:50px;height:50px;font-size:24px;cursor:pointer;box-shadow:0 2px 5px rgba(0,0,0,0.3);">
        💬
    </button>

    <!-- Chat Box -->
    <div id="chat-box" style="display:none; flex-direction: column; height:380px; background-color:#fff; border-radius:12px; box-shadow:0 5px 15px rgba(0,0,0,0.3); overflow:hidden; margin-top:10px;">
        <div style="background-color: #2563eb; color: #fff; padding:12px; font-weight:bold; font-size:16px;">
            Employee Bot
        </div>
        <div id="chat-log" style="flex:1; overflow-y:auto; padding:10px; font-size:14px; line-height:1.4; height: calc(100% - 100px);">
        </div>
        <div style="display:flex; border-top:1px solid #eee; padding:8px; background-color:#f9f9f9;">
            <input id="chat-input" type="text" placeholder="Type a message..." style="flex:1; padding:8px; border:1px solid #ddd; border-radius:6px;">
            <button id="chat-send" style="margin-left:6px; padding:8px 12px; background-color:#2563eb; color:#fff; border:none; border-radius:6px; cursor:pointer;">Send</button>
        </div>
    </div>
</div>


    <!-- Chat JavaScript -->
   <script>
(function() {
    const chatToggle = document.getElementById('chat-toggle');
    const chatBox = document.getElementById('chat-box');
    const input = document.getElementById('chat-input');
    const sendBtn = document.getElementById('chat-send');
    const chatLog = document.getElementById('chat-log');
    const route = "{{ route('chatbot.handle') }}";
    const token = "{{ csrf_token() }}";

    // Toggle chat box open/close
    chatToggle.addEventListener('click', function() {
        chatBox.style.display = chatBox.style.display === 'flex' ? 'none' : 'flex';
    });

    // Add message to chat log
    function addMessage(who, message) {
        const div = document.createElement('div');
        div.style.marginBottom = '10px';
        div.style.wordWrap = 'break-word';
        div.innerHTML = `<strong>${who}:</strong> <span style="white-space: pre-line;">${message}</span>`;
        chatLog.appendChild(div);
        chatLog.scrollTop = chatLog.scrollHeight;
    }

    // Send message to Laravel controller
    async function sendMessage() {
        const message = input.value.trim();
        if (!message) return;
        addMessage('You', message);
        input.value = '';

        try {
            const response = await fetch(route, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ message })
            });

            const data = await response.json();
            addMessage('Bot', data.reply || 'Sorry, no response');
        } catch (err) {
            addMessage('Bot', 'Error: Could not contact server.');
            console.error(err);
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    input.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') sendMessage();
    });

})();
</script>

</body>
</html>
