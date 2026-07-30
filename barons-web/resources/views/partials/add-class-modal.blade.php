<!-- Include Cropper.js Styles and Script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- Add Class Modal Partial -->
<div class="modal-backdrop @if($errors->has('class_error')) active @endif" id="classModal">
    <!-- Landscape Modal Box -->
    <div class="modal-box landscape-modal">
        <div class="modal-header">
            <h3>Add New Class</h3>
            <button type="button" class="close-modal-btn" onclick="closeClassModal()">&times;</button>
        </div>

        @if($errors->has('class_error'))
            <div class="alert-error">
                {{ $errors->first('class_error') }}
            </div>
        @endif

        <!-- Wizard Progress Step Bar -->
        <div class="wizard-progress">
            <div class="wizard-step active" id="classStepIndicator1">
                <span class="step-num">1</span>
                <span class="step-title">Class Identity</span>
            </div>
            <div class="wizard-step" id="classStepIndicator2">
                <span class="step-num">2</span>
                <span class="step-title">Batch & Commander</span>
            </div>
            <div class="wizard-step" id="classStepIndicator3">
                <span class="step-num">3</span>
                <span class="step-title">History & Logo</span>
            </div>
        </div>

        <form id="classForm" action="{{ route('classes.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleClassSubmit(event)">
            @csrf

            <!-- SECTION 1: Class Name & Number -->
            <div class="wizard-section active" id="classWizardSection1">
                <div class="landscape-grid-2">
                    <div class="form-group">
                        <label for="class_name">Class Name *</label>
                        <input type="text" name="class_name" id="class_name" placeholder="e.g. Masidlak" required>
                    </div>
                    <div class="form-group">
                        <label for="class_number">Class Number</label>
                        <input type="number" name="class_number" id="class_number" placeholder="e.g. 1" min="1">
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Batch Year & Corps Commander -->
            <div class="wizard-section" id="classWizardSection2">
                <div class="landscape-grid-2">
                    <div class="form-group">
                        <label for="batch_year">Batch Year</label>
                        <input type="number" name="batch_year" id="batch_year" placeholder="e.g. 2024" min="1950" max="2100">
                    </div>
                    <div class="form-group">
                        <label for="corps_commander">Corps Commander</label>
                        <input type="text" name="corps_commander" id="corps_commander" placeholder="e.g. C/COL Juan Dela Cruz">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Description & Logo Upload -->
            <div class="wizard-section" id="classWizardSection3">
                <div class="landscape-grid-2">
                    <div class="form-group">
                        <label for="class_description">Description / Motto</label>
                        <textarea name="description" id="class_description" rows="4" placeholder="Enter optional class history or motto..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="class_logo_input">Class Logo (Optional)</label>
                        <input type="file" id="class_logo_input" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropClassLogo(event)">
                        
                        <input type="file" name="class_logo" id="cropped_class_logo" style="display: none;">

                        <div id="classLogoCropContainer" style="display: none; margin-top: 12px; max-width: 100%; max-height: 220px;">
                            <img id="classLogoPreview" src="" style="max-width: 100%; max-height: 200px; display: block; border-radius: 8px;">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Wizard Controls Footer -->
            <div class="wizard-controls">
                <button type="button" class="wizard-btn btn-prev" id="prevClassWizardBtn" onclick="navigateClassWizard(-1)" style="display: none;">
                    ← Previous
                </button>
                <button type="button" class="wizard-btn btn-next" id="nextClassWizardBtn" onclick="navigateClassWizard(1)">
                    Next Step →
                </button>
                <button type="submit" id="submitClassBtn" class="modal-submit-btn" style="display: none; width: auto; padding: 10px 24px;">
                    <span class="btn-spinner" id="classBtnSpinner" style="display: none;"></span>
                    <span id="classBtnText">Save Class</span>
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

