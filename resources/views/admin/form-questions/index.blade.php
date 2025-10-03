@extends('admin.layouts.app')

@section('title', 'Form Builder - PawPal Admin')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-3xl font-serif font-bold text-foreground">Form Builder</h1>
            <p class="text-muted-foreground mt-1">Manage adoption application form questions</p>
        </div>
        <button onclick="openCreateModal()" class="btn-primary" style="background-color: #9334e9 !important; color: white !important; border: none !important; padding: 12px 20px !important; border-radius: 8px !important; font-weight: 600 !important; font-size: 14px !important; display: inline-flex !important; align-items: center !important; gap: 8px !important; transition: all 0.3s ease !important; box-shadow: 0 2px 4px rgba(147, 52, 233, 0.2) !important;" onmouseover="this.style.backgroundColor='#7c3aed'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 4px 8px rgba(147, 52, 233, 0.3)'" onmouseout="this.style.backgroundColor='#9334e9'; this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 4px rgba(147, 52, 233, 0.2)'">
            <i data-lucide="plus" class="h-4 w-4"></i>
            Add Question
        </button>
    </div>

    <!-- Form Questions List -->
    <div class="bg-card rounded-lg border border-border overflow-hidden">
        <div class="p-6 border-b border-border">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input type="text" placeholder="Search questions..." class="input w-full">
                </div>
                <select class="input w-full sm:w-auto">
                    <option value="">All Types</option>
                    <option value="text">Text</option>
                    <option value="email">Email</option>
                    <option value="phone">Phone</option>
                    <option value="select">Select</option>
                    <option value="radio">Radio</option>
                    <option value="checkbox">Checkbox</option>
                    <option value="textarea">Textarea</option>
                </select>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-muted border-b border-border">
                    <tr>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Order</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Question</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Type</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Required</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Status</th>
                        <th class="text-left py-3 px-6 text-muted-foreground font-medium">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($formQuestions ?? [] as $question)
                    <tr class="hover:bg-muted/50 transition-colors">
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <button class="text-muted-foreground hover:text-foreground">
                                    <i data-lucide="grip-vertical" class="h-4 w-4"></i>
                                </button>
                                <span class="font-medium">{{ $question->order ?? 1 }}</span>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <div class="max-w-md">
                                <p class="font-medium text-foreground line-clamp-2">{{ $question->question ?? 'Sample Question' }}</p>
                                @if($question->description ?? false)
                                <p class="text-sm text-muted-foreground mt-1 line-clamp-2">{{ $question->description }}</p>
                                @endif
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-primary/10 text-primary">
                                {{ ucfirst($question->type ?? 'text') }}
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            @if($question->required ?? false)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-destructive/10 text-destructive">
                                Required
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-muted text-muted-foreground">
                                Optional
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            @if($question->is_active ?? true)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                Active
                            </span>
                            @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                Inactive
                            </span>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-2">
                                <button onclick="editQuestion({{ $question->id ?? 1 }})" class="btn-secondary btn-sm">
                                    <i data-lucide="edit" class="h-4 w-4"></i>
                                </button>
                                <button onclick="toggleQuestionStatus({{ $question->id ?? 1 }})" class="btn-secondary btn-sm">
                                    <i data-lucide="eye{{ ($question->is_active ?? true) ? '-off' : '' }}" class="h-4 w-4"></i>
                                </button>
                                <button onclick="deleteQuestion({{ $question->id ?? 1 }})" class="btn-destructive btn-sm">
                                    <i data-lucide="trash-2" class="h-4 w-4"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-12 text-center">
                            <div class="flex flex-col items-center space-y-3">
                                <i data-lucide="file-text" class="h-12 w-12 text-muted-foreground/50"></i>
                                <p class="text-muted-foreground">No form questions found</p>
                                <button onclick="openCreateModal()" class="btn-primary btn-sm">
                                    Add your first question
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

<!-- Create/Edit Question Modal -->
<div id="questionModal" class="fixed inset-0 z-50 hidden">
    <div class="fixed inset-0 bg-black/50" onclick="closeQuestionModal()"></div>
    <div class="fixed inset-0 flex items-center justify-center p-4">
        <div class="bg-card rounded-lg shadow-xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <form id="questionForm" method="POST">
                @csrf
                <div class="p-6 border-b border-border">
                    <h2 id="modalTitle" class="text-xl font-serif font-bold text-foreground">Add Question</h2>
                </div>
                
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-foreground mb-2">Question Text *</label>
                            <input type="text" name="question" id="question" required class="input w-full" placeholder="Enter your question">
                        </div>
                        
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-foreground mb-2">Description (Optional)</label>
                            <textarea name="description" id="description" rows="3" class="input w-full" placeholder="Optional description or instructions"></textarea>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-foreground mb-2">Question Type *</label>
                            <select name="type" id="type" required class="input w-full" onchange="handleTypeChange()">
                                <option value="text">Text Input</option>
                                <option value="email">Email</option>
                                <option value="phone">Phone Number</option>
                                <option value="select">Dropdown Select</option>
                                <option value="radio">Radio Buttons</option>
                                <option value="checkbox">Checkboxes</option>
                                <option value="textarea">Long Text (Textarea)</option>
                                <option value="number">Number</option>
                                <option value="date">Date</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-foreground mb-2">Order</label>
                            <input type="number" name="order" id="order" min="1" class="input w-full" value="1">
                        </div>
                        
                        <div id="optionsContainer" class="md:col-span-2 hidden">
                            <label class="block text-sm font-medium text-foreground mb-2">Options (one per line)</label>
                            <textarea name="options" id="options" rows="4" class="input w-full" placeholder="Option 1&#10;Option 2&#10;Option 3"></textarea>
                        </div>
                        
                        <div class="md:col-span-2">
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="required" id="required" class="rounded border-border text-primary focus:ring-primary">
                                    <span class="text-sm text-foreground">Required field</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="checkbox" name="is_active" id="is_active" checked class="rounded border-border text-primary focus:ring-primary">
                                    <span class="text-sm text-foreground">Active</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="p-6 border-t border-border flex justify-end space-x-3">
                    <button type="button" onclick="closeQuestionModal()" class="btn-secondary">Cancel</button>
                    <button type="submit" class="btn-primary">Save Question</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Add Question';
    document.getElementById('questionForm').action = '{{ route("admin.form-questions.store") }}';
    document.getElementById('questionForm').querySelector('input[name="_method"]')?.remove();
    document.getElementById('questionForm').reset();
    document.getElementById('is_active').checked = true;
    document.getElementById('questionModal').classList.remove('hidden');
    handleTypeChange();
}

function editQuestion(id) {
    // In a real implementation, you would fetch the question data
    document.getElementById('modalTitle').textContent = 'Edit Question';
    const form = document.getElementById('questionForm');
    form.action = `/admin/form-questions/${id}`;
    
    // Add method spoofing for PUT request
    let methodInput = form.querySelector('input[name="_method"]');
    if (!methodInput) {
        methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        form.appendChild(methodInput);
    }
    methodInput.value = 'PUT';
    
    document.getElementById('questionModal').classList.remove('hidden');
}

function closeQuestionModal() {
    document.getElementById('questionModal').classList.add('hidden');
}

function handleTypeChange() {
    const type = document.getElementById('type').value;
    const optionsContainer = document.getElementById('optionsContainer');
    
    if (['select', 'radio', 'checkbox'].includes(type)) {
        optionsContainer.classList.remove('hidden');
    } else {
        optionsContainer.classList.add('hidden');
    }
}

function toggleQuestionStatus(id) {
    if (confirm('Are you sure you want to change the status of this question?')) {
        fetch(`/admin/form-questions/${id}/toggle-active`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            }
        }).then(() => location.reload());
    }
}

function deleteQuestion(id) {
    if (confirm('Are you sure you want to delete this question? This action cannot be undone.')) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/form-questions/${id}`;
        form.innerHTML = `
            @csrf
            @method('DELETE')
        `;
        document.body.appendChild(form);
        form.submit();
    }
}

// Initialize Lucide icons
lucide.createIcons();
</script>
@endsection