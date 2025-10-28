<!-- Custom Modal Component -->
<div id="customModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-all duration-300" role="dialog" aria-modal="true" aria-labelledby="modal-title" aria-describedby="modal-description">
    <div class="relative w-full max-w-md mx-4 transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
        <div class="bg-white rounded-lg shadow-xl border border-gray-200 overflow-hidden">
            <!-- Modal Header -->
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 id="modal-title" class="text-lg font-semibold text-gray-900 gradient-title"></h3>
            </div>
            
            <!-- Modal Body -->
            <div class="px-6 py-4">
                <p id="modal-description" class="text-gray-600 leading-relaxed"></p>
            </div>
            
            <!-- Modal Footer -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex justify-end space-x-3">
                <button type="button" id="modal-cancel" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200">
                    Cancel
                </button>
                <button type="button" id="modal-confirm" class="px-4 py-2 text-sm font-medium text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors duration-200" style="background-color: #fe7701;">
                    Confirm
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Modal Animation Classes */
    .modal-show {
        display: flex !important;
    }
    
    .modal-show #modalContent {
        transform: scale(1);
        opacity: 1;
    }
    
    /* Focus trap styles */
    .modal-show {
        overflow: hidden;
    }
    
    /* Accessibility improvements */
    @media (prefers-reduced-motion: reduce) {
        #customModal, #modalContent {
            transition: none;
        }
    }
    
    /* Responsive design */
    @media (max-width: 640px) {
        #modalContent {
            max-width: calc(100vw - 2rem);
        }
    }

    /* Gradient title tuned to match site header reference (stronger stops, weight, and shadow)
       This uses both background-clip and -webkit-text-fill-color for broad browser support. */
    #modal-title.gradient-title,
    .gradient-title {
        background: linear-gradient(90deg, #ff5a00 0%, #ff7b00 35%, #f4ac1dff 70%, #f2a11fff 100%);
        -webkit-background-clip: text;
        background-clip: text;
        -webkit-text-fill-color: transparent; /* for WebKit/Chrome */
        color: transparent;
        display: inline-block;
        background-size: 100% 100%;
        font-weight: 800; /* match bolder display in reference */
        -webkit-font-smoothing: antialiased;
        /* stronger shadow / drop-shadow to match the reference look */
        text-shadow: 0 6px 18px rgba(0,0,0,0.10);
        filter: drop-shadow(0 8px 14px rgba(255,123,25,0.06));
        line-height: 1.05;
    }
</style>

<script>
class CustomModal {
    constructor() {
        this.modal = document.getElementById('customModal');
        this.modalContent = document.getElementById('modalContent');
        this.title = document.getElementById('modal-title');
        this.description = document.getElementById('modal-description');
        this.cancelBtn = document.getElementById('modal-cancel');
        this.confirmBtn = document.getElementById('modal-confirm');
        this.currentResolve = null;
        this.focusableElements = [];
        this.firstFocusableElement = null;
        this.lastFocusableElement = null;
        
        this.init();
    }
    
    init() {
        // Close on backdrop click
        this.modal.addEventListener('click', (e) => {
            if (e.target === this.modal) {
                this.close(false);
            }
        });
        
        // Close on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.modal.classList.contains('modal-show')) {
                this.close(false);
            }
            
            // Handle tab key for focus trap
            if (e.key === 'Tab' && this.modal.classList.contains('modal-show')) {
                this.handleTabKey(e);
            }
        });
        
        // Button event listeners
        this.cancelBtn.addEventListener('click', () => this.close(false));
        this.confirmBtn.addEventListener('click', () => this.close(true));
    }
    
    show(options = {}) {
        return new Promise((resolve) => {
            this.currentResolve = resolve;
            
            // Set content
            this.title.textContent = options.title || 'Confirm Action';
            this.description.textContent = options.message || 'Are you sure you want to proceed?';
            this.cancelBtn.textContent = options.cancelText || 'Cancel';
            this.confirmBtn.textContent = options.confirmText || 'Confirm';
            
            // Set button style based on type
            const type = options.type || 'primary';
            this.updateButtonStyle(type);
            
            // Show modal
            this.modal.classList.add('modal-show');
            document.body.style.overflow = 'hidden';
            
            // Set up focus trap
            this.setupFocusTrap();
            
            // Focus the appropriate button
            setTimeout(() => {
                if (type === 'danger') {
                    this.cancelBtn.focus();
                } else {
                    this.confirmBtn.focus();
                }
            }, 100);
        });
    }
    
    close(result) {
        this.modal.classList.remove('modal-show');
        document.body.style.overflow = '';
        
        if (this.currentResolve) {
            this.currentResolve(result);
            this.currentResolve = null;
        }
    }
    
    updateButtonStyle(type) {
        // Reset classes
        this.confirmBtn.className = 'px-4 py-2 text-sm font-medium text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200';
        
        switch (type) {
            case 'danger':
                this.confirmBtn.style.backgroundColor = '#dc2626';
                this.confirmBtn.classList.add('focus:ring-red-500');
                this.confirmBtn.setAttribute('onmouseover', "this.style.backgroundColor='#b91c1c'");
                this.confirmBtn.setAttribute('onmouseout', "this.style.backgroundColor='#dc2626'");
                break;
            case 'warning':
                this.confirmBtn.style.backgroundColor = '#d97706';
                this.confirmBtn.classList.add('focus:ring-orange-500');
                this.confirmBtn.setAttribute('onmouseover', "this.style.backgroundColor='#b45309'");
                this.confirmBtn.setAttribute('onmouseout', "this.style.backgroundColor='#d97706'");
                break;
            case 'success':
                this.confirmBtn.style.backgroundColor = '#059669';
                this.confirmBtn.classList.add('focus:ring-green-500');
                this.confirmBtn.setAttribute('onmouseover', "this.style.backgroundColor='#047857'");
                this.confirmBtn.setAttribute('onmouseout', "this.style.backgroundColor='#059669'");
                break;
            default: // primary
                this.confirmBtn.style.backgroundColor = '#fe7701';
                this.confirmBtn.classList.add('focus:ring-orange-500');
                this.confirmBtn.setAttribute('onmouseover', "this.style.backgroundColor='#c1431d'");
                this.confirmBtn.setAttribute('onmouseout', "this.style.backgroundColor='#fe7701'");
        }
    }
    
    setupFocusTrap() {
        this.focusableElements = this.modalContent.querySelectorAll(
            'button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])'
        );
        this.firstFocusableElement = this.focusableElements[0];
        this.lastFocusableElement = this.focusableElements[this.focusableElements.length - 1];
    }
    
    handleTabKey(e) {
        if (this.focusableElements.length === 0) return;
        
        if (e.shiftKey) {
            if (document.activeElement === this.firstFocusableElement) {
                this.lastFocusableElement.focus();
                e.preventDefault();
            }
        } else {
            if (document.activeElement === this.lastFocusableElement) {
                this.firstFocusableElement.focus();
                e.preventDefault();
            }
        }
    }
}

// Initialize modal when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    window.customModal = new CustomModal();
});

// Global helper functions to replace browser dialogs
window.customAlert = function(message, type = 'primary', title = 'Notice') {
    // If type is actually a title string, swap the parameters
    if (typeof type === 'string' && ['primary', 'success', 'warning', 'danger'].indexOf(type) === -1) {
        title = type;
        type = 'primary';
    }
    
    return window.customModal.show({
        title: title,
        message: message,
        confirmText: 'OK',
        type: type
    }).then(() => true); // Always resolves to true for alerts
};

window.customConfirm = function(message, title = 'Confirm Action', options = {}) {
    return window.customModal.show({
        title: title,
        message: message,
        confirmText: options.confirmText || 'Confirm',
        cancelText: options.cancelText || 'Cancel',
        type: options.type || 'primary'
    });
};

window.customPrompt = function(message, defaultValue = '', title = 'Input Required') {
    // For prompts, we'll need a separate implementation with input field
    // This is a simplified version that uses confirm for now
    return window.customModal.show({
        title: title,
        message: message,
        confirmText: 'OK',
        cancelText: 'Cancel',
        type: 'primary'
    }).then(result => result ? defaultValue : null);
};
</script>