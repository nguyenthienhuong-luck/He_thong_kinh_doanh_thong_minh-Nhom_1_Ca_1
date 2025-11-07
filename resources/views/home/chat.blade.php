@extends('layouts.master')

@section('title', 'Trợ lý AI - SmartBudget')

@section('content')
<style>
:root {
    --primary: #6C63FF;
    --secondary: #9A8BFF;
    --gradient: linear-gradient(135deg, #6C63FF, #9A8BFF);
}

body {
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(180deg, #ECEBFF 0%, #F8F9FF 100%);
}

.chat-wrapper {
    max-width: 850px;
    margin: 60px auto;
    background: #fff;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(108, 99, 255, 0.15);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 80vh;
}

.chat-header {
    background: var(--gradient);
    color: #fff;
    padding: 20px 30px;
    font-weight: 700;
    font-size: 1.3rem;
    text-align: center;
}

.chat-body {
    flex: 1;
    padding: 20px;
    overflow-y: auto;
    background: #F7F8FF;
}

.message {
    margin-bottom: 15px;
    display: flex;
}

.message.bot {
    justify-content: flex-start;
}

.message.user {
    justify-content: flex-end;
}

.message .bubble {
    max-width: 75%;
    padding: 12px 16px;
    border-radius: 15px;
    font-size: 0.95rem;
    line-height: 1.4;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
}

.message.bot .bubble {
    background: #E7E5FF;
    color: #333;
    border-top-left-radius: 0;
}

.message.user .bubble {
    background: var(--gradient);
    color: #fff;
    border-top-right-radius: 0;
}

.chat-footer {
    display: flex;
    padding: 15px 20px;
    border-top: 1px solid #eee;
    background: #fff;
}

.chat-footer input {
    flex: 1;
    border: none;
    border-radius: 10px;
    padding: 12px 15px;
    background: #f3f2ff;
    outline: none;
    font-size: 0.95rem;
}

.chat-footer button {
    background: var(--gradient);
    border: none;
    color: #fff;
    border-radius: 10px;
    padding: 0 22px;
    font-weight: 600;
    margin-left: 10px;
    transition: 0.3s ease;
}

.chat-footer button:hover {
    transform: scale(1.05);
    box-shadow: 0 5px 15px rgba(108, 99, 255, 0.3);
}
</style>

<div class="chat-wrapper">
    <div class="chat-header">
        💬 Trợ lý tài chính SmartBudget
    </div>

    <div class="chat-body" id="chatBody">
        <div class="message bot">
            <div class="bubble">Xin chào 👋! Tôi là trợ lý AI của SmartBudget. Đại ca cần hỏi gì hôm nay?</div>
        </div>
    </div>

    <div class="chat-footer">
        <input type="text" id="chatInput" placeholder="Nhập tin nhắn...">
        <button id="sendBtn"><i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<script>
const input = document.getElementById('chatInput');
const chatBody = document.getElementById('chatBody');

document.getElementById('sendBtn').addEventListener('click', sendMessage);
input.addEventListener('keypress', (e) => {
    if (e.key === 'Enter') sendMessage();
});

function sendMessage() {
    const msg = input.value.trim();
    if (!msg) return;

    appendMessage('user', msg);
    input.value = '';

    // mô phỏng bot phản hồi
    setTimeout(() => {
        const fakeReply = [
            "Tôi hiểu rồi 😄",
            "Bạn muốn tôi giúp gì thêm không?",
            "Đó là một ý kiến hay!",
            "Hãy thử đặt mục tiêu tiết kiệm nhỏ mỗi ngày nhé 💡",
            "Chi tiêu hợp lý là chìa khóa thành công 💰"
        ];
        appendMessage('bot', fakeReply[Math.floor(Math.random() * fakeReply.length)]);
    }, 1000);
}

function appendMessage(sender, text) {
    const div = document.createElement('div');
    div.classList.add('message', sender);
    div.innerHTML = `<div class="bubble">${text}</div>`;
    chatBody.appendChild(div);
    chatBody.scrollTop = chatBody.scrollHeight;
}
</script>
@endsection
