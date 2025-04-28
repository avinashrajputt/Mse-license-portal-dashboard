@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    {{-- Dashboard Header --}}
    <div class="bg-white dark:bg-gray-800 shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <img class="h-8 w-8" src="{{ asset('images/license_portal.webp') }}" alt="Workflow">
                    </div>
                    <div class="ml-4 text-xl font-bold text-gray-900 dark:text-white">
                        MSE License Portal
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="{{ route('licenses.index') }}" 
                       class="text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        Dashboard
                    </a>
                    <a href="{{ route('license.search') }}" 
                       class="bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium hover:bg-indigo-700">
                        License Search
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="py-12">
        <div class="max-w-xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- Search Card --}}
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl p-6">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white">License Verification</h2>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Enter your license number to view details</p>
                </div>
                
                <form action="{{ route('license.search.result') }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="license_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            License Number
                        </label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <input type="text" 
                                   name="license_number" 
                                   id="license_number"
                                   required
                                   class="px-3 py-2 block w-full pr-10 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                   placeholder="Enter your license number">
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Search License
                    </button>
                </form>
            </div>

            {{-- Search Results --}}
            @if(isset($license))
            <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-xl overflow-hidden">
                <div class="px-4 py-5 border-b border-gray-200 dark:border-gray-700 sm:px-6">
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">License Details</h3>
                </div>
                <div class="px-4 py-5 sm:p-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6">
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Business Name</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $license->business_name }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">License Number</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $license->license_number }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                    {{ $license->status === 'Active' ? 'bg-green-100 text-green-800' : 
                                       ($license->status === 'Expired' ? 'bg-red-100 text-red-800' : 
                                       'bg-yellow-100 text-yellow-800') }}">
                                    {{ $license->status }}
                                </span>
                            </dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Issue Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $license->issue_date }}</dd>
                        </div>
                        <div class="sm:col-span-1">
                            <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Expiry Date</dt>
                            <dd class="mt-1 text-sm text-gray-900 dark:text-white">{{ $license->expiry_date }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
            @endif

            {{-- Error Message --}}
            @if(session('error'))
            <div class="mt-4 rounded-md bg-red-50 dark:bg-red-900 p-4">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection