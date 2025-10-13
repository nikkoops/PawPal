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
            <button onclick="exportApplications()" class="btn-secondary" style="display: flex !important; align-items: center !important; justify-content: center !important; gap: 8px !important; transition: all 0.3s ease !important;" onmouseover="this.style.color='#9334e9'" onmouseout="this.style.color=''">
                <i data-lucide="download" style="width: 16px !important; height: 16px !important; flex-shrink: 0 !important; transition: color 0.3s ease !important;"></i>
                <span style="transition: color 0.3s ease !important;">Export</span>
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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Status</label>
                <select id="statusFilter" class="input w-full" onchange="filterApplications()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Pet Type</label>
                <select id="petTypeFilter" class="input w-full" onchange="filterApplications()">
                    <option value="">All Pets</option>
                    <option value="cat" {{ request('pet_type') == 'cat' ? 'selected' : '' }}>Cats</option>
                    <option value="dog" {{ request('pet_type') == 'dog' ? 'selected' : '' }}>Dogs</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-foreground mb-2">Date Range</label>
                <select id="dateRangeFilter" class="input w-full" onchange="filterApplications()">
                    <option value="">All Time</option>
                    <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
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
                    <p class="text-2xl font-bold text-foreground" id="totalCount">{{ $stats['total'] }}</p>
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
                    <p class="text-2xl font-bold text-foreground" id="pendingCount">{{ $stats['pending'] }}</p>
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
                    <p class="text-2xl font-bold text-foreground" id="approvedCount">{{ $stats['approved'] }}</p>
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
                    <p class="text-2xl font-bold text-foreground" id="thisMonthCount">{{ $stats['this_month'] }}</p>
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
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border" id="applicationsTableBody">
                    @include('admin.applications.partials.table-rows', compact('applications'))
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
    
    // Show loading state
    const modalContent = document.querySelector('#applicationModal .p-6.space-y-6');
    modalContent.innerHTML = `
        <div class="text-center py-12">
            <div class="animate-spin h-8 w-8 border-4 border-primary border-t-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-muted-foreground">Loading application details...</p>
        </div>
    `;
    
    // Set up the buttons for this application
    const approveBtn = document.querySelector('#applicationModal .btn-success');
    const rejectBtn = document.querySelector('#applicationModal .btn-destructive');
    
    approveBtn.onclick = () => updateStatus(id, 'approved');
    rejectBtn.onclick = () => updateStatus(id, 'rejected');
    
    // Fetch application details via AJAX
    fetch(`/admin/applications/${id}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Render application details
            renderApplicationDetails(data, modalContent);
        })
        .catch(error => {
            console.error('Error fetching application details:', error);
            modalContent.innerHTML = `
                <div class="text-center py-12 text-red-500">
                    <i data-lucide="alert-triangle" class="h-16 w-16 mx-auto mb-4"></i>
                    <p>Error loading application details. Please try again.</p>
                </div>
            `;
            // Initialize icons
            if (window.lucide) {
                lucide.createIcons();
            }
        });
}

function renderApplicationDetails(data, container) {
    // Create HTML for application details
    const html = `
        <div class="space-y-8">
            <!-- Applicant Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i data-lucide="user" class="h-5 w-5 mr-2 text-primary"></i>
                    Applicant Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-2">
                        <p class="text-sm text-muted-foreground">Name</p>
                        <p class="font-medium">${data.applicant.name}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-muted-foreground">Email</p>
                        <p class="font-medium">${data.applicant.email}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-muted-foreground">Phone</p>
                        <p class="font-medium">${data.applicant.phone}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-muted-foreground">Date of Birth</p>
                        <p class="font-medium">${data.applicant.birth_date || 'Not provided'}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-muted-foreground">Occupation</p>
                        <p class="font-medium">${data.applicant.occupation || 'Not provided'}</p>
                    </div>
                    <div class="space-y-2">
                        <p class="text-sm text-muted-foreground">Address</p>
                        <p class="font-medium">${data.applicant.address || 'Not provided'}</p>
                    </div>
                </div>
            </div>
            
            <!-- Pet Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i data-lucide="paw-print" class="h-5 w-5 mr-2 text-primary"></i>
                    Pet Information
                </h3>
                <div class="flex items-center space-x-4">
                    ${data.pet ? `
                        <img src="${data.pet.image || '/images/pet-placeholder.png'}" 
                             alt="${data.pet.name}" 
                             class="h-16 w-16 rounded-full object-cover">
                        <div>
                            <p class="font-medium text-lg">${data.pet.name}</p>
                            <p class="text-muted-foreground">${data.pet.breed}</p>
                            <p class="text-xs text-gray-400">Pet ID: ${data.pet.id}</p>
                        </div>
                    ` : `
                        <div>
                            <p class="text-muted-foreground">No pet selected for this application</p>
                            ${data.application && data.application.pet_id ? 
                              `<p class="text-xs text-red-400">Broken link: Pet ID ${data.application.pet_id} exists but can't be found</p>` : 
                              ''}
                        </div>
                    `}
                </div>
            </div>
            
            <!-- Form Answers Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i data-lucide="clipboard-list" class="h-5 w-5 mr-2 text-primary"></i>
                    Application Answers
                </h3>
                <div class="space-y-6">
                    ${renderFormAnswers(data.answers)}
                </div>
            </div>
            
            <!-- Admin Notes Section -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i data-lucide="clipboard" class="h-5 w-5 mr-2 text-primary"></i>
                    Admin Notes
                </h3>
                <textarea 
                    id="admin-notes" 
                    class="w-full input min-h-[100px]" 
                    placeholder="Add notes about this application..."
                >${data.application.admin_notes || ''}</textarea>
                <button onclick="saveAdminNotes(${data.id})" class="btn-secondary btn-sm">
                    Save Notes
                </button>
            </div>
            
            <!-- Application Status Section -->
            <div class="border-t border-border pt-4">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-muted-foreground">Application Status</p>
                        <p class="font-medium">${getStatusBadge(data.application.status)}</p>
                    </div>
                    <div>
                        <p class="text-sm text-muted-foreground">Date Applied</p>
                        <p class="font-medium">${data.application.created_at}</p>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Update the container with the HTML
    container.innerHTML = html;
    
    // Initialize icons
    if (window.lucide) {
        lucide.createIcons();
    }
}

function renderFormAnswers(answers) {
    if (!answers || Object.keys(answers).length === 0) {
        return '<p class="text-muted-foreground">No form answers provided</p>';
    }
    
    // Filter out some keys we don't want to display
    const excludedKeys = ['_token', 'pet_name'];
    
    let html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-6">';
    
    // Format and display each answer
    for (const [key, value] of Object.entries(answers)) {
        if (excludedKeys.includes(key)) continue;
        
        const formattedKey = key
            .replace(/([A-Z])/g, ' $1') // Add spaces before capital letters
            .replace(/^./, (str) => str.toUpperCase()) // Capitalize first letter
            .replace(/([a-z])(\d)/g, '$1 $2'); // Add space between letter and number
        
        let formattedValue = value;
        // Format value based on type
        if (typeof value === 'boolean') {
            formattedValue = value ? 'Yes' : 'No';
        } else if (value === 'yes' || value === 'no') {
            formattedValue = value.charAt(0).toUpperCase() + value.slice(1);
        } else if (value === null || value === '') {
            formattedValue = 'Not provided';
        } else if (typeof value === 'object') {
            formattedValue = JSON.stringify(value);
        }
        
        html += `
            <div class="space-y-1">
                <p class="text-sm text-muted-foreground">${formattedKey}</p>
                <p class="font-medium">${formattedValue}</p>
            </div>
        `;
    }
    
    html += '</div>';
    return html;
}

function getStatusBadge(status) {
    const statusColors = {
        'pending': 'bg-yellow-100 text-yellow-800',
        'approved': 'bg-green-100 text-green-800',
        'rejected': 'bg-red-100 text-red-800'
    };
    
    const formattedStatus = status.charAt(0).toUpperCase() + status.slice(1).replace('_', ' ');
    
    return `<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${statusColors[status] || 'bg-gray-100 text-gray-800'}">
        ${formattedStatus}
    </span>`;
}

function saveAdminNotes(applicationId) {
    const notes = document.getElementById('admin-notes').value;
    
    fetch(`/admin/applications/${applicationId}/update-status`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ 
            admin_notes: notes 
        })
    })
    .then(response => response.json())
    .then(data => {
        // Show success notification
        const notification = document.createElement('div');
        notification.className = 'fixed bottom-4 right-4 bg-green-100 text-green-800 px-4 py-2 rounded-md shadow-lg';
        notification.innerHTML = 'Notes saved successfully';
        document.body.appendChild(notification);
        
        // Remove notification after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    })
    .catch(error => {
        console.error('Error saving notes:', error);
        alert('Error saving notes. Please try again.');
    });
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

// Filter applications via AJAX
function filterApplications() {
    const status = document.getElementById('statusFilter').value;
    const petType = document.getElementById('petTypeFilter').value;
    const dateRange = document.getElementById('dateRangeFilter').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (status) params.append('status', status);
    if (petType) params.append('pet_type', petType);
    if (dateRange) params.append('date_range', dateRange);
    
    // Show loading state
    const tableBody = document.getElementById('applicationsTableBody');
    tableBody.innerHTML = `
        <tr>
            <td colspan="6" class="py-12 text-center">
                <div class="animate-spin h-8 w-8 border-4 border-primary border-t-transparent rounded-full mx-auto mb-4"></div>
                <p class="text-muted-foreground">Loading applications...</p>
            </td>
        </tr>
    `;
    
    // Fetch filtered applications
    fetch(`{{ route('admin.applications.filter') }}?${params.toString()}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Update table content
            tableBody.innerHTML = data.html;
            
            // Update statistics
            document.getElementById('totalCount').textContent = data.stats.total;
            document.getElementById('pendingCount').textContent = data.stats.pending;
            document.getElementById('approvedCount').textContent = data.stats.approved;
            document.getElementById('thisMonthCount').textContent = data.stats.this_month;
            
            // Reinitialize Lucide icons for new content
            if (window.lucide) {
                lucide.createIcons();
            }
        })
        .catch(error => {
            console.error('Error filtering applications:', error);
            tableBody.innerHTML = `
                <tr>
                    <td colspan="6" class="py-12 text-center text-red-500">
                        <i data-lucide="alert-triangle" class="h-12 w-12 mx-auto mb-4"></i>
                        <p class="text-lg font-medium">Error Loading Applications</p>
                        <p class="text-sm">Please refresh the page and try again.</p>
                    </td>
                </tr>
            `;
            // Reinitialize icons for error state
            if (window.lucide) {
                lucide.createIcons();
            }
        });
}

// Initialize Lucide icons
lucide.createIcons();
</script>

<style>
.btn-success {
    background: #22c55e !important;
    color: white !important;
    border: 1px solid #22c55e !important;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
}

.btn-success:hover {
    background: #16a34a !important;
    border-color: #16a34a !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(34, 197, 94, 0.3);
}

.btn-success.btn-sm {
    padding: 0.375rem 0.5rem;
    font-size: 0.875rem;
}

.btn-destructive {
    background: #ef4444 !important;
    color: white !important;
    border: 1px solid #ef4444 !important;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.25rem;
    transition: all 0.2s ease;
    cursor: pointer;
    text-decoration: none;
}

.btn-destructive:hover {
    background: #dc2626 !important;
    border-color: #dc2626 !important;
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(239, 68, 68, 0.3);
}

.btn-destructive.btn-sm {
    padding: 0.375rem 0.5rem;
    font-size: 0.875rem;
}
</style>
@endsection