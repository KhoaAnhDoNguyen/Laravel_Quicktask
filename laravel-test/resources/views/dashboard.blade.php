<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <a href="{{ route('customers.create') }}" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            {{ __('Add Customer') }}
        </a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Customer List') }}
                    </h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-700">
                                    {{ __('ID') }}
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-700">
                                    {{ __('Username') }}
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-700">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200">
                            @foreach ($customers as $customer)
                                <tr>
                                    <td class="px-6 py-4">
                                        {{ $customer->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $customer->username }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('customers.edit', $customer->id) }}" class="text-blue-600 hover:text-blue-900">
                                            {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 ml-4">
                                                {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
