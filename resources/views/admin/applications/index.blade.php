@extends('admin.layouts.app')

@section('title', 'Adoption Applications - PawPal Admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-serif font-bold text-foreground">Adoption Applications</h1>
            <p class="text-muted-foreground mt-1">Review and manage adoption applications</p>
        </div>
        <div class="flex space-x-2">
            <button onclick="exportApplications()" class="btn-secondary">
                <i data-lucide="download" class="h-4 w-4"></i>
                Export
            </button>
            <select onchange="bulkAction()" class="input">
                <option value="">Bulk Actions</option>
                <option value="approve">Approve Selected</option>
                <option value="reject">Reject Selected</option>
                <option value="pending">Mark as Pending</option>
            </select>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-card rounded-lg border border-border p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Search</label>
                <input type="text" placeholder="Search by name, email..." class="input w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Status</label>
                <select class="input w-full">
                    <option value="">All Status</option>
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                    <option value="in_review">In Review</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Pet</label>
                <select class="input w-full">
                    <option value="">All Pets</option>
                    <option value="max">Max</option>
                    <option value="bella">Bella</option>
                    <option value="charlie">Charlie</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Date Range</label>
                <select class="input w-full">
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Total Applications</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['total'] ?? 128 }}</p>
                </div>
                <div class="h-12 w-12 bg-primary/10 rounded-lg flex items-center justify-center">
                    <i data-lucide="file-text" class="h-6 w-6 text-primary"></i>
                </div>
            </div>
        </div>
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Pending Review</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['pending'] ?? 23 }}</p>
                </div>
                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="clock" class="h-6 w-6 text-yellow-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">Approved</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['approved'] ?? 89 }}</p>
                </div>
                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="check-circle" class="h-6 w-6 text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-card rounded-lg border border-border p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-muted-foreground">This Month</p>
                    <p class="text-2xl font-bold text-foreground">{{ $stats['this_month'] ?? 16 }}</p>
                </div>
                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="calendar" class="h-6 w-6 text-blue-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-card rounded-lg border border-border overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted border-b border-border">
                    <tr>
                        <th class="text-left py-3 px-6">
                            <input type="checkbox" class="rounded border-border text-primary focus:ring-primary" onchange="toggleSelectAll()">
                        </th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Applicant</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Pet</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Date Applied</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Status</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Score</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($applications ?? [] as $application)
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="py-4 px-6">
                            <input type="checkbox" class="application-checkbox rounded border-border text-primary focus:ring-primary" value="{{ $application->id ?? 1 }}">
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-primary font-medium">{{ substr($application->applicant_name ?? 'John Doe', 0, 2) }}</span>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">{{ $application->applicant_name ?? 'John Doe' }}</p>
                                    <p class="text-sm text-muted-foreground">{{ $application->applicant_email ?? 'john@example.com' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('images/golden-retriever-puppy-happy-face.png') }}" alt="Pet" class="h-10 w-10 rounded-full object-cover">
                                <div>
                                    <p class="font-medium text-foreground">{{ $application->pet_name ?? 'Max' }}</p>
                                    <p class="text-sm text-muted-foreground">{{ $application->pet_breed ?? 'Golden Retriever' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-foreground">{{ $application->created_at ?? '2024-03-15' }}</p>
                            <p class="text-sm text-muted-foreground">{{ $application->time_ago ?? '2 days ago' }}</p>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $status = $application->status ?? 'pending';
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'approved' => 'bg-green-100 text-green-800',
                                    'rejected' => 'bg-red-100 text-red-800',
                                    'in_review' => 'bg-blue-100 text-blue-800'
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            @php
                                $score = $application->compatibility_score ?? rand(65, 95);
                                $scoreColor = $score >= 80 ? 'text-green-600' : ($score >= 60 ? 'text-yellow-600' : 'text-red-600');
                            @endphp
                            <span class="font-medium {{ $scoreColor }}">{{ $score }}%</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewApplication({{ $application->id ?? 1 }})" class="btn-secondary btn-sm">
                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                </button>
                                <button onclick="updateStatus({{ $application->id ?? 1 }}, 'approved')" class="btn-success btn-sm">
                                    <i data-lucide="check" class="h-4 w-4"></i>
                                </button>
                                <button onclick="updateStatus({{ $application->id ?? 1 }}, 'rejected')" class="btn-destructive btn-sm">
                                    <i data-lucide="x" class="h-4 w-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <!-- Sample Data -->
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="py-4 px-6">
                            <input type="checkbox" class="application-checkbox rounded border-border text-primary focus:ring-primary" value="1">
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center">
                                    <span class="text-primary font-medium">JD</span>
                                </div>
                                <div>
                                    <p class="font-medium text-foreground">John Doe</p>
                                    <p class="text-sm text-muted-foreground">john@example.com</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <img src="{{ asset('images/golden-retriever-puppy-happy-face.png') }}" alt="Pet" class="h-10 w-10 rounded-full object-cover">
                                <div>
                                    <p class="font-medium text-foreground">Max</p>
                                    <p class="text-sm text-muted-foreground">Golden Retriever</p>
                                </div>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <p class="text-foreground">Mar 15, 2024</p>
                            <p class="text-sm text-muted-foreground">2 days ago</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                Pending
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="font-medium text-green-600">85%</span>
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <button onclick="viewApplication(1)" class="btn-secondary btn-sm">
                                    <i data-lucide="eye" class="h-4 w-4"></i>
                                </button>
                                <button onclick="updateStatus(1, 'approved')" class="btn-success btn-sm">
                                    <i data-lucide="check" class="h-4 w-4"></i>
                                </button>
                                <button onclick="updateStatus(1, 'rejected')" class="btn-destructive btn-sm">
                                    <i data-lucide="x" class="h-4 w-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Application Detail Modal -->
<div id="applicationModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50" onclick="closeApplicationModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-card rounded-lg shadow-xl w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-border">
                <h2 class="text-xl font-serif font-bold text-foreground">Application Details</h2>
            </div>
            
            <div class="p-6 space-y-6">
                <!-- Application details will be loaded here -->
                <div class="text-center py-12">
                    <i data-lucide="file-text" class="h-16 w-16 text-muted-foreground/50 mx-auto mb-4"></i>
                    <p class="text-muted-foreground">Select an application to view details</p>
                </div>
            </div>
            
            <div class="p-6 border-t border-border flex justify-end space-x-3">
                <button onclick="closeApplicationModal()" class="btn-secondary">Close</button>
                <button class="btn-success">Approve</button>
                <button class="btn-destructive">Reject</button>
            </div>
        </div>
    </div>
</div>

<script>
function viewApplication(id) {
    document.getElementById('applicationModal').classList.remove('hidden');
    // In a real implementation, you would fetch application details via AJAX
}

function closeApplicationModal() {
    document.getElementById('applicationModal').classList.add('hidden');
}

function updateStatus(id, status) {
    if (confirm(`Are you sure you want to ${status} this application?`)) {
        fetch(`/admin/applications/${id}/update-status`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ status: status })
        }).then(() => location.reload());
    }
}

function toggleSelectAll() {
    const checkboxes = document.querySelectorAll('.application-checkbox');
    const selectAll = event.target.checked;
    checkboxes.forEach(checkbox => checkbox.checked = selectAll);
}

function bulkAction() {
    const action = event.target.value;
    if (!action) return;
    
    const selected = Array.from(document.querySelectorAll('.application-checkbox:checked')).map(cb => cb.value);
    if (selected.length === 0) {
        alert('Please select at least one application');
        return;
    }
    
    if (confirm(`Are you sure you want to ${action} ${selected.length} applications?`)) {
        fetch('/admin/applications/bulk-action', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ action: action, applications: selected })
        }).then(() => location.reload());
    }
    
    event.target.value = '';
}

function exportApplications() {
    window.open('/admin/applications/export', '_blank');
}

// Initialize Lucide icons
lucide.createIcons();
</script>

<style>
.btn-success {
    @apply inline-flex items-center justify-center rounded-md text-sm font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-green-600 text-white hover:bg-green-700 h-9 px-3;
}

.btn-success.btn-sm {
    @apply h-8 px-2;
}
</style>
@endsection