@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div class="w-1/2 mx-auto bg-gray-100 rounded p-6">

        <h1 class="text-3xl font-bold text-center mb-5 text-gray-900">
            All Tenants
        </h1>


        <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left">
                <thead class="text-xs text-white uppercase bg-gray-900">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Name
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="bg-gray-50 border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $user->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $user->email }}
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->approved_at)
                                    <span class="bg-green-700 text-white py-1 px-3 rounded-lg">Approved</span>
                                @else
                                    <span class="bg-orange-700 text-white py-1 px-3 rounded-sm">Pending</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($user->approved_at)
                                    <form method="POST" action="{{ route('users.ban', $user->id) }}"
                                        onsubmit="return confirm('Do you really want to ban the user?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="text-red-500 cursor-pointer hover:underline">Ban?</button>
                                    </form>
                                @else
                                    <form method="POST" action="{{ route('users.approve', $user->id) }}"
                                        onsubmit="return confirm('Do you really want to approve the user?');">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit"
                                            class="text-green-500 cursor-pointer hover:underline">Approve?</button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection
