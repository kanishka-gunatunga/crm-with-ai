<div id="chat-widget-container" class="fixed bottom-4 right-4 z-50 font-sans antialiased">
    <!-- Toggle Button - Only visible when chat is closed -->
    <button id="chat-toggle"
        class="w-14 h-14 rounded-full flex items-center justify-center text-white shadow-xl hover:scale-105 hover:shadow-2xl transition-all duration-300 cursor-pointer"
        style="background: var(--primary-color); border-radius: 100%;" aria-label="Open Chat">
        <div class="relative">
            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z"></path>
            </svg>
            <span
                class="absolute -top-1 -right-1 w-3.5 h-3.5 bg-green-500 rounded-full border-2 border-white animate-pulse"></span>
        </div>
    </button>

    <!-- Chat Window - Only visible when chat is open -->
    <div id="chat-widget"
        class="hidden w-[380px] h-[600px] bg-white rounded-[10px] shadow-2xl flex-col overflow-hidden border border-gray-100 animate-in fade-in slide-in-from-bottom-10 duration-300">
        <!-- Header -->
        <div class="p-4 flex items-center justify-between text-white shadow-md relative overflow-hidden shrink-0"
            style="background: var(--primary-color);">
            <div class="flex items-center gap-3 relative z-10">
                <div class="relative">
                    <div
                        class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center overflow-hidden backdrop-blur-sm border border-white/30">
                        <img src="https://img.icons8.com/color/96/robot-3.png" alt="Agent" width="40" height="40"
                            class="object-cover">
                    </div>
                    <span
                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 rounded-full border-2 border-blue-600"></span>
                </div>
                <div class="flex flex-col">
                    <h3 class="font-bold text-base leading-tight">CRM Assistant</h3>
                    <div
                        class="flex items-center gap-1.5 text-[10px] text-blue-100 bg-white/10 px-2 py-0.5 rounded-full w-fit mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z">
                            </path>
                        </svg>
                        <span>AI Agent Active</span>
                    </div>
                </div>
            </div>
            <button id="chat-close"
                class="bg-white/10 hover:bg-white/20 p-2 rounded-[5px] transition-colors backdrop-blur-sm"
                style="border-radius: 100%;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Messages Area -->
        <div id="chat-messages"
            class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50/50 scrollbar-thin scrollbar-thumb-gray-200 scrollbar-track-transparent">
            <!-- Welcome Message -->
            <div class="flex gap-3 flex-row">
                <div
                    class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 border border-blue-200 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="https://img.icons8.com/color/48/robot-3.png" alt="Bot" width="32" height="32"
                        class="object-cover">
                </div>
                <div
                    class="max-w-[75%] p-3.5 rounded-2xl text-sm shadow-sm leading-relaxed bg-white border border-gray-100 text-gray-700 rounded-bl-sm">
                    Hello! I am your CRM Virtual Assistant. How can I help you today?
                </div>
            </div>
        </div>

        <!-- Input Area -->
        <form id="chat-form" class="p-4 bg-white border-t border-gray-100 flex gap-2 items-center shrink-0">
            <input type="text" id="chat-input" placeholder="Type a message..."
                class="flex-1 bg-gray-100 hover:bg-gray-50 focus:bg-white rounded-[5px] px-2 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-[var(--primary-color)] focus:border-[var(--primary-color)] transition-all duration-200 border border-transparent"
                autocomplete="off">
            <button type="submit" id="chat-submit"
                class="p-3 text-white rounded-full hover:opacity-90 disabled:opacity-50 disabled:cursor-not-allowed transition-all duration-200 shadow-md hover:shadow-lg transform active:scale-95 flex items-center justify-center"
                style="background-color: var(--primary-color);">
                <svg id="send-icon" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m22 2-7 20-4-9-9-4Z"></path>
                    <path d="M22 2 11 13"></path>
                </svg>
                <svg id="loading-icon" class="hidden animate-spin" xmlns="http://www.w3.org/2000/svg" width="18"
                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 12a9 9 0 1 1-6.219-8.56"></path>
                </svg>
            </button>
        </form>
    </div>
</div>

<style>
    .scrollbar-thin::-webkit-scrollbar {
        width: 6px;
    }

    .scrollbar-thin::-webkit-scrollbar-track {
        background: transparent;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #E5E7EB;
        border-radius: 10px;
    }

    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #D1D5DB;
    }
</style>

@push('scripts')
    @vite(['resources/css/app.css', 'resources/js/chatbot.js'])
@endpush