@forelse($applications as $application)
<tr class="hover:bg-muted/50 transition-colors">
    <td class="py-4 px-6">
        <input type="checkbox" class="application-checkbox rounded border-border text-primary focus:ring-primary" value="{{ $application->id }}">
    </td>
    <td class="py-4 px-6">
        <div class="flex items-center space-x-3">
            <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center">
                <span class="text-primary font-medium">{{ substr($application->first_name, 0, 1) }}{{ substr($application->last_name, 0, 1) }}</span>
            </div>
            <div>
                <p class="font-medium text-foreground">{{ $application->first_name }} {{ $application->last_name }}</p>
                <p class="text-sm text-muted-foreground">{{ $application->email }}</p>
            </div>
        </div>
    </td>
    <td class="py-4 px-6">
        <div class="flex items-center space-x-3">
            @if($application->pet)
            <img src="{{ $application->pet->image_url }}" alt="{{ $application->pet->name }}" class="h-10 w-10 rounded-full object-cover">
            @else
            <div class="h-10 w-10 bg-muted rounded-full flex items-center justify-center">
                <i data-lucide="paw-print" class="h-5 w-5 text-muted-foreground"></i>
            </div>
            @endif
            <div>
                @if($application->pet)
                    <p class="font-medium text-foreground">{{ $application->pet->name }}</p>
                    <p class="text-sm text-muted-foreground">{{ $application->pet->breed ?: 'Unknown Breed' }}</p>
                @else
                    <p class="font-medium text-foreground">Unknown Pet</p>
                    <p class="text-sm text-muted-foreground">No pet linked</p>
                @endif
            </div>
        </div>
    </td>
    <td class="py-4 px-6">
        <p class="text-foreground">{{ $application->created_at->format('M d, Y') }}</p>
        <p class="text-sm text-muted-foreground">{{ $application->created_at->diffForHumans() }}</p>
    </td>
    <td class="py-4 px-6">
        @php
            $status = $application->status;
            $statusColors = [
                'pending' => 'bg-yellow-100 text-yellow-800',
                'approved' => 'bg-green-100 text-green-800',
                'rejected' => 'bg-red-100 text-red-800'
            ];
        @endphp
        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
            {{ ucfirst(str_replace('_', ' ', $status)) }}
        </span>
    </td>
    <td class="py-4 px-6">
        <div class="flex items-center space-x-2">
            <button onclick="viewApplication({{ $application->id }})" class="btn-secondary btn-sm">
                <i data-lucide="eye" class="h-4 w-4"></i>
            </button>
            <button onclick="updateStatus({{ $application->id }}, 'approved')" class="btn-success btn-sm">
                <i data-lucide="check" class="h-4 w-4"></i>
            </button>
            <button onclick="updateStatus({{ $application->id ?? 1 }}, 'rejected')" class="btn-destructive btn-sm">
                <i data-lucide="x" class="h-4 w-4"></i>
            </button>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="6" class="py-12 text-center">
        <div class="flex flex-col items-center space-y-4">
            <i data-lucide="search-x" class="h-12 w-12 text-muted-foreground/50"></i>
            <div>
                <p class="text-lg font-medium text-foreground">No Applications Found</p>
                <p class="text-sm text-muted-foreground">No adoption applications match your current filters.</p>
            </div>
        </div>
    </td>
</tr>
@endforelse