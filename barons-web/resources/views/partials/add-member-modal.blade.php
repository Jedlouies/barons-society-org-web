<!-- Include Cropper.js Styles and Script -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<!-- Add Member Modal Partial -->
<div class="modal-backdrop @if($errors->has('member_error')) active @endif" id="memberModal">
    <!-- Landscape Modal Box -->
    <div class="modal-box landscape-modal">
        <div class="modal-header">
            <h3>Add New Member</h3>
            <button type="button" class="close-modal-btn" onclick="closeMemberModal()">&times;</button>
        </div>

        @if($errors->has('member_error'))
            <div class="alert-error">
                {{ $errors->first('member_error') }}
            </div>
        @endif

        <!-- Wizard Progress Step Bar -->
        <div class="wizard-progress">
            <div class="wizard-step active" id="memberStepIndicator1">
                <span class="step-num">1</span>
                <span class="step-title">Role & Photo</span>
            </div>
            <div class="wizard-step" id="memberStepIndicator2">
                <span class="step-num">2</span>
                <span class="step-title">Personal Info</span>
            </div>
            <div class="wizard-step" id="memberStepIndicator3">
                <span class="step-num">3</span>
                <span class="step-title">Contact & Address</span>
            </div>
            <div class="wizard-step" id="memberStepIndicator4">
                <span class="step-num">4</span>
                <span class="step-title">Work & Socials</span>
            </div>
        </div>

        <form id="memberForm" action="{{ route('members.store') }}" method="POST" enctype="multipart/form-data" onsubmit="handleMemberSubmit(event)">
            @csrf
            
            <!-- SECTION 1: Class, Cadet Role & Profile Photo -->
<!-- SECTION 1: Class, Cadet Role & Profile Photo -->
<div class="wizard-section active" id="memberWizardSection1">
    <div class="landscape-grid-2">
        <div>
            <div class="form-group">
                <label for="member_class_id">Select Class / Batch</label>
                <select name="class_id" id="member_class_id">
                    <option value="">-- No Class Assigned --</option>
                    @foreach($classes as $classItem)
                        <option value="{{ $classItem['id'] }}" {{ old('class_id') == $classItem['id'] ? 'selected' : '' }}>
                            {{ $classItem['class_name'] }} 
                            @if(!empty($classItem['batch_year'])) ({{ $classItem['batch_year'] }}) @endif
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="member_cadet_role">Cadet Role / Position</label>
                <select name="cadet_role" id="member_cadet_role">
                    <option value="Members" {{ old('cadet_role', 'Members') === 'Members' ? 'selected' : '' }}>Members</option>
                    <option value="Corps Commander" {{ old('cadet_role') === 'Corps Commander' ? 'selected' : '' }}>Corps Commander</option>
                    <option value="Executive Officer" {{ old('cadet_role') === 'Executive Officer' ? 'selected' : '' }}>Executive Officer</option>
                    <option value="S1" {{ old('cadet_role') === 'S1' ? 'selected' : '' }}>S1 (Administrative)</option>
                    <option value="S2" {{ old('cadet_role') === 'S2' ? 'selected' : '' }}>S2 (Intelligence)</option>
                    <option value="S3" {{ old('cadet_role') === 'S3' ? 'selected' : '' }}>S3 (Operations & Training)</option>
                    <option value="S4" {{ old('cadet_role') === 'S4' ? 'selected' : '' }}>S4 (Supply & Logistics)</option>
                    <option value="S7" {{ old('cadet_role') === 'S7' ? 'selected' : '' }}>S7 (Civil-Military Operations)</option>
                </select>
            </div>
        </div>

        <div>
            <div class="form-group">
                <label for="member_profile_photo">Profile Photo (Optional)</label>
                <input type="file" id="member_profile_photo" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropImage(event)">
                
                <input type="file" name="profile_photo" id="cropped_profile_photo" style="display: none;">

                <div id="cropContainer" style="display: none; margin-top: 12px; max-width: 100%; max-height: 220px;">
                    <img id="cropImagePreview" src="" style="max-width: 100%; max-height: 200px; display: block; border-radius: 8px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 2: Personal Details -->
