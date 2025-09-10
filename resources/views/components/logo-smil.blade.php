@props([
    'title' => 'Smil',
    'subtitle' => 'Project',
    'description' => 'Task Management'
])

<div class="flex justify-center items-center w-full h-full">
    <svg class="w-[60%] h-auto" viewBox="0 0 300 140" xmlns="http://www.w3.org/2000/svg">
        <!-- Fondo cuadrado teal -->
        <rect x="0" y="0" width="110" height="120" rx="20" fill="#2CB5A0"/>

        <!-- Clipboard -->
        <rect x="15" y="30" width="80" height="80" rx="6" fill="white"/>
        <rect x="30" y="25" width="50" height="10" rx="3" fill="#2CB5A0"/>

        <!-- Checkmark -->
        <path d="M50 45 L58 53 L70 40" stroke="#2CB5A0" stroke-width="4" fill="none" stroke-linecap="round"/>

        <!-- Líneas de tareas -->
        @foreach([60, 70, 80, 90] as $y)
            <line x1="25" y1="{{ $y }}" x2="85" y2="{{ $y }}" stroke="#2CB5A0" stroke-width="3" stroke-linecap="round"/>
        @endforeach

        <!-- Texto dinámico -->
        <text x="120" y="40" font-family="Arial, sans-serif" font-size="41" fill="#e8e8e8ff" font-weight="bold">
            {{ $title }}
        </text>
        <text x="120" y="73" font-family="Arial, sans-serif" font-size="32" fill="#e8e8e8ff" font-weight="bold">
            {{ $subtitle }}
        </text>
        <text x="120" y="110" font-family="Arial, sans-serif" font-size="25" fill="#e7e4e4ff">
            {{ $description }}
        </text>
    </svg>
</div>