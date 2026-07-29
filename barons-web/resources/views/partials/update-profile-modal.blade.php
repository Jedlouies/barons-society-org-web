<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>

<div class="modal-backdrop @if($errors->has('update_profile_error')) active @endif" id="updateProfileModal">
    <div class="modal-box" style="max-width: 700px; max-height: 90vh; overflow-y: auto;">
        <div class="modal-header">
            <h3>Update Personal Information</h3>
            <button type="button" class="close-modal-btn" onclick="closeUpdateProfileModal()">&times;</button>
        </div>

        @if($errors->has('update_profile_error'))
            <div class="alert-error" style="display: block; margin-bottom: 16px; background-color: #fee2e2; color: #dc2626; padding: 12px; border-radius: 8px;">
                {{ $errors->first('update_profile_error') }}
            </div>
        @endif

        <form id="updateProfileForm" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" onsubmit="handleUpdateProfileSubmit(event)">
            @csrf
            
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="up_class_id">Class / Batch (Locked)</label>
                    <select id="up_class_id" disabled style="background-color: #f1f5f9; cursor: not-allowed; opacity: 0.8;">
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
                    <select id="up_cadet_role" disabled style="background-color: #f1f5f9; cursor: not-allowed; opacity: 0.8;">
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

            <!-- Profile Photo Upload -->
            <div class="form-group">
                <label for="up_profile_photo">Profile Photo</label>
                <input type="file" id="up_profile_photo" accept="image/jpeg,image/png,image/webp" onchange="previewAndCropUpdateImage(event)">
                
                <input type="file" name="profile_photo" id="cropped_up_profile_photo" style="display: none;">

                <div id="upCropContainer" style="{{ !empty($memberDetails['profile_photo']) ? 'display: block;' : 'display: none;' }} margin-top: 12px; max-width: 100%; max-height: 350px;">
                    <img id="upCropPreview" src="{{ $memberDetails['profile_photo'] ?? '' }}" style="max-width: 100%; max-height: 250px; display: block; border-radius: 8px;">
                </div>
            </div>

            <!-- Personal Info (First Name Locked) -->
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="up_first_name">First Name (Locked)</label>
                    <input type="text" id="up_first_name" value="{{ $memberDetails['first_name'] ?? Auth::user()->name ?? '' }}" readonly style="background-color: #f1f5f9; cursor: not-allowed; opacity: 0.8;">
                </div>
                <div class="form-group">
                    <label for="up_middle_name">Middle Name</label>
                    <input type="text" name="middle_name" id="up_middle_name" value="{{ old('middle_name', $memberDetails['middle_name'] ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="up_last_name">Last Name *</label>
                    <input type="text" name="last_name" id="up_last_name" value="{{ old('last_name', $memberDetails['last_name'] ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="up_suffix">Suffix</label>
                    <input type="text" name="suffix" id="up_suffix" placeholder="Jr., Sr., III" value="{{ old('suffix', $memberDetails['suffix'] ?? '') }}">
                </div>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
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

            <!-- Contact & Civil Status (Email Locked) -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
                <div class="form-group">
                    <label for="up_email">Email (Locked)</label>
                    <input type="email" id="up_email" value="{{ Auth::user()->email ?? '' }}" readonly style="background-color: #f1f5f9; cursor: not-allowed; opacity: 0.8;">
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

            <!-- Address Fields -->
            <div class="form-group">
                <label for="up_address">Address *</label>
                <input type="text" name="address" id="up_address" value="{{ old('address', $memberDetails['address'] ?? '') }}" required>
            </div>

            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
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

            <!-- Employment, Company & Business Name -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 12px;">
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

            <!-- Social Media Link -->
            <div class="form-group">
                <label for="up_facebook_url">Facebook Profile URL</label>
                <input type="url" name="facebook_url" id="up_facebook_url" placeholder="https://facebook.com/username" value="{{ old('facebook_url', $memberDetails['facebook_url'] ?? '') }}">
            </div>

            <button type="submit" id="submitUpdateProfileBtn" class="modal-submit-btn">
                <span class="btn-spinner" id="upProfileBtnSpinner" style="display: none;"></span>
                <span id="upProfileBtnText">Save Profile Updates</span>
            </button>
        </form>
    </div>
</div>

<script>
    let upCropper = null;

    function openUpdateProfileModal() {
        const modal = document.getElementById('updateProfileModal');
        if (modal) modal.classList.add('active');
    }

    function closeUpdateProfileModal() {
        const modal = document.getElementById('updateProfileModal');
        if (modal) modal.classList.remove('active');
        if (upCropper) {
            upCropper.destroy();
            upCropper = null;
        }
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