<div class="wizard-section" id="memberWizardSection2">
    <div class="landscape-grid-2">
        <div class="form-group">
            <label for="member_first_name">First Name *</label>
            <input type="text" name="first_name" id="member_first_name" value="{{ old('first_name') }}" required>
        </div>
        <div class="form-group">
            <label for="member_middle_name">Middle Name</label>
            <input type="text" name="middle_name" id="member_middle_name" value="{{ old('middle_name') }}">
        </div>
    </div>

    <div class="landscape-grid-2">
        <div class="form-group">
            <label for="member_last_name">Last Name *</label>
            <input type="text" name="last_name" id="member_last_name" value="{{ old('last_name') }}" required>
        </div>
        <div class="form-group">
            <label for="member_suffix">Suffix</label>
            <input type="text" name="suffix" id="member_suffix" placeholder="Jr., Sr., III" value="{{ old('suffix') }}">
        </div>
    </div>

    <div class="landscape-grid-3">
        <div class="form-group">
            <label for="member_nickname">Nickname</label>
            <input type="text" name="nickname" id="member_nickname" value="{{ old('nickname') }}">
        </div>
        <div class="form-group">
            <label for="member_gender">Gender *</label>
            <select name="gender" id="member_gender" required>
                <option value="">Select Gender</option>
                <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
            </select>
        </div>
        <div class="form-group">
            <label for="member_birth_date">Birth Date</label>
            <input type="date" name="birth_date" id="member_birth_date" value="{{ old('birth_date') }}">
        </div>
    </div>
</div>

<!-- SECTION 3: Contact & Address Information -->
<div class="wizard-section" id="memberWizardSection3">
    <div class="landscape-grid-3">
        <div class="form-group">
            <label for="member_email">Email (Leave blank for auto-generate)</label>
            <input type="email" name="email" id="member_email" placeholder="firstname@barons.org" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="member_contact_number">Contact Number</label>
            <input type="text" name="contact_number" id="member_contact_number" value="{{ old('contact_number') }}">
        </div>
        <div class="form-group">
            <label for="member_civil_status">Civil Status</label>
            <select name="civil_status" id="member_civil_status">
                <option value="">Select Status</option>
                <option value="Single" {{ old('civil_status') === 'Single' ? 'selected' : '' }}>Single</option>
                <option value="Married" {{ old('civil_status') === 'Married' ? 'selected' : '' }}>Married</option>
                <option value="Widowed" {{ old('civil_status') === 'Widowed' ? 'selected' : '' }}>Widowed</option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="member_address">Address</label>
        <input type="text" name="address" id="member_address" value="{{ old('address') }}">
    </div>

    <div class="landscape-grid-3">
        <div class="form-group">
            <label for="member_city">City</label>
            <input type="text" name="city" id="member_city" value="{{ old('city') }}">
        </div>
        <div class="form-group">
            <label for="member_province">Province</label>
            <input type="text" name="province" id="member_province" value="{{ old('province') }}">
        </div>
        <div class="form-group">
            <label for="member_country">Country</label>
            <input type="text" name="country" id="member_country" value="{{ old('country', 'Philippines') }}">
        </div>
    </div>
</div>

<!-- SECTION 4: Employment & Social Links -->
<div class="wizard-section" id="memberWizardSection4">
    <div class="landscape-grid-3">
        <div class="form-group">
            <label for="member_occupation">Occupation *</label>
            <input type="text" name="occupation" id="member_occupation" value="{{ old('occupation') }}" required>
        </div>
        <div class="form-group">
            <label for="member_company">Company</label>
            <input type="text" name="company" id="member_company" value="{{ old('company') }}">
        </div>
        <div class="form-group">
            <label for="member_business_name">Business Name</label>
            <input type="text" name="business_name" id="member_business_name" value="{{ old('business_name') }}">
        </div>
    </div>

    <div class="form-group">
        <label for="member_facebook_url">Facebook Profile URL</label>
        <input type="url" name="facebook_url" id="member_facebook_url" placeholder="https://facebook.com/username" value="{{ old('facebook_url') }}">
    </div>
