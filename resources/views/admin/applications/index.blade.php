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
            <button onclick="exportApplications()" class="px-4 py-2 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-2">
                <i data-lucide="download" class="h-4 w-4"></i>
                <span>Export</span>
            </button>
            <select id="bulkActionSelect" class="px-4 py-2 bg-white border border-gray-300 rounded-lg" onchange="bulkAction()">
                <option value="">Bulk Actions</option>
                <option value="approve">Approve Selected</option>
                <option value="reject">Reject Selected</option>
                <option value="pending">Mark as Pending</option>
            </select>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-lg border border-gray-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                <select id="statusFilter" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg" onchange="filterApplications()">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Pet Type</label>
                <select id="petTypeFilter" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg" onchange="filterApplications()">
                    <option value="">All Pets</option>
                    <option value="cat" {{ request('pet_type') == 'cat' ? 'selected' : '' }}>Cats</option>
                    <option value="dog" {{ request('pet_type') == 'dog' ? 'selected' : '' }}>Dogs</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date Range</label>
                <select id="dateRangeFilter" class="w-full px-4 py-2 bg-white border border-gray-300 rounded-lg" onchange="filterApplications()">
                    <option value="">All Time</option>
                    <option value="today" {{ request('date_range') == 'today' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ request('date_range') == 'week' ? 'selected' : '' }}>This Week</option>
                    <option value="month" {{ request('date_range') == 'month' ? 'selected' : '' }}>This Month</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Applications</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="totalCount">{{ $stats['total'] }}</p>
                </div>
                <div class="h-12 w-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="file-text" class="h-6 w-6 text-orange-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Pending Review</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="pendingCount">{{ $stats['pending'] }}</p>
                </div>
                <div class="h-12 w-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="clock" class="h-6 w-6 text-yellow-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Approved</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="approvedCount">{{ $stats['approved'] }}</p>
                </div>
                <div class="h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="check-circle" class="h-6 w-6 text-green-600"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">This Month</p>
                    <p class="text-3xl font-bold text-gray-900 mt-2" id="thisMonthCount">{{ $stats['this_month'] }}</p>
                </div>
                <div class="h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i data-lucide="calendar" class="h-6 w-6 text-blue-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Applications Table -->
    <div class="bg-white rounded-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left py-3 px-6 w-12">
                            <input type="checkbox" id="selectAllCheckbox" class="rounded border-gray-300 text-orange-600 focus:ring-orange-500" onchange="toggleSelectAll()">
                        </th>
                        <th class="text-left py-3 px-6 text-sm font-medium text-gray-600">Applicant</th>
                        <th class="text-left py-3 px-6 text-sm font-medium text-gray-600">Pet</th>
                        <th class="text-left py-3 px-6 text-sm font-medium text-gray-600">Date Applied</th>
                        <th class="text-left py-3 px-6 text-sm font-medium text-gray-600">Status</th>
                        <th class="text-left py-3 px-6 text-sm font-medium text-gray-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200" id="applicationsTableBody">
                    @include('admin.applications.partials.table-rows', compact('applications'))
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Application Detail Modal -->
<div id="applicationModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/60 backdrop-blur-sm" onclick="closeApplicationModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
            <!-- Header with gradient -->
            <div class="bg-white border-b border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold flex items-center text-gray-900">
                            <i data-lucide="file-text" class="h-6 w-6 mr-3 text-orange-500"></i>
                            Application Details
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">Review and manage adoption application</p>
                    </div>
                    <button onclick="closeApplicationModal()" class="text-gray-500 hover:bg-gray-100 rounded-lg p-2 transition-colors">
                        <i data-lucide="x" class="h-6 w-6"></i>
                    </button>
                </div>
            </div>
            
            <!-- Content area with scroll -->
            <div class="flex-1 overflow-y-auto p-6 bg-gray-50">
                <!-- Application details will be loaded here -->
                <div class="text-center py-12">
                    <i data-lucide="file-text" class="h-16 w-16 text-gray-300 mx-auto mb-4"></i>
                    <p class="text-gray-500 text-lg">Select an application to view details</p>
                </div>
            </div>
            
            <!-- Footer with action buttons -->
            <div class="p-6 bg-white border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeApplicationModal()" class="px-6 py-2.5 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded-lg transition-colors">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function viewApplication(id) {
    document.getElementById('applicationModal').classList.remove('hidden');
    
    // Show loading state
    const modalContent = document.querySelector('#applicationModal .flex-1.overflow-y-auto');
    modalContent.innerHTML = `
        <div class="text-center py-16">
            <div class="animate-spin h-12 w-12 border-4 border-orange-500 border-t-transparent rounded-full mx-auto mb-4"></div>
            <p class="text-gray-600 text-lg font-medium">Loading application details...</p>
        </div>
    `;
    
    // Fetch application details via AJAX
    fetch(`/admin/shelter/applications/${id}/details`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            // Debug logging
            console.log('Application data received:', data);
            console.log('Documents:', data.documents);
            console.log('Home photos:', data.documents?.home_photos);
            
            // Render application details
            renderApplicationDetails(data, modalContent);
        })
        .catch(error => {
            console.error('Error fetching application details:', error);
            modalContent.innerHTML = `
                <div class="text-center py-16">
                    <div class="bg-red-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
                        <i data-lucide="alert-triangle" class="h-10 w-10 text-red-600"></i>
                    </div>
                    <p class="text-red-600 text-lg font-semibold mb-2">Error Loading Application</p>
                    <p class="text-gray-500">Please try again or contact support if the issue persists.</p>
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
        <div class="p-6 space-y-6">
            <!-- Applicant Section -->
            <div class="rounded-xl bg-gradient-to-br from-orange-50 to-orange-100/50 border border-orange-200 p-6 shadow-md">
                <h3 class="text-lg font-bold flex items-center mb-5 text-orange-700">
                    <i data-lucide="user" class="h-5 w-5 mr-2"></i>
                    Applicant Information
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-white/70 rounded-lg p-4 border border-orange-100">
                        <span class="block text-xs text-orange-600 font-semibold uppercase mb-2 tracking-wide">Name</span>
                        <span class="block text-base font-semibold text-gray-800">${data.applicant.name}</span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-4 border border-orange-100">
                        <span class="block text-xs text-orange-600 font-semibold uppercase mb-2 tracking-wide">Email</span>
                        <span class="block text-base font-medium text-gray-800">${data.applicant.email}</span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-4 border border-orange-100">
                        <span class="block text-xs text-orange-600 font-semibold uppercase mb-2 tracking-wide">Phone</span>
                        <span class="block text-base font-medium text-gray-800">${data.applicant.phone}</span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-4 border border-orange-100">
                        <span class="block text-xs text-orange-600 font-semibold uppercase mb-2 tracking-wide">Date of Birth</span>
                        <span class="block text-base font-medium text-gray-800">${data.applicant.birth_date || 'Not provided'}</span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-4 border border-orange-100">
                        <span class="block text-xs text-orange-600 font-semibold uppercase mb-2 tracking-wide">Occupation</span>
                        <span class="block text-base font-medium text-gray-800">${data.applicant.occupation || 'Not provided'}</span>
                    </div>
                    <div class="bg-white/70 rounded-lg p-4 border border-orange-100 md:col-span-2">
                        <span class="block text-xs text-orange-600 font-semibold uppercase mb-2 tracking-wide">Address</span>
                        <span class="block text-base font-medium text-gray-800">${data.applicant.address || 'Not provided'}</span>
                    </div>
                </div>
            </div>

            <!-- Pet Section -->
            <div class="rounded-xl bg-gradient-to-br from-blue-50 to-blue-100/50 border border-blue-200 p-6 shadow-md">
                <h3 class="text-lg font-bold flex items-center mb-5 text-blue-700">
                    <i data-lucide="paw-print" class="h-5 w-5 mr-2"></i>
                    Pet Information
                </h3>
                <div class="bg-white/70 rounded-lg p-5 border border-blue-100">
                    ${data.pet ? `
                        <div class="flex items-center space-x-5">
                            <img src="${data.pet.image || '/images/pet-placeholder.png'}" 
                                 alt="${data.pet.name}" 
                                 class="h-24 w-24 rounded-2xl object-cover border-3 border-blue-300 shadow-lg">
                            <div class="flex-1">
                                <h4 class="text-xl font-bold text-blue-900 mb-1">${data.pet.name}</h4>
                                <p class="text-base text-blue-700 mb-1">${data.pet.breed}</p>
                                <p class="text-sm text-gray-500">Pet ID: <span class="font-mono font-semibold">${data.pet.id}</span></p>
                            </div>
                        </div>
                    ` : `
                        <div class="text-center py-4">
                            <span class="text-gray-500">No pet selected for this application</span>
                            ${data.application && data.application.pet_id ? 
                              `<p class="text-sm text-red-400 mt-2">⚠️ Pet ID ${data.application.pet_id} not found</p>` : 
                              ''}
                        </div>
                    `}
                </div>
            </div>

            <!-- Form Answers Section -->
            <div class="rounded-xl bg-gradient-to-br from-green-50 to-green-100/50 border border-green-200 p-6 shadow-md">
                <h3 class="text-lg font-bold flex items-center mb-5 text-green-700">
                    <i data-lucide="clipboard-list" class="h-5 w-5 mr-2"></i>
                    Application Answers
                </h3>
                <div class="space-y-4">
                    ${renderFormAnswers(data.answers)}
                </div>
            </div>

            <!-- Documents Section -->
            ${renderDocumentsSection(data.documents)}

            <!-- Application Status Section -->
            <div class="rounded-xl bg-gradient-to-br from-gray-50 to-gray-100/50 border border-gray-200 p-6 shadow-md">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="bg-white/70 rounded-lg p-4 border border-gray-200">
                        <span class="block text-xs text-gray-600 font-semibold uppercase mb-2 tracking-wide">Application Status</span>
                        <div class="mt-1">${getStatusBadge(data.application.status)}</div>
                    </div>
                    <div class="bg-white/70 rounded-lg p-4 border border-gray-200">
                        <span class="block text-xs text-gray-600 font-semibold uppercase mb-2 tracking-wide">Date Applied</span>
                        <span class="block text-base font-semibold text-gray-800">${data.application.created_at}</span>
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
        return '<div class="text-center py-6"><p class="text-gray-500">No form answers provided</p></div>';
    }
    
    // Filter out some keys we don't want to display
    const excludedKeys = ['_token', 'pet_name', 'id_upload_path', 'home_photos_paths', 'idUploadUrl', 'homePhotosUrls'];
    
    let html = '<div class="grid grid-cols-1 md:grid-cols-2 gap-4">';
    
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
            <div class="bg-white/70 rounded-lg p-4 border border-green-100">
                <p class="text-xs text-green-600 font-semibold uppercase mb-2 tracking-wide">${formattedKey}</p>
                <p class="font-medium text-gray-800 break-words">${formattedValue}</p>
            </div>
        `;
    }
    
    html += '</div>';
    return html;
}

