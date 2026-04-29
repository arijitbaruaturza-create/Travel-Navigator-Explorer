<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Chat with {{ $guide->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50 text-slate-800">
    <div class="max-w-4xl mx-auto p-4">
        <div class="mb-6 flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-4xl font-bold">Chat with {{ $guide->name }}</h1>
                <p class="mt-2 text-slate-600">Use the chat below to send quick messages to the guide.</p>
            </div>
            <a href="{{ route('guides.show', $guide->id) }}" class="inline-flex px-5 py-3 rounded-full bg-gray-200 text-slate-700 hover:bg-gray-300 transition">Back to Profile</a>
        </div>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-200 p-6">
            <div class="grid gap-6 lg:grid-cols-[1fr_320px]">
                <div>
                    <div id="chatFeed" class="space-y-4 h-[520px] overflow-y-auto rounded-3xl border border-slate-200 bg-slate-50 p-5"></div>
                </div>
                <div class="space-y-4">
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-5">
                        <p class="font-semibold">Guide:</p>
                        <p class="text-slate-600">{{ $guide->name }}</p>
                        @if($guide->destination)
                            <p class="mt-2 text-sm text-slate-500">Destination: {{ $guide->destination->name }}</p>
                        @endif
                    </div>
                    <form id="chatForm" class="space-y-4">
                        @csrf
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Your name</label>
                            <input id="senderName" type="text" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" placeholder="Your name" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Email</label>
                            <input id="guestEmail" type="email" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" placeholder="you@example.com" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700">Message</label>
                            <textarea id="messageText" rows="4" class="mt-2 w-full rounded-2xl border border-slate-300 px-4 py-3" placeholder="Write your question..."></textarea>
                        </div>
                        <button type="submit" class="w-full inline-flex justify-center rounded-full bg-blue-600 px-5 py-3 text-white font-semibold hover:bg-blue-700">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const guideId = {{ $guide->id }};
        const chatFeed = document.getElementById('chatFeed');
        const chatForm = document.getElementById('chatForm');

        async function loadMessages() {
            const guestEmail = document.getElementById('guestEmail').value;
            const url = `/guides/${guideId}/messages` + (guestEmail ? `?email=${encodeURIComponent(guestEmail)}` : '');
            const response = await fetch(url);
            const messages = await response.json();
            chatFeed.innerHTML = messages.map(msg => {
                const bubbleClass = msg.sender_type === 'guide' ? 'bg-blue-600 text-white self-end' : 'bg-slate-100 text-slate-800 self-start';
                const sender = msg.sender_type === 'guide' ? 'Guide' : msg.sender_name;
                return `
                    <div class="flex ${msg.sender_type === 'guide' ? 'justify-end' : 'justify-start'}">
                        <div class="max-w-[85%] rounded-3xl p-4 ${bubbleClass}">
                            <div class="text-xs uppercase tracking-[0.18em] mb-2 ${msg.sender_type === 'guide' ? 'text-sky-100' : 'text-slate-500'}">${sender}</div>
                            <div>${msg.message.replace(/\n/g, '<br>')}</div>
                            <div class="mt-2 text-[11px] text-slate-400 text-right">${new Date(msg.created_at).toLocaleString()}</div>
                        </div>
                    </div>
                `;
            }).join('');
            chatFeed.scrollTop = chatFeed.scrollHeight;
        }

        chatForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            const senderName = document.getElementById('senderName').value.trim();
            const guestEmail = document.getElementById('guestEmail').value.trim();
            const message = document.getElementById('messageText').value.trim();

            if (!senderName || !guestEmail || !message) {
                return;
            }

            await fetch(`/guides/${guideId}/messages`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                },
                body: JSON.stringify({
                    sender_name: senderName,
                    receiver_name: @json($guide->name),
                    guest_email: guestEmail,
                    message: message,
                    sender_type: 'user',
                }),
            });

            document.getElementById('messageText').value = '';
            loadMessages();
        });

        setInterval(loadMessages, 3000);
        window.addEventListener('load', loadMessages);
    </script>
</body>
</html>
