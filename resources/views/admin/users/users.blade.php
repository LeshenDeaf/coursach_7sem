@extends("layouts.app")

@section('title', 'List of users')

@section("content")
    <a href="{{ route('admin.users.create') }}" class="float-right px-8 py-3 bg-blue-500 text-white rounded-xl shadow-lg hover:bg-blue-700 duration-100 transition-all">
        Create
    </a>

    @include("partials.header_text", ['text' => "List of users"])


    @include("partials.alerts.alert")


    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                ID
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created at
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Roles
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Addresses
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Delete</span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-900">
                                        {{ $user->id }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="font-medium text-gray-900" title="{{ $user->name }}">
                                        {{ mb_strimwidth($user->name, 0, 20, '...') }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-gray-900">
                                    {{ $user->email }}
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-gray-500" title="{{ $user->created_at }}">
                                {{ date('d.m.Y', strtotime($user->created_at)) }}
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                @foreach($user->roles as $role)
                                    <div class="text-gray-900">
                                        <span class="text-gray-600">{{ $role->id }}</span> - {{ $role->name }}
                                    </div>
                                @endforeach
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-gray-500">
                                @foreach($user->addresses as $address)
                                    <div class="text-gray-900">
                                        <span class="text-gray-600">{{ $address->id }}</span> - {{ $address->address }}
                                    </div>
                                @endforeach
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                <a href="{{ route('admin.users.show', $user->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                            </td>
                            <td>
                                <form method="post" action="{{ route("admin.users.destroy", $user->id) }}" >
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-500">{{ __('Delete') }}</button>
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
@endsection
