<!-- Add Announcement Modal Partial -->
<div class="modal-backdrop" id="announcementModal">
    <!-- Landscape Modal Box -->
    <div class="modal-box landscape-modal">
        <div class="modal-header">
            <h3>Add New Announcement</h3>
            <button type="button" class="close-modal-btn" onclick="closeAnnouncementModal()">&times;</button>
        </div>

        <!-- Wizard Progress Step Bar -->
        <div class="wizard-progress">
            <div class="wizard-step active" id="announcementStepIndicator1">
                <span class="step-num">1</span>
                <span class="step-title">General Info & Type</span>
            </div>
            <div class="wizard-step" id="announcementStepIndicator2">
                <span class="step-num">2</span>
                <span class="step-title">Expiration & Content</span>
            </div>
        </div>

        <form id="announcementForm" action="{{ route('announcements.store') }}" method="POST" onsubmit="handleAnnouncementSubmit(event)">
            @csrf
            
            <!-- SECTION 1: Title & Type/Priority -->
            <div class="wizard-section active" id="announcementWizardSection1">
                <div class="landscape-grid-2">
                    <div class="form-group">
                        <label for="announcement_title">Title *</label>
                        <input type="text" name="title" id="announcement_title" placeholder="Enter announcement title" required>
                    </div>

                    <div class="form-group">
                        <label for="announcement_type">Type / Priority *</label>
                        <select name="type" id="announcement_type" required>
                            <option value="general" selected>General Notice</option>
                            <option value="urgent">Urgent Notice</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Expiration Date & Content -->
            <div class="wizard-section" id="announcementWizardSection2">
                <div class="form-group">
                    <label for="announcement_expires_at">Deadline / Expiration Date & Time</label>
                    <input type="datetime-local" name="expires_at" id="announcement_expires_at">
                </div>

                <div class="form-group">
                    <label for="announcement_content">Content Details *</label>
                    <textarea name="content" id="announcement_content" rows="5" placeholder="Enter announcement details..." required></textarea>
                </div>
            </div>

            <!-- Wizard Controls Footer -->
            <div class="wizard-controls">
                <button type="button" class="wizard-btn btn-prev" id="prevAnnouncementWizardBtn" onclick="navigateAnnouncementWizard(-1)" style="display: none;">
                    ← Previous
                </button>
                <button type="button" class="wizard-btn btn-next" id="nextAnnouncementWizardBtn" onclick="navigateAnnouncementWizard(1)">
                    Next Step →
                </button>
                <button type="submit" id="submitAnnouncementBtn" class="modal-submit-btn" style="display: none; width: auto; padding: 10px 24px;">
                    <span class="btn-spinner" id="btnSpinner" style="display: none;"></span>
                    <span id="btnText">Publish Announcement</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Landscape Wizard Modal Styling */
.landscape-modal {
    max-width: 900px !important;
    width: 95%;
    max-height: 90vh;
    overflow-y: auto;
    padding: 24px;
}

.landscape-grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 16px;
}

/* Wizard Header Progress Bar */
.wizard-progress {
    display: flex;
    justify-content: space-between;
    margin-bottom: 24px;
    border-bottom: 2px solid #e2e8f0;
    padding-bottom: 12px;
}

.wizard-step {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    font-size: 13px;
    font-weight: 600;
}

.wizard-step .step-num {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: #e2e8f0;
    color: #64748b;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 12px;
}

.wizard-step.active {
    color: #0f172a;
}

.wizard-step.active .step-num {
    background: #0f172a;
    color: #ffffff;
}

.wizard-step.completed {
    color: #16a34a;
}

.wizard-step.completed .step-num {
    background: #dcfce7;
    color: #16a34a;
}

/* Wizard Step Visibility */
.wizard-section {
    display: none;
}

.wizard-section.active {
    display: block;
}

/* Wizard Control Buttons */
.wizard-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 24px;
    padding-top: 16px;
    border-top: 1px solid #e2e8f0;
}