function renderDocumentsSection(documents) {
    console.log('renderDocumentsSection called with:', documents);
    
    if (!documents || (!documents.id_upload && (!documents.home_photos || documents.home_photos.length === 0))) {
        console.log('No documents to display');
        return '';
    }

    let html = `
        <div class="rounded-xl bg-gradient-to-br from-purple-50 to-purple-100/50 border border-purple-200 p-6 shadow-md">
            <h3 class="text-lg font-bold flex items-center mb-5 text-purple-700">
                <i data-lucide="file-image" class="h-5 w-5 mr-2"></i>
                Uploaded Documents
            </h3>
            <div class="space-y-5">
    `;

    // Valid ID Section
    if (documents.id_upload) {
        console.log('ID upload path:', documents.id_upload);
        const isImage = documents.id_upload.match(/\.(jpg|jpeg|png|gif)$/i);
        html += `
            <div class="bg-white/70 rounded-lg p-4 border border-purple-100">
                <p class="text-xs text-purple-600 font-semibold uppercase mb-3 tracking-wide">Valid ID</p>
                ${isImage ? `
                    <a href="${documents.id_upload}" target="_blank" class="block">
                        <img src="${documents.id_upload}" alt="Valid ID" class="max-w-full h-auto rounded-lg border-2 border-purple-200 hover:border-purple-400 transition-colors cursor-pointer">
                    </a>
                ` : `
                    <a href="${documents.id_upload}" target="_blank" class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-semibold rounded-lg transition-colors">
                        <i data-lucide="download" class="h-4 w-4 mr-2"></i>
                        Download ID Document
                    </a>
                `}
            </div>
        `;
    }

    // Home Photos Section
    if (documents.home_photos && documents.home_photos.length > 0) {
        console.log('Home photos array:', documents.home_photos);
        html += `
            <div class="bg-white/70 rounded-lg p-4 border border-purple-100">
                <p class="text-xs text-purple-600 font-semibold uppercase mb-3 tracking-wide">Home Photos (${documents.home_photos.length})</p>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        `;
        
        documents.home_photos.forEach((photo, index) => {
            console.log(`Home photo ${index}:`, photo);
            html += `
                <a href="${photo}" target="_blank" class="block group">
                    <img src="${photo}" alt="Home Photo ${index + 1}" 
                         class="w-full h-32 object-cover rounded-lg border-2 border-purple-200 group-hover:border-purple-400 transition-colors cursor-pointer"
                         onerror="console.error('Failed to load image:', '${photo}'); this.src='data:image/svg+xml,%3Csvg xmlns=\\'http://www.w3.org/2000/svg\\' width=\\'100\\' height=\\'100\\'%3E%3Crect fill=\\'%23ddd\\' width=\\'100\\' height=\\'100\\'/%3E%3Ctext x=\\'50%25\\' y=\\'50%25\\' text-anchor=\\'middle\\' dy=\\'.3em\\' fill=\\'%23999\\'%3EImage Error%3C/text%3E%3C/svg%3E'">
                </a>
            `;
        });
        
        html += `
                </div>
            </div>
        `;
    }

    html += `
            </div>
        </div>
    `;

    return html;
}

