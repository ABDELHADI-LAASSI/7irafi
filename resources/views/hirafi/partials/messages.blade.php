@foreach ($messages as $message)
<div class="message {{ $message->sender_id === auth()->id() ? 'text-end' : 'text-start' }}">
    <p class="p-2 rounded {{ $message->sender_id === auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
        {{ $message->message }}
    </p>
    <small class="text-muted">{{ $message->created_at->format('H:i') }}</small>
</div>
@endforeach
