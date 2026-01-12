<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-slate-800 border border-slate-600 rounded-md font-semibold text-xs text-slate-300 uppercase tracking-widest shadow-lg hover:bg-slate-700 hover:border-slate-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-slate-900 disabled:opacity-25 transition ease-in-out duration-150']) }} style="background-color: #1e293b; color: #cbd5e1; border: 1px solid #475569;">
    {{ $slot }}
</button>
