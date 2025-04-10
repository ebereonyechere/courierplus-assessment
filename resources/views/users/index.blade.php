@extends('layouts.app')

@section('title', 'Users')

@section('content')
    <div>
        <table class="w-1/2 mx-auto">
            <tr class="flex justify-between mb-4 bg-gray-900 text-white font-semibold text-lg p-5 rounded-sm">
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            @foreach ($users as $user)
                <tr class="flex justify-between">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->approved_at)
                            <span class="bg-green-700 text-white py-1 px-3 rounded-lg">Approved</span>
                        @else
                            <span class="bg-orange-700 text-white py-1 px-3 rounded-sm">Pending</span>
                        @endif
                    </td>
                    <td>
                        @if ($user->approved_at)
                            <form method="POST" action="{{ route('users.ban', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" class="text-red-500 cursor-pointer hover:underline">Ban?</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('users.approve', $user->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="text-green-500 cursor-pointer hover:underline">Approve?</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
