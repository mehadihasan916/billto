<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gemini Chat</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .chat-container {
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 80vh; /* Adjust height as needed */
        }
        .chat-header {
            background-color: #007bff;
            color: white;
            padding: 15px 20px;
            font-size: 1.2em;
            text-align: center;
            border-bottom: 1px solid #0056b3;
        }
        .chat-messages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            background-color: #e9ebee;
            display: flex;
            flex-direction: column;
        }
        .message {
            max-width: 75%;
            padding: 10px 15px;
            border-radius: 20px;
            margin-bottom: 10px;
            line-height: 1.4;
        }
        .message.user {
            align-self: flex-end;
            background-color: #007bff;
            color: white;
            border-bottom-right-radius: 5px; /* Adjust for better look */
        }
        .message.gemini {
            align-self: flex-start;
            background-color: #f8f8f8;
            color: #333;
            border: 1px solid #ddd;
            border-bottom-left-radius: 5px; /* Adjust for better look */
        }
        .chat-input-form {
            display: flex;
            padding: 15px 20px;
            border-top: 1px solid #eee;
            background-color: #fff;
        }
        .chat-input-form input[type="text"] {
            flex-grow: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 25px;
            font-size: 1em;
            margin-right: 10px;
            outline: none;
        }
        .chat-input-form button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }
        .chat-input-form button:hover {
            background-color: #218838;
        }
        .typing-indicator {
            font-style: italic;
            color: #888;
            margin-top: 5px;
            margin-left: 10px;
        }

        /* Floating Chat Icon */
        .chat-icon-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2em;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            transition: transform 0.3s ease;
        }
        .chat-icon-float:hover {
            transform: scale(1.05);
        }
        .chat-popup {
            display: none; /* Hidden by default */
            position: fixed;
            bottom: 100px; /* Above the icon */
            right: 30px;
            z-index: 999;
        }
        .chat-popup.show {
            display: flex; /* Show when active */
        }
    </style>
</head>
<body>

    <div class="chat-icon-float" id="chatIcon">💬</div>

    <div class="chat-popup" id="chatPopup">
        <div class="chat-container">
            <div class="chat-header">
                Gemini Chat
            </div>
            <div class="chat-messages" id="chatMessages">
                <div class="message gemini">Hello! How can I help you today?</div>
            </div>
            <form class="chat-input-form" id="chatForm">
                <input type="text" id="chatInput" placeholder="Type your message..." autocomplete="off">
                <button type="submit">Send</button>
            </form>
            <div class="typing-indicator" id="typingIndicator" style="display: none;">Gemini is typing...</div>
        </div>
    </div>

    <script>
        const chatIcon = document.getElementById('chatIcon');
        const chatPopup = document.getElementById('chatPopup');
        const chatMessages = document.getElementById('chatMessages');
        const chatForm = document.getElementById('chatForm');
        const chatInput = document.getElementById('chatInput');
        const typingIndicator = document.getElementById('typingIndicator');

        // Toggle chat popup visibility
        chatIcon.addEventListener('click', () => {
            chatPopup.classList.toggle('show');
            if (chatPopup.classList.contains('show')) {
                chatInput.focus(); // Focus input when chat opens
                scrollToBottom();
            }
        });

        chatForm.addEventListener('submit', async (e) => {
            e.preventDefault(); // Prevent default form submission
            const userMessage = chatInput.value.trim();

            if (userMessage) {
                // Add user message to chat window
                addMessage(userMessage, 'user');
                chatInput.value = ''; // Clear input

                typingIndicator.style.display = 'block'; // Show typing indicator
                scrollToBottom();

                try {
                    // Send message to your Laravel API endpoint
                    const response = await fetch('{{ route("api.generate.text") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel CSRF token
                        },
                        body: JSON.stringify({ prompt: userMessage })
                    });

                    const data = await response.json();

                    typingIndicator.style.display = 'none'; // Hide typing indicator

                    if (data.error) {
                        addMessage(`Error: ${data.details || data.error}`, 'gemini');
                    } else {
                        addMessage(data.generated_content, 'gemini');
                    }
                } catch (error) {
                    typingIndicator.style.display = 'none'; // Hide typing indicator
                    addMessage('Sorry, something went wrong. Please try again.', 'gemini');
                    console.error('Fetch error:', error);
                }
                scrollToBottom();
            }
        });

        function addMessage(text, sender) {
            const messageDiv = document.createElement('div');
            messageDiv.classList.add('message', sender);
            messageDiv.textContent = text;
            chatMessages.appendChild(messageDiv);
        }

        function scrollToBottom() {
            chatMessages.scrollTop = chatMessages.scrollHeight;
        }
    </script>
</body>
</html>
