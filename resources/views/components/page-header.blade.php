@props(['title', 'subtitle' => null, 'action' => null, 'actionLabel' => null, 'actionRoute' => null])

<div class="flex items-start justify-between mb-6">
    <div>
        <h1 class="text-xl font-bold text-slate-900">{{ $title }}</h1>
        @if($subtitle)
        <p class="text-sm text-slate-500 mt-0.5">{{ $subtitle }}</p>
        @endif
    </div>
    @if($actionLabel && $actionRoute)
    <a href="{{ route($actionRoute) }}"
       class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        {{ $actionLabel }}
    </a>
    @elseif($actionLabel)
    <button class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition-colors shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        {{ $actionLabel }}
    </button>
    @endif
</div>
