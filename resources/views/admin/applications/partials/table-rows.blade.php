@forelse($applications as $application)
<tr class="hover:bg-gray-50 transition-colors">
    <td class="py-4 px-6">
        <input type="checkbox" class="application-checkbox rounded border-gray-300 text-purple-600 focus:ring-purple-500" value="{{ $application->id }}">
    </td>
    <td class="py-4 px-6">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 bg-purple-100 rounded-full flex items-center justify-center">
                <span class="text-purple-700 font-semibold text-sm">{{ strtoupper(substr($application->first_name ?? 'U', 0, 1) . substr($application->last_name ?? 'N', 0, 1)) }}</span>
            </div>
            <div>
                <p class="font-medium text-gray-900">{{ $application->first_name }} {{ $application->last_name }}</p>
                <p class="text-sm text-gray-500">{{ $application->email }}</p>
            </div>
        </div>
    </td>
    <td class="py-4 px-6">
        <div class="flex items-center space-x-3">
            @if($application->pet)
            <img src="{{ $application->pet->image_url }}" alt="{{ $application->pet->name }}" class="h-10 w-10 rounded-lg object-cover">
            @else
            <div class="h-10 w-10 bg-gray-100 rounded-lg flex items-center justify-center">
                <i data-lucide="image" class="h-5 w-5 text-gray-400"></i>
            </div>
            @endif
            <div>
                @if($application->pet)
                    <p class="font-medium text-gray-900">{{ $application->pet->name }}</p>
                    <p class="text-sm text-gray-500">{{ ucfirst($application->pet->type) }}</p>
                @else
                    <p class="font-medium text-gray-900">Unknown Pet</p>
                    <p class="text-sm text-gray-500">No pet linked</p>
                @endif
            </div>
        </div>
    </td>
    <td class="py-4 px-6">
        <p class="text-gray-900">{{ $application->created_at->format('M d, Y') }}</p>
        <p class="text-sm text-gray-500">{{ $application->created_at->diffForHumans() }}</p>
    </td>
    <td class="py-4 px-6">
        @php
            $status = $application->status;
            $statusConfig = [
                'pending' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-800', 'label' => 'Pending'],
                'approved' => ['bg' => 'bg-green-100', 'text' => 'text-green-800', 'label' => 'Approved'],
                'rejected' => ['bg' => 'bg-red-100', 'text' => 'text-red-800', 'label' => 'Rejected']
            ];
            $config = $statusConfig[$status] ?? ['bg' => 'bg-gray-100', 'text' => 'text-gray-800', 'label' => ucfirst($status)];
        @endphp
        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $config['bg'] }} {{ $config['text'] }}">
            {{ $config['label'] }}
        </span>
    </td>
    <td class="py-4 px-6">
        <div class="flex items-center space-x-2">
            <button onclick="viewApplication({{ $application->id }})" class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors" title="View Details">
                <i data-lucide="eye" class="h-5 w-5"></i>
            </button>
            <button onclick="updateStatus({{ $application->id }}, 'approved')" class="p-2 text-white bg-green-500 hover:bg-green-600 rounded-lg transition-colors" title="Approve">
                <i data-lucide="check" class="h-5 w-5"></i>
            </button>
            <button onclick="updateStatus({{ $application->id }}, 'rejected')" class="p-2 text-white bg-red-500 hover:bg-red-600 rounded-lg transition-colors" title="Reject">
                <i data-lucide="x" class="h-5 w-5"></i>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="py-12 text-center">
        <div class="flex flex-col items-center space-y-4">
            <i data-lucide="inbox" class="h-16 w-16 text-gray-300"></i>
            <div>
                <p class="text-lg font-medium text-gray-900">No Applications Found</p>
                <p class="text-sm text-gray-500">No adoption applications match your current filters.</p>
            </div>
        </div>
    </td>
</tr>
@endforelse