function getStatusBadge(status) {
    const statusConfig = {
        'pending': { 
            bg: 'bg-gradient-to-r from-yellow-100 to-yellow-200', 
            text: 'text-yellow-800',
            icon: '⏳'
        },
        'approved': { 
            bg: 'bg-gradient-to-r from-green-100 to-green-200', 
            text: 'text-green-800',
            icon: '✓'
        },
        'rejected': { 
            bg: 'bg-gradient-to-r from-red-100 to-red-200', 
            text: 'text-red-800',
            icon: '✕'
        }
    };
    
    const config = statusConfig[status] || { 
        bg: 'bg-gradient-to-r from-gray-100 to-gray-200', 
        text: 'text-gray-800',
        icon: '•'
    };
    
    const formattedStatus = status.charAt(0).toUpperCase() + status.slice(1).replace('_', ' ');
    
    return `<span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold ${config.bg} ${config.text} shadow-sm border border-current/20">
        <span class="mr-2">${config.icon}</span>
        ${formattedStatus}
    </span>`;
}

function saveAdminNotes(applicationId) {
    const notes = document.getElementById('admin-notes').value;
    
    fetch(`/admin/shelter/applications/${applicationId}/update-status`, {
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
        customAlert('Failed to save notes. Please try again.', 'Error');
    });
}

