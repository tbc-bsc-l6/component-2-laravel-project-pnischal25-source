@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white border border-gray-300 focus:border-purple-500 focus:ring-purple-500 rounded-lg shadow-sm text-gray-900 placeholder-gray-400 transition-all duration-300']) }}>
