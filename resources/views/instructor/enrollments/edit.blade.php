<x-instructor-app-layout>
    <x-slot name="header">
        <div class="bg-neutral-900 p-6 rounded-xl border border-neutral-950 shadow-md">
            <h2 class="font-extrabold text-2xl tracking-tight text-white">
                {{ __('Modify Admissions Entry') }}
            </h2>
            <p class="text-sm text-neutral-400 mt-0.5">
                {{ __('Adjust active status logs, credit updates, or systemic enrollment tracking restrictions.') }}
            </p>
        </div>
    </x-slot>

    <div class="bg-white min-h-screen p-6">
        <div class="max-w-3xl mx-auto">
            <form action="{{ route('admin.enrollments.update', $enrollment->id) }}" method="POST" class="p-8 rounded-2xl border border-neutral-200 shadow-sm space-y-6 bg-white">
                @csrf
                @method('PUT')

                @if($errors->any())
                    <div class="p-4 rounded-xl bg-rose-50 border border-rose-100 text-rose-700 text-xs font-bold space-y-1">
                        @foreach($errors->all() as $error)
                            <div class="flex items-center gap-2">⚠️ {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-400 mb-2">{{ __('Assigned Student (Locked)') }}</label>
                        <div class="w-full rounded-xl border border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-400 cursor-not-allowed">
                            {{ $enrollment->user->name ?? __('Unknown Profile') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-400 mb-2">{{ __('Target Course Matrix (Locked)') }}</label>
                        <div class="w-full rounded-xl border border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-400 cursor-not-allowed">
                            {{ $enrollment->course->title ?? __('Unknown Course') }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Financial Value Paid ($)') }}</label>
                        <input type="number" step="0.01" name="amount_paid" value="{{ old('amount_paid', $enrollment->amount_paid) }}" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('Payment System Index Key') }}</label>
                        <input type="number" name="payment_id" value="{{ old('payment_id', $enrollment->payment_id) }}" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-[10px] font-extrabold uppercase tracking-wider text-neutral-500 mb-2">{{ __('LMS Course Access Status') }}</label>
                        <select name="status" class="w-full rounded-xl border-neutral-200 bg-neutral-50 text-sm font-semibold p-3 text-neutral-800 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition-all">
                            <option value="active" {{ old('status', $enrollment->status) === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="completed" {{ old('status', $enrollment->status) === 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="suspended" {{ old('status', $enrollment->status) === 'suspended' ? 'selected' : '' }}>Suspended</option>
                        </select>
                    </div>

                    <div class="flex items-center pt-6">
                        <label class="relative inline-flex items-center cursor-pointer select-none">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $enrollment->is_active) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-neutral-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-neutral-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            <span class="ms-3 text-xs font-bold uppercase tracking-wider text-neutral-600">{{ __('Maintain Active Token') }}</span>
                        </label>
                    </div>
                </div>

                <div class="pt-5 border-t border-neutral-100 flex items-center justify-end gap-3">
                    <a href="{{ route('admin.enrollments.index') }}" class="px-4 py-2.5 rounded-xl border border-neutral-200 font-bold text-xs text-neutral-500 hover:bg-neutral-50 transition-colors">
                        {{ __('Cancel') }}
                    </a>
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white font-bold text-xs shadow transition-colors cursor-pointer">
                        {{ __('Update Track Records') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-app-layout>
