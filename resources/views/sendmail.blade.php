<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Mail Sending
        </h2>
    </x-slot>

    <div class="max-w-5xl mx-auto p-6">

        @if ($errors->any())
            <div style="color:red">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <p style="color:green">{{ session('success') }}</p>
        @endif
        @if(session('error'))
            <p style="color:red">{{ session('error') }}</p>
        @endif


        {{-- Form Card --}}
        <div class="bg-white shadow-md rounded-2xl p-6 mb-8">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Send Mail</h3>

            <form action="/sendmail" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-600">Email</label>
                    <input type="email" name="email" required
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Subject</label>
                    <input type="text" name="subject"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-600">Body</label>
                    <textarea name="body" rows="4"
                        class="w-full mt-1 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">Attachment (optional):</label>
                    <input type="file" name="attachment"><br><br>
                </div>

                <button type="submit"
                    class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 transition">
                    Send Mail
                </button>
            </form>
        </div>

        {{-- Mail History --}}
        <div class="bg-white shadow-md rounded-2xl p-6">
            <h3 class="text-lg font-semibold mb-4 text-gray-700">Mail History</h3>

            <div class="overflow-x-auto">
                <table class="w-full border border-gray-200 rounded-lg overflow-hidden">
                    <thead class="bg-gray-100 text-gray-700 text-sm">
                        <tr>
                            <th class="p-3 text-left">Recipient</th>
                            <th class="p-3 text-left">Subject</th>
                            <th class="p-3 text-left">Body</th>
                            <th class="p-3 text-left">Status</th>
                            <th class="p-3 text-left">Error</th>
                            <th class="p-3 text-left">Sent At</th>
                        </tr>
                    </thead>

                    <tbody class="text-sm text-gray-600">
                        @foreach($history as $mail)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-3">{{ $mail->recipient }}</td>
                            <td class="p-3">{{ $mail->subject }}</td>
                            <td class="p-3">{{ $mail->body }}</td>

                            <td class="p-3">
                                @if($mail->status === 'success')
                                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                        Success
                                    </span>
                                @else
                                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                        Failed
                                    </span>
                                @endif
                            </td>

                            <td class="p-3 text-red-500">
                                {{ $mail->error_message }}
                            </td>

                            <td class="p-3">
                                {{ $mail->created_at }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>