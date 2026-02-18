import { marked } from 'marked';

document.addEventListener('DOMContentLoaded', function () {
    const chatToggle = document.getElementById('chat-toggle');
    const chatWidget = document.getElementById('chat-widget');
    const chatClose = document.getElementById('chat-close');
    const chatForm = document.getElementById('chat-form');
    const chatInput = document.getElementById('chat-input');
    const chatMessages = document.getElementById('chat-messages');

    let messageHistory = [];

    // Toggle Chat - Show chat and hide toggle button
    if (chatToggle && chatWidget) {
        chatToggle.addEventListener('click', () => {
            chatWidget.classList.remove('hidden');
            chatWidget.classList.add('flex');
            chatToggle.classList.add('hidden');

            // Focus input
            setTimeout(() => {
                chatInput.focus();
            }, 100);
        });
    }

    // Close Chat - Hide chat and show toggle button
    if (chatClose && chatWidget) {
        chatClose.addEventListener('click', () => {
            chatWidget.classList.add('hidden');
            chatWidget.classList.remove('flex');
            chatToggle.classList.remove('hidden');
        });
    }

    // Auto-scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Add Message to UI
    function addMessage(role, content) {
        const div = document.createElement('div');

        if (role === 'assistant' || role === 'system') {
            div.className = "flex gap-3 flex-row animate-in fade-in slide-in-from-left-4 duration-500";
            div.innerHTML = `
                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 border border-blue-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                    <img alt="Bot" src="https://img.icons8.com/color/48/robot-3.png" class="object-cover w-5 h-5">
                </div>
                <div class="max-w-[75%] p-3.5 rounded-2xl text-sm shadow-sm leading-relaxed bg-white border border-gray-100 text-gray-700 rounded-bl-sm markdown-content">
                    ${formatMessage(content)}
                </div>
            `;
        } else {
            // User
            div.className = "flex gap-3 flex-row-reverse animate-in fade-in slide-in-from-right-4 duration-500";
            div.innerHTML = `
                <div class="max-w-[75%] p-3.5 rounded-2xl text-sm shadow-sm leading-relaxed text-white rounded-br-sm" style="background-color: var(--primary-color);">
                    ${escapeHtml(content)}
                </div>
            `;
        }

        chatMessages.appendChild(div);
        scrollToBottom();
    }

    // Loading Indicator with "Thinking for answer..." text
    function addLoadingIndicator() {
        const id = 'loading-' + Date.now();
        const div = document.createElement('div');
        div.id = id;
        div.className = "flex gap-3 flex-row animate-in fade-in duration-300";
        div.innerHTML = `
            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 border border-blue-200 flex items-center justify-center overflow-hidden shrink-0 shadow-sm">
                <img alt="Bot" src="https://img.icons8.com/color/48/robot-3.png" class="object-cover w-5 h-5">
            </div>
            <div class="bg-white border border-gray-100 text-gray-500 rounded-2xl rounded-bl-sm p-4 shadow-sm flex items-center gap-2">
                <svg class="animate-spin" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--primary-color);">
                    <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
                </svg>
                <span class="text-xs font-medium">Thinking for answer...</span>
            </div>
        `;
        chatMessages.appendChild(div);
        scrollToBottom();
        return id;
    }

    function removeMessage(id) {
        const el = document.getElementById(id);
        if (el) el.remove();
    }

    // Format Message using marked.js
    function formatMessage(text) {
        // Configure marked options
        marked.setOptions({
            gfm: true,
            breaks: true,
            headerIds: false,
            mangle: false
        });

        return marked.parse(text);
    }

    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    // Handle Submit
    // Handle Submit
    if (chatForm) {
        chatForm.addEventListener('submit', async function (e) {
            e.preventDefault();
            const message = chatInput.value.trim();
            if (!message) return;

            // Get elements dynamically
            const chatSubmit = document.getElementById('chat-submit');
            const sendIcon = document.getElementById('send-icon');
            const loadingIcon = document.getElementById('loading-icon');

            // Add User Message
            addMessage('user', message);
            chatInput.value = '';

            // Set Loading State
            if (chatSubmit) chatSubmit.disabled = true;
            if (sendIcon) sendIcon.classList.add('hidden');
            if (loadingIcon) loadingIcon.classList.remove('hidden');

            // Show Typing Indicator
            const loadingId = addLoadingIndicator();

            try {
                // Prepare payload
                const payload = {
                    messages: [...messageHistory, { role: 'user', content: message }]
                };

                const response = await fetch('/chat/agent', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(payload)
                });

                const data = await response.json();

                if (data.error) {
                    addMessage('system', 'Error: ' + data.error);
                } else {
                    addMessage('assistant', data.message);
                    if (data.history) {
                        messageHistory = data.history;
                    }
                }

            } catch (error) {
                addMessage('system', 'Sorry, something went wrong. Please try again.');
                console.error('Chat Error:', error);
            } finally {
                // Always remove loading indicator
                removeMessage(loadingId);

                // Reset Button State
                if (chatSubmit) chatSubmit.disabled = false;
                if (sendIcon) sendIcon.classList.remove('hidden');
                if (loadingIcon) loadingIcon.classList.add('hidden');

                chatInput.focus();
            }
        });
    }
});
