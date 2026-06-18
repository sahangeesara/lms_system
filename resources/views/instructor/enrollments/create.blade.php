<x-instructor-app-layout>
    <x-slot name="header">
        <div class="bg-neutral-900 p-6 rounded-xl border border-neutral-950 shadow-md">
            <h2 class="font-extrabold text-2xl tracking-tight text-white">
                {{ __('Create Enrollment Bridge') }}
            </h2>
            <p class="text-sm text-neutral-400 mt-0.5">
                {{ __('Manually assign standard user parameters into target premium classroom access paths.') }}
            </p>
        </div>
    </x-slot>

    <div class="bg-white min-h-screen p-6">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.enrollments.store') }}" method="POST" class="p-8 rounded-2xl border border-neutral-200 shadow-sm space-y-6 bg-white">
                @csrf

                @if($errors->any())
                    <div class="p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold space-y-1">
                        @foreach($errors->all() as $error)
                            <div class="flex items-center gap-2">⚠️ {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Target Student Profile') }}</label>
                        <select name="user_id" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            <option value="">-- {{ __('Select User') }} --</option>
                            @foreach($users ?? [] as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Target Course Matrix') }}</label>
                        <select name="course_id" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            <option value="">-- {{ __('Select Course') }} --</option>
                            @foreach($courses ?? [] as $course)
                                <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                                    {{ $course->title }} (${{ number_format($course->price, 2) }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Amount Credited ($)') }}</label>
                        <input type="number" step="0.01" name="amount_paid" value="{{ old('amount_paid', '0.00') }}" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Payment Database Tracking Key') }}</label>
                        <input type="number" name="payment_id" value="{{ old('payment_id') }}" placeholder="{{ __('Optional payment ID index key pointer') }}" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Admissions Status Pipeline') }}</label>
                        <select name="status" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="suspended" {{ old('status') === 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-neutral-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            <span class="ms-3 text-xs font-bold uppercase tracking-wider text-neutral-600">{{ __('Grant Instant Access Token') }}</span>
                        </label>
                    </div>
                </div>

                <div class="pt-5 border-t border-neutral-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.enrollments.index') }}" class="px-4 py-2.5 rounded-xl border border-neutral-200 font-bold text-xs text-neutral-500 hover:bg-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow transition-colors cursor-pointer">
                        {{ __('Commit System Record') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-instructor-app-layout>