function closeApplicationModal() {
    document.getElementById('applicationModal').classList.add('hidden');
}

function updateApplicationStatus(id, status) {
    const actionText = status === 'approved' ? 'approve' : status === 'rejected' ? 'reject' : status;
    const modalType = status === 'rejected' ? 'danger' : status === 'approved' ? 'success' : 'primary';
    
    // Get button elements
    const approveBtn = document.getElementById(`approve-btn-${id}`);
    const rejectBtn = document.getElementById(`reject-btn-${id}`);
    
    // Check if buttons exist (in case of dynamic content)
    if (!approveBtn || !rejectBtn) {
        console.error('Buttons not found for application', id);
        return;
    }
    
    // Check if the button is already disabled
    if ((status === 'approved' && approveBtn.disabled) || (status === 'rejected' && rejectBtn.disabled)) {
        return; // Don't process if button is already disabled
    }
    
    customConfirm(
        `Are you sure you want to ${actionText} this application? This action cannot be undone.`,
        `${actionText.charAt(0).toUpperCase() + actionText.slice(1)} Application`,
        {
            confirmText: actionText.charAt(0).toUpperCase() + actionText.slice(1),
            cancelText: 'Cancel',
            type: modalType
        }
    ).then(confirmed => {
        if (confirmed) {
            // Immediately update button states for better UX
            updateButtonStates(id, status);
            
            fetch(`/admin/shelter/applications/${id}/update-status`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ status: status })
            }).then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    throw new Error('Failed to update status');
                }
            }).then(data => {
                if (data.success) {
                    // Update status badge in the table
                    updateStatusBadge(id, status);
                    customAlert(data.message, 'success', 'Success');
                    
                    // Update statistics if available
                    updateStatistics();
                } else {
                    // Revert button states on failure
                    revertButtonStates(id, data.previous_status || 'pending');
                    customAlert('Failed to update application status. Please try again.', 'danger', 'Error');
                }
            }).catch(error => {
                console.error('Status update error:', error);
                // Revert button states on error
                revertButtonStates(id, 'pending');
                customAlert('An error occurred while updating the application. Please try again.', 'danger', 'Error');
            });
        }
    });
}

