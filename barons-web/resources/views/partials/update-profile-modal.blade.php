<!-- Include Cropper.js -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<div class="modal-backdrop @if($errors->has('update_profile_error')) active @endif" id="updateProfileModal">
    <!-- Landscape Modal Container -->
    <div class="modal-box landscape-modal">
        <div class="modal-header">
            <h3>Update Personal Information</h3>
            <button type="button" class="close-modal-btn" onclick="closeUpdateProfileModal()">&times;</button>
        </div>

        @if($errors->has('update_profile_error'))
            <div class="alert-error">
                {{ $errors->first('update_profile_error') }}
            </div>
        @endif

        <!-- Wizard Progress Bar Header -->
        <div class="wizard-progress">
            <div class="wizard-step active" id="stepIndicator1">
                <span class="step-num">1</span>
                <span class="step-title">Account & Photo</span>
            </div>
            <div class="wizard-step" id="stepIndicator2">
                <span class="step-num">2</span>
                <span class="step-title">Personal Info</span>
            </div>
            <div class="wizard-step" id="stepIndicator3">
                <span class="step-num">3</span>
                <span class="step-title">Contact & Address</span>
            </div>
            <div class="wizard-step" id="stepIndicator4">
                <span class="step-num">4</span>
                <span class="step-title">Work & Socials</span>
            </div>
        </div>

        <form id="updateProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" onsubmit="handleUpdateProfileSubmit(event)">
            @csrf
            
            <!-- SECTION 1: Account Info & Profile Photo -->
            <div class="wizard-section active" id="wizardSection1">
                <div class="landscape-grid-2">
                    <div>
                        <div class="form-group">
                            <label for="up_class_id">Class / Batch (Locked)</label>
                            <select id="up_class_id" disabled class="input-disabled">
                                <option value="">-- No Class Assigned --</option>
                                @foreach($classes as $classItem)
                                    <option value="{{ $classItem['id'] }}" {{ ($memberDetails['class_id'] ?? '') == $classItem['id'] ? 'selected' : '' }}>
                                        {{ $classItem['class_name'] }} 
                                        @if(!empty($classItem['batch_year'])) ({{ $classItem['batch_year'] }}) @endif
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="up_cadet_role">Cadet Role / Position (Locked)</label>
                            @php $selectedRole = $memberDetails['cadet_role'] ?? 'Members'; @endphp
                            <select id="up_cadet_role" disabled class="input-disabled">
                                <option value="Corps Commander" {{ $selectedRole === 'Corps Commander' ? 'selected' : '' }}>Corps Commander</option>
                                <option value="Executive Officer" {{ $selectedRole === 'Executive Officer' ? 'selected' : '' }}>Executive Officer</option>
                                <option value="S1" {{ $selectedRole === 'S1' ? 'selected' : '' }}>S1 (Administrative)</option>
                                <option value="S2" {{ $selectedRole === 'S2' ? 'selected' : '' }}>S2 (Intelligence)</option>
                                <option value="S3" {{ $selectedRole === 'S3' ? 'selected' : '' }}>S3 (Operations & Training)</option>
                                <option value="S4" {{ $selectedRole === 'S4' ? 'selected' : '' }}>S4 (Supply & Logistics)</option>
                                <option value="S7" {{ $selectedRole === 'S7' ? 'selected' : '' }}>S7 (Civil-Military Operations)</option>
                                <option value="Members" {{ $selectedRole === 'Members' ? 'selected' : '' }}>Members</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="form-group">
                            <label for="up_profile_photo">Profile Photo</label>
                            <input type="file" id="up_profile_photo" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropUpdateImage(event)">
                            
                            <input type="file" name="profile_photo" id="cropped_up_profile_photo" style="display: none;">

                            <div id="upCropContainer" style="{{ !empty($memberDetails['profile_photo']) ? 'display: block;' : 'display: none;' }} margin-top: 12px; max-width: 100%; max-height: 220px;">
                                <img id="upCropPreview" src="{{ $memberDetails['profile_photo'] ?? '' }}" style="max-width: 100%; max-height: 200px; display: block; border-radius: 8px;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTION 2: Personal Details -->
            <div class="wizard-section" id="wizardSection2">
                <div class="landscape-grid-2">
                    <div class="form-group">
                        <label for="up_first_name">First Name (Locked)</label>
                        <input type="text" id="up_first_name" value="{{ $memberDetails['first_name'] ?? Auth::user()->name ?? '' }}" readonly class="input-disabled">
                    </div>
                    <div class="form-group">
                        <label for="up_middle_name">Middle Name</label>
                        <input type="text" name="middle_name" id="up_middle_name" value="{{ old('middle_name', $memberDetails['middle_name'] ?? '') }}">
                    </div>
                </div>

                <div class="landscape-grid-2">
                    <div class="form-group">
                        <label for="up_last_name">Last Name *</label>
                        <input type="text" name="last_name" id="up_last_name" value="{{ old('last_name', $memberDetails['last_name'] ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="up_suffix">Suffix</label>
                        <input type="text" name="suffix" id="up_suffix" placeholder="Jr., Sr., III" value="{{ old('suffix', $memberDetails['suffix'] ?? '') }}">
                    </div>
                </div>

                <div class="landscape-grid-3">
                    <div class="form-group">
                        <label for="up_nickname">Nickname</label>
                        <input type="text" name="nickname" id="up_nickname" value="{{ old('nickname', $memberDetails['nickname'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="up_gender">Gender *</label>
                        @php $selectedGender = old('gender', $memberDetails['gender'] ?? ''); @endphp
                        <select name="gender" id="up_gender" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ $selectedGender === 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ $selectedGender === 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="up_birth_date">Birth Date</label>
                        <input type="date" name="birth_date" id="up_birth_date" value="{{ old('birth_date', $memberDetails['birth_date'] ?? '') }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 3: Contact & Location Address -->
            <div class="wizard-section" id="wizardSection3">
                <div class="landscape-grid-3">
                    <div class="form-group">
                        <label for="up_email">Email (Locked)</label>
                        <input type="email" id="up_email" value="{{ Auth::user()->email ?? '' }}" readonly class="input-disabled">
                    </div>
                    <div class="form-group">
                        <label for="up_contact_number">Contact Number *</label>
                        <input type="text" name="contact_number" id="up_contact_number" value="{{ old('contact_number', $memberDetails['contact_number'] ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="up_civil_status">Civil Status *</label>
                        @php $selectedStatus = old('civil_status', $memberDetails['civil_status'] ?? ''); @endphp
                        <select name="civil_status" id="up_civil_status" required>
                            <option value="">Select Status</option>
                            <option value="Single" {{ $selectedStatus === 'Single' ? 'selected' : '' }}>Single</option>
                            <option value="Married" {{ $selectedStatus === 'Married' ? 'selected' : '' }}>Married</option>
                            <option value="Widowed" {{ $selectedStatus === 'Widowed' ? 'selected' : '' }}>Widowed</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="up_address">Address *</label>
                    <input type="text" name="address" id="up_address" value="{{ old('address', $memberDetails['address'] ?? '') }}" required>
                </div>

                <div class="landscape-grid-3">
                    <div class="form-group">
                        <label for="up_city">City</label>
                        <input type="text" name="city" id="up_city" value="{{ old('city', $memberDetails['city'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="up_province">Province</label>
                        <input type="text" name="province" id="up_province" value="{{ old('province', $memberDetails['province'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="up_country">Country</label>
                        <input type="text" name="country" id="up_country" value="{{ old('country', $memberDetails['country'] ?? 'Philippines') }}">
                    </div>
                </div>
            </div>

            <!-- SECTION 4: Employment & Social Links -->
            <div class="wizard-section" id="wizardSection4">
                <div class="landscape-grid-3">
                    <div class="form-group">
                        <label for="up_occupation">Occupation *</label>
                        <input type="text" name="occupation" id="up_occupation" value="{{ old('occupation', $memberDetails['occupation'] ?? '') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="up_company">Company</label>
                        <input type="text" name="company" id="up_company" value="{{ old('company', $memberDetails['company'] ?? '') }}">
                    </div>
                    <div class="form-group">
                        <label for="up_business_name">Business Name</label>
                        <input type="text" name="business_name" id="up_business_name" value="{{ old('business_name', $memberDetails['business_name'] ?? '') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label for="up_facebook_url">Facebook Profile URL</label>
                    <input type="url" name="facebook_url" id="up_facebook_url" placeholder="https://facebook.com/username" value="{{ old('facebook_url', $memberDetails['facebook_url'] ?? '') }}">
                </div>
            </div>

            <!-- Wizard Controls Footer -->
            <div class="wizard-controls">
                <button type="button" class="wizard-btn btn-prev" id="prevWizardBtn" onclick="navigateWizard(-1)" style="display: none;">
                    ← Previous
                </button>
                <button type="button" class="wizard-btn btn-next" id="nextWizardBtn" onclick="navigateWizard(1)">
                    Next Step →
                </button>
                <button type="submit" id="submitUpdateProfileBtn" class="modal-submit-btn" style="display: none; width: auto; padding: 10px 24px;">
                    <span class="btn-spinner" id="upProfileBtnSpinner" style="display: none;"></span>
                    <span id="upProfileBtnText">Save Profile Updates</span>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
