<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot AI</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #e0e7ff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        #chatbox {
            width: 100%;
            max-width: 600px;
            height: 80vh;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        #messages {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
            background: #f0f4ff;
            display: flex;
            flex-direction: column;
        }

        .message-wrapper {
            display: flex;
            margin-bottom: 10px;
            align-items: flex-end;
        }

        .message-wrapper.user {
            flex-direction: row-reverse;
        }

        .avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #ccc;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: bold;
            margin: 0 10px;
            flex-shrink: 0;
        }

        .message {
            max-width: 70%;
            padding: 10px 15px;
            border-radius: 20px;
            line-height: 1.4;
            word-wrap: break-word;
            position: relative;
            background: #007bff;
            color: #fff;
            animation: fadeIn 0.3s ease;
        }

        .message.user {
            background: #28a745;
        }

        .timestamp {
            font-size: 11px;
            color: #555;
            margin-top: 3px;
            text-align: right;
        }

        #chat-input {
            display: flex;
            border-top: 1px solid #ccc;
            padding: 10px;
            background: #ffffff;
        }

        #message {
            flex: 1;
            padding: 10px 15px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 16px;
            outline: none;
        }

        #send {
            padding: 10px 20px;
            margin-left: 10px;
            border: none;
            border-radius: 20px;
            background: #007bff;
            color: white;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
        }

        #send:hover {
            background: #0056b3;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }

        @media (max-width: 640px) {
            #chatbox { height: 90vh; }
            #message { font-size: 14px; }
            #send { font-size: 14px; padding: 8px 15px; }
        }
    </style>
</head>
<body>
<div id="chatbox">
    <div id="messages"></div>
    <div id="chat-input">
        <input type="text" id="message" placeholder="Nhập tin nhắn...">
        <button id="send">Gửi</button>
    </div>
</div>

<script>
    const messagesDiv = document.getElementById('messages');
    const inputField = document.getElementById('message');
    const sendBtn = document.getElementById('send');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function appendMessage(text, sender = 'bot') {
        const wrapper = document.createElement('div');
        wrapper.classList.add('message-wrapper', sender);

        const avatar = document.createElement('div');
        avatar.classList.add('avatar');
        avatar.textContent = sender === 'user' ? 'Bạn' : 'Bot';

        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', sender);
        messageDiv.textContent = text;

        const timestamp = document.createElement('div');
        timestamp.classList.add('timestamp');
        const now = new Date();
        timestamp.textContent = now.toLocaleTimeString('vi-VN', {hour: '2-digit', minute:'2-digit'});

        messageDiv.appendChild(timestamp);
        wrapper.appendChild(avatar);
        wrapper.appendChild(messageDiv);

        messagesDiv.appendChild(wrapper);
        messagesDiv.scrollTop = messagesDiv.scrollHeight;
    }

    async function sendMessage() {
        const msg = inputField.value.trim();
        if (!msg) return;
        appendMessage(msg, 'user');
        inputField.value = '';

        try {
            const res = await fetch("{{ route('chat.createTransaction') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ message: msg })
            });

            if (!res.ok) {
                const text = await res.text();
                appendMessage('Lỗi server: ' + text, 'bot');
                return;
            }

            const data = await res.json();
            if (data.reply) appendMessage(data.reply, 'bot');
            else if (data.message) appendMessage(data.message, 'bot');
            else if (data.error) appendMessage(data.error, 'bot');
        } catch (err) {
            appendMessage('Lỗi khi gửi tin nhắn: ' + err.message, 'bot');
        }
    }

    sendBtn.addEventListener('click', sendMessage);
    inputField.addEventListener('keypress', e => {
        if(e.key === 'Enter') sendMessage();
    });

    async function loadHistory() {
        try {
            const res = await fetch("{{ route('chat.history') }}");
            if (!res.ok) return;
            const logs = await res.json();
            logs.forEach(log => appendMessage(log.message, log.is_bot ? 'bot' : 'user'));
        } catch(err) {
            console.error(err);
        }
    }

    loadHistory();
</script>
</body>
</html>