function updateButtonStates(applicationId, newStatus) {
    const approveBtn = document.getElementById(`approve-btn-${applicationId}`);
    const rejectBtn = document.getElementById(`reject-btn-${applicationId}`);
    
    if (!approveBtn || !rejectBtn) return;
    
    // Reset both buttons to active state first
    approveBtn.disabled = false;
    approveBtn.className = 'p-2 rounded-lg transition-all duration-200 bg-green-500 hover:bg-green-600 text-white';
    
    rejectBtn.disabled = false;
    rejectBtn.className = 'p-2 rounded-lg transition-all duration-200 bg-red-500 hover:bg-red-600 text-white';
    
    // Apply the new state
    if (newStatus === 'approved') {
        approveBtn.disabled = true;
        approveBtn.className = 'p-2 rounded-lg transition-all duration-200 bg-gray-300 text-gray-500 cursor-not-allowed';
    } else if (newStatus === 'rejected') {
        rejectBtn.disabled = true;
        rejectBtn.className = 'p-2 rounded-lg transition-all duration-200 bg-gray-300 text-gray-500 cursor-not-allowed';
    }
}

function revertButtonStates(applicationId, originalStatus) {
    // Revert to the original state
    updateButtonStates(applicationId, originalStatus);
}

function updateStatusBadge(applicationId, status) {
    const statusConfigs = {
        'pending': { bg: 'bg-yellow-100', text: 'text-yellow-800', label: 'Pending' },
        'approved': { bg: 'bg-green-100', text: 'text-green-800', label: 'Approved' },
        'rejected': { bg: 'bg-red-100', text: 'text-red-800', label: 'Rejected' }
    };
    
    const config = statusConfigs[status] || { bg: 'bg-gray-100', text: 'text-gray-800', label: 'Unknown' };
    
    // Find the status badge in the table row
    const tableRow = document.querySelector(`#approve-btn-${applicationId}`).closest('tr');
    const statusBadge = tableRow.querySelector('span[class*="bg-yellow-100"], span[class*="bg-green-100"], span[class*="bg-red-100"]');
    
    if (statusBadge) {
        statusBadge.className = `inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${config.bg} ${config.text}`;
        statusBadge.textContent = config.label;
    }
}

