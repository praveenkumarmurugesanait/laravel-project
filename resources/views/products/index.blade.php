<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-4">
        <div class="p-6">
            
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Products</h2>
            </div>

            @if($products->isEmpty())
                <div class="text-center py-10">
                    <p class="text-gray-500 text-lg">No products available</p>
                </div>
            @else
                <div class="w-full flex-col items-center border-2 border-black">
                    <h2 class="font-semibold text-3xl mb-8">Products</h2>
                    <table class="table-auto w-auto border-2 broder-black">   
                        <!-- Table Head -->
                        <thead class="bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-black">ID</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-black">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-black">Price</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-black">Description</th>
                                <th class="px-6 py-3 text-left text-sm font-semibold text-black">Updated</th>
                            </tr>
                        </thead>

                        <!-- Table Body -->
                        <tbody class="divide-y divide-gray-200">
                            @foreach($products as $product)
                                <tr class="hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4 text-sm text-gray-700 font-medium">
                                        {{ $product->id }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-800 font-semibold">
                                        {{ $product->name }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-green-600 font-bold">
                                        ₹{{ number_format($product->price, 2) }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-600 truncate max-w-xs">
                                        {{ $product->description }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $product->updated_at->format('d M Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>