.alert-error {
    display: block;
    margin-bottom: 16px;
    background-color: #fee2e2;
    color: #dc2626;
    padding: 12px;
    border-radius: 8px;
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
    let classCropper = null;
    let currentClassStep = 1;
    const totalClassSteps = 3;

    function openClassModal() {
        const modal = document.getElementById('classModal');
        if (modal) {
            modal.classList.add('active');
            currentClassStep = 1;
            updateClassWizardView();
        }
    }

    function closeClassModal() {
        const modal = document.getElementById('classModal');
        if (modal) modal.classList.remove('active');
        resetClassCropper();
    }

    function navigateClassWizard(direction) {
        if (direction === 1 && !validateClassCurrentStep(currentClassStep)) {
            return;
        }

        currentClassStep += direction;

        if (currentClassStep < 1) currentClassStep = 1;
        if (currentClassStep > totalClassSteps) currentClassStep = totalClassSteps;

        updateClassWizardView();
    }

    function validateClassCurrentStep(step) {
        const currentSection = document.getElementById(`classWizardSection${step}`);
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

    function updateClassWizardView() {
        for (let i = 1; i <= totalClassSteps; i++) {
            const section = document.getElementById(`classWizardSection${i}`);
            const indicator = document.getElementById(`classStepIndicator${i}`);

            if (section) {
                section.classList.toggle('active', i === currentClassStep);
            }

            if (indicator) {
                indicator.classList.remove('active', 'completed');
                if (i === currentClassStep) {
                    indicator.classList.add('active');
                } else if (i < currentClassStep) {
                    indicator.classList.add('completed');
                }
            }
        }

        const prevBtn = document.getElementById('prevClassWizardBtn');
        const nextBtn = document.getElementById('nextClassWizardBtn');
        const submitBtn = document.getElementById('submitClassBtn');

        if (prevBtn) prevBtn.style.display = (currentClassStep === 1) ? 'none' : 'inline-block';
        if (nextBtn) nextBtn.style.display = (currentClassStep === totalClassSteps) ? 'none' : 'inline-block';
        if (submitBtn) submitBtn.style.display = (currentClassStep === totalClassSteps) ? 'inline-block' : 'none';
    }

    function resetClassCropper() {
        if (classCropper) {
            classCropper.destroy();
            classCropper = null;
        }
        document.getElementById('classLogoCropContainer').style.display = 'none';
        document.getElementById('classLogoPreview').src = '';
    }

    function previewAndCropClassLogo(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById('classLogoPreview');
                image.src = e.target.result;
                document.getElementById('classLogoCropContainer').style.display = 'block';

                if (classCropper) {
                    classCropper.destroy();
                }

                classCropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };

            reader.readAsDataURL(file);
        }
    }

    function handleClassSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('submitClassBtn');
        const spinner = document.getElementById('classBtnSpinner');
        const btnText = document.getElementById('classBtnText');

        const showLoading = () => {
            if (btn && spinner && btnText) {
                btn.style.pointerEvents = 'none';
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Saving Class...';
            }
        };

        if (classCropper) {
            classCropper.getCroppedCanvas({
                width: 500,
                height: 500,
            }).toBlob((blob) => {
                if (!blob) {
                    showLoading();
                    HTMLFormElement.prototype.submit.call(form);
                    return;
                }

                const fileInput = document.getElementById('cropped_class_logo');
                const croppedFile = new File([blob], 'class_logo.jpg', { type: 'image/jpeg' });

                const dataTransfer = new DataTransfer();
                dataTransfer.items.add(croppedFile);
                fileInput.files = dataTransfer.files;

                showLoading();
                HTMLFormElement.prototype.submit.call(form);
            }, 'image/jpeg', 0.9);
        } else {
            showLoading();
            HTMLFormElement.prototype.submit.call(form);
        }
    }

    document.addEventListener('click', function(event) {
        const modal = document.getElementById('classModal');
        if (event.target === modal) closeClassModal();
    });
</script>