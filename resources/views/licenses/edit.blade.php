@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900 py-8">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
            {{-- Header Section --}}
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Edit License</h1>
                <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Update the license information below</p>
            </div>

            <form action="{{ route('licenses.update', $license->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Business Name --}}
                    <div>
                        <label for="business_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Business Name
                        </label>
                        <input type="text" name="business_name" id="business_name" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->business_name }}" 
                            required>
                    </div>

                    {{-- License Number --}}
                    <div>
                        <label for="license_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            License Number
                        </label>
                        <input type="text" name="license_number" id="license_number" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->license_number }}" 
                            required>
                    </div>

                    {{-- Issue Date --}}
                    <div>
                        <label for="issue_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Issue Date
                        </label>
                        <input type="date" name="issue_date" id="issue_date" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->issue_date }}" 
                            required>
                    </div>

                    {{-- Expiry Date --}}
                    <div>
                        <label for="expiry_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Expiry Date
                        </label>
                        <input type="date" name="expiry_date" id="expiry_date" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->expiry_date }}" 
                            required>
                    </div>

                    {{-- Owner Name --}}
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Owner Name
                        </label>
                        <input type="text" name="owner_name" id="owner_name" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->owner_name }}" 
                            required>
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Email Address
                        </label>
                        <input type="email" name="email" id="email" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->email }}">
                    </div>

                    {{-- Phone --}}
                    <div class="md:col-span-2">
                        <label for="phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                            Phone Number
                        </label>
                        <input type="text" name="phone" id="phone" 
                            class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 px-3 py-2 text-sm " 
                            value="{{ $license->phone }}">
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('licenses.index') }}" 
                        class="inline-flex justify-center rounded-md border border-gray-300 dark:border-gray-600 py-2 px-4 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Cancel
                    </a>
                    <button type="submit" 
                        class="inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Update License
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (session('success'))
<script>
    Swal.fire({
        title: 'Success!',
        text: "{{ session('success') }}",
        icon: 'success',
        confirmButtonText: 'OK',
        customClass: {
            confirmButton: 'btn btn-primary'
        }
    });
</script>
@endif
@endsection