.wizard-btn {
    padding: 10px 20px;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: all 0.2s ease;
}

.btn-prev {
    background: #f1f5f9;
    color: #475569;
}

.btn-prev:hover {
    background: #e2e8f0;
}

.btn-next {
    background: #0f172a;
    color: #ffffff;
    margin-left: auto;
}

.btn-next:hover {
    background: #1e293b;
}

/* Spinner CSS */
.btn-spinner {
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-radius: 50%;
    border-top-color: #ffffff;
    animation: spin 0.8s linear infinite;
    display: inline-block;
    vertical-align: middle;
    margin-right: 8px;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

@media (max-width: 768px) {
    .landscape-grid-2 {
        grid-template-columns: 1fr;
    }
    .wizard-step .step-title {
        display: none;
    }
}
</style>

<script>
    let currentAnnouncementStep = 1;
    const totalAnnouncementSteps = 2;

    function openAnnouncementModal() {
        const modal = document.getElementById('announcementModal');
        if (modal) {
            modal.classList.add('active');
            currentAnnouncementStep = 1;
            updateAnnouncementWizardView();
        }
    }

    function closeAnnouncementModal() {
        const modal = document.getElementById('announcementModal');
        if (modal) modal.classList.remove('active');
    }

    function navigateAnnouncementWizard(direction) {
        if (direction === 1 && !validateAnnouncementCurrentStep(currentAnnouncementStep)) {
            return;
        }

        currentAnnouncementStep += direction;

        if (currentAnnouncementStep < 1) currentAnnouncementStep = 1;
        if (currentAnnouncementStep > totalAnnouncementSteps) currentAnnouncementStep = totalAnnouncementSteps;

        updateAnnouncementWizardView();
    }

    function validateAnnouncementCurrentStep(step) {
        const currentSection = document.getElementById(`announcementWizardSection${step}`);
        if (!currentSection) return true;

        const requiredInputs = currentSection.querySelectorAll('[required]');
        let isValid = true;

        requiredInputs.forEach((input) => {
            if (!input.checkValidity()) {
                input.reportValidity();
                isValid = false;
            }
        });

        return isValid;
    }

    function updateAnnouncementWizardView() {
        for (let i = 1; i <= totalAnnouncementSteps; i++) {
            const section = document.getElementById(`announcementWizardSection${i}`);
            const indicator = document.getElementById(`announcementStepIndicator${i}`);

            if (section) {
                section.classList.toggle('active', i === currentAnnouncementStep);
            }

            if (indicator) {
                indicator.classList.remove('active', 'completed');
                if (i === currentAnnouncementStep) {
                    indicator.classList.add('active');
                } else if (i < currentAnnouncementStep) {
                    indicator.classList.add('completed');
                }
            }
        }

        const prevBtn = document.getElementById('prevAnnouncementWizardBtn');
        const nextBtn = document.getElementById('nextAnnouncementWizardBtn');
        const submitBtn = document.getElementById('submitAnnouncementBtn');

        if (prevBtn) prevBtn.style.display = (currentAnnouncementStep === 1) ? 'none' : 'inline-block';
        if (nextBtn) nextBtn.style.display = (currentAnnouncementStep === totalAnnouncementSteps) ? 'none' : 'inline-block';
        if (submitBtn) submitBtn.style.display = (currentAnnouncementStep === totalAnnouncementSteps) ? 'inline-block' : 'none';
    }

    function handleAnnouncementSubmit(e) {
        const btn = document.getElementById('submitAnnouncementBtn');
        const spinner = document.getElementById('btnSpinner');
        const btnText = document.getElementById('btnText');

        if (btn && spinner && btnText) {
            btn.disabled = true;
            spinner.style.display = 'inline-block';
            btnText.textContent = 'Publishing...';
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('announcementModal');
        if (event.target === modal) closeAnnouncementModal();
    });
</script>