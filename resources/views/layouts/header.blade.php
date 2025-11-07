

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Thay đổi tiền tệ</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formChangeCurrency" method="POST" action="{{ route('home.currency.update') }}">
                            @csrf
                            <div class="mb-3">
                                @php
                                    $currencies = [
                                        'VND' => '🇻🇳 Việt Nam Đồng',
                                        'USD' => '🇺🇸 Đô la Mỹ',
                                        'EUR' => '🇪🇺 Euro',
                                        // Thêm các loại tiền tệ khác nếu cần
                                    ];
                                @endphp <select class="form-select" id="currency" name="currency" required>
                                    @foreach ($currencies as $code => $name)
                                        <option value="{{ $code }}" {{ Auth::user() && Auth::user()->currency == $code ? 'selected' : '' }}>{{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary-color" id="btnUpdateCurrency">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Chat Modal Button -->
        @if (Auth::check() && Auth::user()->isPremium == 1)
        <button class="btn" data-bs-toggle="modal" data-bs-target="#chatModal">
            <svg width="39" height="34" viewBox="0 0 39 34" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M31.2 0C33.2687 0 35.2526 0.754151 36.7154 2.09655C38.1782 3.43895 39 5.25963 39 7.15806V21.4742C39 23.3726 38.1782 25.1933 36.7154 26.5357C35.2526 27.8781 33.2687 28.6323 31.2 28.6323H21.9882L12.7023 33.7449C12.4226 33.8989 12.1054 33.9861 11.7795 33.9985C11.4536 34.0108 11.1296 33.948 10.837 33.8157C10.5445 33.6834 10.2928 33.4859 10.1049 33.2413C9.91702 32.9966 9.79903 32.7126 9.7617 32.4153L9.75 32.2113V28.6323H7.8C5.79883 28.6323 3.8742 27.9264 2.42422 26.6607C0.974229 25.395 0.109809 23.6663 0.00975022 21.8321L0 21.4742V7.15806C0 5.25963 0.821783 3.43895 2.28457 2.09655C3.74735 0.754151 5.73131 0 7.8 0H31.2ZM25.74 16.6174C25.3707 16.2853 24.8728 16.1013 24.3557 16.106C23.8386 16.1107 23.3447 16.3037 22.9827 16.6425C22.5288 17.0678 21.9869 17.4057 21.3889 17.6363C20.7909 17.867 20.1487 17.9858 19.5 17.9858C18.8513 17.9858 18.2091 17.867 17.6111 17.6363C17.0131 17.4057 16.4712 17.0678 16.0173 16.6425C15.6534 16.3115 15.1622 16.1252 14.6499 16.1239C14.1375 16.1226 13.6452 16.3064 13.2794 16.6356C12.9135 16.9647 12.7035 17.4128 12.6948 17.8829C12.6861 18.353 12.8793 18.8074 13.2327 19.1478C14.0497 19.9129 15.0248 20.5207 16.101 20.9357C17.1772 21.3506 18.3327 21.5643 19.5 21.5643C20.6673 21.5643 21.8228 21.3506 22.899 20.9357C23.9752 20.5207 24.9503 19.9129 25.7673 19.1478C26.1293 18.8089 26.3297 18.352 26.3246 17.8774C26.3195 17.4029 26.1092 16.9497 25.74 16.6174ZM14.6445 8.94758H14.625C14.1078 8.94758 13.6118 9.13612 13.2461 9.47172C12.8804 9.80732 12.675 10.2625 12.675 10.7371C12.675 11.2117 12.8804 11.6669 13.2461 12.0025C13.6118 12.3381 14.1078 12.5266 14.625 12.5266H14.6445C15.1617 12.5266 15.6577 12.3381 16.0234 12.0025C16.3891 11.6669 16.5945 11.2117 16.5945 10.7371C16.5945 10.2625 16.3891 9.80732 16.0234 9.47172C15.6577 9.13612 15.1617 8.94758 14.6445 8.94758ZM24.3945 8.94758H24.375C23.8578 8.94758 23.3618 9.13612 22.9961 9.47172C22.6304 9.80732 22.425 10.2625 22.425 10.7371C22.425 11.2117 22.6304 11.6669 22.9961 12.0025C23.3618 12.3381 23.8578 12.5266 24.375 12.5266H24.3945C24.9117 12.5266 25.4077 12.3381 25.7734 12.0025C26.1391 11.6669 26.3445 11.2117 26.3445 10.7371C26.3445 10.2625 26.1391 9.80732 25.7734 9.47172C25.4077 9.13612 24.9117 8.94758 24.3945 8.94758Z"
                    fill="#6C63FF" />
            </svg>
        </button>

        <!-- Chat Modal -->
        <div class="modal fade" id="chatModal" tabindex="-1" aria-labelledby="chatModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-right">
                <div class="modal-content h-100">
                    <div class="modal-header bg-primary-color text-white">
                        <h5 class="modal-title" id="chatModalLabel">
                            <i class="fas fa-robot mr-2"></i> Chatbot
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-0">
                        <div id="chat-box" class="chat-messages">
                        </div>
                        <form id="chat-form" class="chat-input">
                            <div class="input-group">
                                <input type="text" id="message" class="form-control" placeholder="Nhập tin nhắn..."
                                    required>
                                <button type="submit" class="btn btn-primary-color">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>

@push('js')
    <script>
        $(document).ready(function() {
            let updateBtn = $("#btnUpdateCurrency");
            updateBtn.on("click", function() {
                $("#formChangeCurrency").submit();
            });

            $('#chatModal').modal({
                backdrop: 'static',
                keyboard: false,
                show: false
            });

            $('#chat-form').submit(function(e) {
                e.preventDefault();
                const message = $('#message').val().trim();

                if (message) {
                    // Add user message
                    appendMessage('user', message, new Date().toLocaleTimeString([], {
                        hour: '2-digit',
                        minute: '2-digit'
                    }));
                    $('#message').val('');

                    // Send message to server
                    $.ajax({
                        url: "{{ route('chat.createTransaction') }}",
                        method: 'POST',
                        data: {
                            message: message,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            appendMessage('bot', response.message, new Date()
                                .toLocaleTimeString([], {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }));
                        },
                        error: function() {
                            appendMessage('bot', "Something went wrong.", new Date()
                                .toLocaleTimeString([], {
                                    hour: '2-digit',
                                    minute: '2-digit'
                                }));
                        }
                    });

                    scrollToBottom();
                }
            });

            // Function to scroll chat to bottom
            function scrollToBottom() {
                const chatBox = $('#chat-box');
                chatBox.scrollTop(chatBox.prop("scrollHeight"));
            }

            // Handle window resize
            $(window).on('resize', function() {
                if ($('#chatModal').hasClass('show')) {
                    adjustModalPosition();
                }
            });

            function adjustModalPosition() {
                const windowWidth = $(window).width();
                if (windowWidth <= 768) {
                    $('.chat-input').css('width', 'calc(100% - 2rem)');
                } else {
                    $('.chat-input').css('width', 'calc(50% - 2rem)');
                }
            }

            // Load chat history when modal opens
            $('#chatModal').on('shown.bs.modal', function() {
                loadChatHistory();
            });

            function loadChatHistory() {
                $.ajax({
                    url: "{{ route('chat.history') }}",
                    method: 'GET',
                    success: function(response) {
                        $('#chat-box').empty();
                        response.forEach(function(message) {
                            console.log(message);
                            appendMessage(
                                message.is_bot ? 'bot' : 'user',
                                message.message,
                                message.time // Use pre-formatted time from backend
                            );
                        });
                        scrollToBottom();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert('Failed to load chat history');
                    }
                });
            }

            function appendMessage(sender, text, time) {
                const messageHTML = `
        <div class="message-container ${sender}">
            <div class="message-content">
                <div class="message-text">${text}</div>
                <div class="message-time">${time}</div> 
            </div>
        </div>
    `;
                $('#chat-box').append(messageHTML);
                scrollToBottom();
            }
        });
    </script>
@endpush