function updateStatistics() {
    // Fetch updated statistics and update the cards
    fetch('/admin/shelter/applications?ajax=stats')
        .then(response => response.json())
        .then(data => {
            if (data.stats) {
                document.getElementById('totalCount').textContent = data.stats.total;
                document.getElementById('pendingCount').textContent = data.stats.pending;
                document.getElementById('approvedCount').textContent = data.stats.approved;
                document.getElementById('thisMonthCount').textContent = data.stats.this_month;
            }
        })
        .catch(error => console.error('Failed to update statistics:', error));
}

// Legacy function for compatibility (keep for modal buttons)
function updateStatus(id, status) {
    updateApplicationStatus(id, status);
}

function toggleSelectAll() {
    const checkboxes = document.querySelectorAll('.application-checkbox');
    const selectAll = event.target.checked;
    checkboxes.forEach(checkbox => checkbox.checked = selectAll);
}

function bulkAction() {
    const action = event.target.value;
    console.log('Bulk action triggered:', action);
    if (!action) return;
    
    const selected = Array.from(document.querySelectorAll('.application-checkbox:checked')).map(cb => cb.value);
    console.log('Selected applications:', selected);
    
    if (selected.length === 0) {
        customAlert('Please select at least one application to perform this action.', 'warning', 'No Selection');
        return;
    }
    
    const actionText = action === 'approve' ? 'approve' : action === 'reject' ? 'reject' : action === 'pending' ? 'mark as pending' : action;
    const modalType = action === 'reject' ? 'danger' : action === 'approve' ? 'success' : 'warning';
    
    customConfirm(
        `Are you sure you want to ${actionText} ${selected.length} application${selected.length > 1 ? 's' : ''}? This action cannot be undone.`,
        `Bulk ${actionText.charAt(0).toUpperCase() + actionText.slice(1)} Applications`,
        {
            confirmText: `${actionText.charAt(0).toUpperCase() + actionText.slice(1)} ${selected.length} Application${selected.length > 1 ? 's' : ''}`,
            cancelText: 'Cancel',
            type: modalType
        }
    ).then(confirmed => {
        if (confirmed) {
            console.log('Bulk action data:', { action: action, application_ids: selected });
            
            // Create form data instead of JSON
            const formData = new FormData();
            formData.append('action', action);
            selected.forEach((id, index) => {
                formData.append(`application_ids[${index}]`, id);
            });
            
            fetch('/admin/shelter/applications/bulk-action', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                },
                body: formData
            }).then(response => {
                console.log('Response status:', response.status);
                return response.text().then(text => {
                    console.log('Response text:', text);
                    try {
                        return JSON.parse(text);
                    } catch (e) {
                        console.error('Failed to parse JSON:', e);
                        throw new Error('Invalid JSON response: ' + text);
                    }
                });
            }).then(data => {
                console.log('Parsed data:', data);
                if (data.success) {
                    customAlert(data.message, 'success', 'Success');
                    setTimeout(() => location.reload(), 1500);
                } else {
                    customAlert(data.error || 'Failed to perform bulk action. Please try again.', 'danger', 'Error');
                }
            }).catch(error => {
                console.error('Bulk action error:', error);
                customAlert('An error occurred while performing the bulk action: ' + error.message, 'danger', 'Error');
            });
        }
        
        // Reset the select dropdown
        event.target.value = '';
    });
}

function exportApplications() {
    // Get current filter values
    const status = document.getElementById('statusFilter').value;
    const petType = document.getElementById('petTypeFilter').value;
    const dateRange = document.getElementById('dateRangeFilter').value;
    
    // Build query parameters
    const params = new URLSearchParams();
    if (status) params.append('status', status);
    if (petType) params.append('pet_type', petType);
    if (dateRange) params.append('date_range', dateRange);
    
    // Open export URL with filters
    const url = '/admin/shelter/applications/export' + (params.toString() ? '?' + params.toString() : '');
    window.open(url, '_blank');
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
    fetch(`{{ route('admin.shelter.applications.filter') }}?${params.toString()}`)
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