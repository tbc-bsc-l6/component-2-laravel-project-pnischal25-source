@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/10 border border-white/20 focus:border-purple-500 focus:ring-purple-500 rounded-xl shadow-lg text-white placeholder-gray-400 backdrop-blur-md transition-all duration-300']) }} style="background-color: rgba(255,255,255,0.1); color: white;">