/* Landscape Modal Styling */
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

.input-disabled {
    background-color: #f1f5f9 !important;
    cursor: not-allowed !important;
    opacity: 0.8;
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
    let upCropper = null;
    let currentWizardStep = 1;
    const totalWizardSteps = 4;

    function openUpdateProfileModal() {
        const modal = document.getElementById('updateProfileModal');
        if (modal) {
            modal.classList.add('active');
            currentWizardStep = 1;
            updateWizardView();
        }
    }

    function closeUpdateProfileModal() {
        const modal = document.getElementById('updateProfileModal');
        if (modal) modal.classList.remove('active');
        if (upCropper) {
            upCropper.destroy();
            upCropper = null;
        }
    }

    function navigateWizard(direction) {
        if (direction === 1 && !validateCurrentStep(currentWizardStep)) {
            return;
        }

        currentWizardStep += direction;

        if (currentWizardStep < 1) currentWizardStep = 1;
        if (currentWizardStep > totalWizardSteps) currentWizardStep = totalWizardSteps;

        updateWizardView();
    }

    function validateCurrentStep(step) {
        const currentSection = document.getElementById(`wizardSection${step}`);
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

    function updateWizardView() {
        // Toggle Active Sections
        for (let i = 1; i <= totalWizardSteps; i++) {
            const section = document.getElementById(`wizardSection${i}`);
            const indicator = document.getElementById(`stepIndicator${i}`);

            if (section) {
                section.classList.toggle('active', i === currentWizardStep);
            }

            if (indicator) {
                indicator.classList.remove('active', 'completed');
                if (i === currentWizardStep) {
                    indicator.classList.add('active');
                } else if (i < currentWizardStep) {
                    indicator.classList.add('completed');
                }
            }
        }

        // Toggle Control Buttons
        const prevBtn = document.getElementById('prevWizardBtn');
        const nextBtn = document.getElementById('nextWizardBtn');
        const submitBtn = document.getElementById('submitUpdateProfileBtn');

        if (prevBtn) prevBtn.style.display = (currentWizardStep === 1) ? 'none' : 'inline-block';
        if (nextBtn) nextBtn.style.display = (currentWizardStep === totalWizardSteps) ? 'none' : 'inline-block';
        if (submitBtn) submitBtn.style.display = (currentWizardStep === totalWizardSteps) ? 'inline-block' : 'none';
    }

    function previewAndCropUpdateImage(event) {
        const files = event.target.files;
        if (files && files.length > 0) {
            const file = files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                const image = document.getElementById('upCropPreview');
                image.src = e.target.result;
                document.getElementById('upCropContainer').style.display = 'block';

                if (upCropper) {
                    upCropper.destroy();
                }

                upCropper = new Cropper(image, {
                    aspectRatio: 1,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                });
            };

            reader.readAsDataURL(file);
        }
    }

    function handleUpdateProfileSubmit(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('submitUpdateProfileBtn');
        const spinner = document.getElementById('upProfileBtnSpinner');
        const btnText = document.getElementById('upProfileBtnText');

        const showLoading = () => {
            if (btn && spinner && btnText) {
                btn.style.pointerEvents = 'none';
                spinner.style.display = 'inline-block';
                btnText.textContent = 'Saving...';
            }
        };

        if (upCropper) {
            upCropper.getCroppedCanvas({
                width: 500,
                height: 500,
            }).toBlob((blob) => {
                if (!blob) {
                    showLoading();
                    HTMLFormElement.prototype.submit.call(form);
                    return;
                }

                const fileInput = document.getElementById('cropped_up_profile_photo');
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
</script>