</div>
            <!-- Wizard Controls Footer -->
            <div class="wizard-controls">
                <button type="button" class="wizard-btn btn-prev" id="prevMemberWizardBtn" onclick="navigateMemberWizard(-1)" style="display: none;">
                    ← Previous
                </button>
                <button type="button" class="wizard-btn btn-next" id="nextMemberWizardBtn" onclick="navigateMemberWizard(1)">
                    Next Step →
                </button>
                <button type="submit" id="submitMemberBtn" class="modal-submit-btn" style="display: none; width: auto; padding: 10px 24px;">
                    <span class="btn-spinner" id="memberBtnSpinner" style="display: none;"></span>
                    <span id="memberBtnText">Add Member</span>
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

.landscape-grid-3 {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
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

@media (max-width: 768px) {
    .landscape-grid-2, .landscape-grid-3 {
        grid-template-columns: 1fr;
    }
    .wizard-step .step-title {
        display: none;
    }
}
</style>

<script>
    let cropper = null;
    let currentMemberStep = 1;
    const totalMemberSteps = 4;

    function openMemberModal() {
        const modal = document.getElementById('memberModal');
        if (modal) {
            modal.classList.add('active');
            currentMemberStep = 1;
            updateMemberWizardView();
        }
    }

    function closeMemberModal() {
        const modal = document.getElementById('memberModal');
        if (modal) modal.classList.remove('active');
        resetCropper();
    }

    function navigateMemberWizard(direction) {
        if (direction === 1 && !validateMemberCurrentStep(currentMemberStep)) {
            return;
        }

        currentMemberStep += direction;

        if (currentMemberStep < 1) currentMemberStep = 1;
        if (currentMemberStep > totalMemberSteps) currentMemberStep = totalMemberSteps;

        updateMemberWizardView();
    }

    function validateMemberCurrentStep(step) {
        const currentSection = document.getElementById(`memberWizardSection${step}`);
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

    function updateMemberWizardView() {
        for (let i = 1; i <= totalMemberSteps; i++) {
            const section = document.getElementById(`memberWizardSection${i}`);
            const indicator = document.getElementById(`memberStepIndicator${i}`);

            if (section) {
                section.classList.toggle('active', i === currentMemberStep);
            }

            if (indicator) {
                indicator.classList.remove('active', 'completed');
                if (i === currentMemberStep) {
                    indicator.classList.add('active');
                } else if (i < currentMemberStep) {
                    indicator.classList.add('completed');
                }
            }
        }

        const prevBtn = document.getElementById('prevMemberWizardBtn');
        const nextBtn = document.getElementById('nextMemberWizardBtn');
        const submitBtn = document.getElementById('submitMemberBtn');

        if (prevBtn) prevBtn.style.display = (currentMemberStep === 1) ? 'none' : 'inline-block';
        if (nextBtn) nextBtn.style.display = (currentMemberStep === totalMemberSteps) ? 'none' : 'inline-block';
        if (submitBtn) submitBtn.style.display = (currentMemberStep === totalMemberSteps) ? 'inline-block' : 'none';
    }

    function resetCropper() {
        if (cropper) {
            cropper.destroy();
            cropper = null;
        }
        document.getElementById('cropContainer').style.display = 'none';
        document.getElementById('cropImagePreview').src = '';
    }

    function previewAndCropImage(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById('cropImagePreview');
                image.src = e.target.result;
                document.getElementById('cropContainer').style.display = 'block';

                if (cropper) {
                    cropper.destroy();
                }

                cropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };

            reader.readAsDataURL(file);
        }
    }

    function handleMemberSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('submitMemberBtn');
        const spinner = document.getElementById('memberBtnSpinner');
        const btnText = document.getElementById('memberBtnText');

        const showLoading = () => {
            if (btn && spinner && btnText) {
                btn.style.pointerEvents = 'none';
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Saving...';
            }
        };

        if (cropper) {
            cropper.getCroppedCanvas({
                width: 500,
                height: 500,
            }).toBlob((blob) => {
                if (!blob) {
                    showLoading();
                    HTMLFormElement.prototype.submit.call(form);
                    return;
                }

                const fileInput = document.getElementById('cropped_profile_photo');
                const croppedFile = new File([blob], 'profile_photo.jpg', { type: 'image/jpeg' });
                
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
        const modal = document.getElementById('memberModal');
        if (event.target === modal) closeMemberModal();
    });
</script>